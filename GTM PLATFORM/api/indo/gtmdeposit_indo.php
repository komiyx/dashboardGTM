<?php
// Include database connection
include '../auth/connect.php'; // Adjust this path to your database connection file

// Capture data from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $username = isset($_POST['username']) ? $_POST['username'] : '-';
    $url = isset($_POST['url']) ? $_POST['url'] : '-';

    // Sanitize inputs
    $username = htmlspecialchars($username);
    $url = htmlspecialchars($url);

    if ($username != 'null') {
        // Save to database
        saveDataToDatabase($username, $url);
    } else {
        echo "Username is empty. Data not saved to database.";
    }
}

function saveDataToDatabase($username, $url) {
    global $conn; // Use the database connection from included file

    // Get the current time in Malaysia timezone
    $date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
    $malaysiaTime = $date->format('Y-m-d H:i:s');

    // Check if the username already exists in the database
    $query = "SELECT id FROM indo_user_dep_records WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // If the username exists, update the record
        $updateQuery = "UPDATE indo_user_dep_records SET url = ?, last_created_time = ? WHERE username = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('sss', $url, $malaysiaTime, $username);

        if ($updateStmt->execute()) {
            echo "Updated Last Created Time for existing username.";
        } else {
            echo "Error updating data: " . $conn->error;
        }
    } else {
        // If the username doesn't exist, insert a new record
        $insertQuery = "INSERT INTO indo_user_dep_records (username, url, last_created_time) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param('sss', $username, $url, $malaysiaTime);

        if ($insertStmt->execute()) {
            echo "Data saved to database successfully!";
        } else {
            echo "Error saving data: " . $conn->error;
        }
    }

    // Close the statements
    $stmt->close();
    if (isset($updateStmt)) $updateStmt->close();
    if (isset($insertStmt)) $insertStmt->close();
}
?>
