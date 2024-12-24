<?php
// Include Google API client
require __DIR__ . '/../../vendor/autoload.php';  // Make sure to have the Google API client installed

// Capture data from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $username = isset($_POST['username']) ? $_POST['username'] : '-';
    $url = isset($_POST['url']) ? $_POST['url'] : '-';

    // Sanitize inputs
    $username = htmlspecialchars($username);
    $url = htmlspecialchars($url);

    if ($username != 'null') {
        // Proceed to send data to Google Sheets if not duplicate
        sendDataToGoogleSheets($username, $url);
    } else {
        echo "Username is empty. Data not sent to Google Sheets.";
    }
}

function sendDataToGoogleSheets($username, $url) {
    require __DIR__ . '/../../vendor/autoload.php';  // Make sure to have the Google API client installed

    $client = new Google\Client();
    $client->setApplicationName('GTM DATA RECORD');
    $client->setScopes([Google\Service\Sheets::SPREADSHEETS]);
    $client->setAuthConfig('/home/procom32/public_html/credentials.json');

    $service = new Google\Service\Sheets($client);
    
    $spreadsheetId = '1Fw5kdHhQjCSp-8WVHSs8PsSAL45HoYmSmVfJujJbHt0'; // Enter your Google Sheet ID here
    $range = 'INDO DEPOSIT!A2:D';  // Range to check for existing usernames in column A

    // Get existing usernames and last created times from Google Sheets
    $existingData = $service->spreadsheets_values->get($spreadsheetId, $range)->getValues();

    // Flatten the usernames from column A for easy searching
    $usernames = array_column($existingData, 0);

    // Get the current time in Malaysia timezone
    $date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
    $malaysiaTime = $date->format('Y-m-d H:i:s');

    // Check if username already exists
    $rowIndex = array_search($username, $usernames);

    if ($rowIndex !== false) {
        // If username exists, update Last Created Time in column D for that row
        $updateRange = 'INDO DEPOSIT!D' . ($rowIndex + 2); // +2 to account for header row and 0-based index
        $body = new Google\Service\Sheets\ValueRange([
            'values' => [[$malaysiaTime]]
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $service->spreadsheets_values->update($spreadsheetId, $updateRange, $body, $params);
        echo "Updated Last Created Time for existing username.";
    } else {
        // If username doesn't exist, insert new data in a new row
        $values = [
            [$username, $url, $malaysiaTime, "-"]  // Data row, set Last Created Time as "-"
        ];

        $body = new Google\Service\Sheets\ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        try {
            $result = $service->spreadsheets_values->append($spreadsheetId, 'INDO DEPOSIT!A1', $body, $params);
            echo "Data sent to Google Sheets successfully!";
        } catch (Exception $e) {
            echo "Error sending data to Google Sheets: " . $e->getMessage();
        }
    }
}
?>
