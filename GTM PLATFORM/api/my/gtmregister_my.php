<?php
include("../../auth/connect.php"); // Include your database connection

// Capture data from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $username = isset($_POST['username']) ? $_POST['username'] : '-';
    $password = isset($_POST['password']) ? $_POST['password'] : '-';
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '-';
    $email = isset($_POST['email']) ? $_POST['email'] : '-';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '-';
    $bank = isset($_POST['bank']) ? $_POST['bank'] : '-';
    $bankno = isset($_POST['bankno']) ? $_POST['bankno'] : '-';
    $ewallet = isset($_POST['ewallet']) ? $_POST['ewallet'] : '-';
    $url = isset($_POST['url']) ? $_POST['url'] : '-';

    // Sanitize inputs
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $fname = htmlspecialchars($fname);
    $email = htmlspecialchars($email);
    $mobile = htmlspecialchars($mobile);
    $bank = htmlspecialchars($bank);
    $bankno = htmlspecialchars($bankno);
    $ewallet = htmlspecialchars($ewallet);
    $url = htmlspecialchars($url);

    // Ensure mobile number starts with '0'
    if ($mobile !== '-' && strpos($mobile, '0') !== 0) {
        $mobile = '0' . $mobile;
    }

    // Check for duplicates before inserting into the database
    if (!isDuplicate($username, $mobile)) {
        // Save data to the database
        saveDataToDatabase($username, $password, $fname, $email, $mobile, $bank, $bankno, $ewallet, $url);
    } else {
        echo "Duplicate entry found. Data not saved to the database.";
    }
}

function isDuplicate($username, $mobile) {
    global $conn; // Use the database connection
    $query = "SELECT id FROM my_user_records WHERE username = ? OR mobile = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $mobile);
    $stmt->execute();
    $stmt->store_result();
    $isDuplicate = $stmt->num_rows > 0;
    $stmt->close();
    return $isDuplicate;
}

function saveDataToDatabase($username, $password, $fname, $email, $mobile, $bank, $bankno, $ewallet, $url) {
    global $conn; // Use the database connection

    // Get the current time in Malaysia timezone
    $date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
    $malaysiaTime = $date->format('Y-m-d H:i:s');

    // Insert data into the database
    $query = "INSERT INTO my_user_records 
              (username, password, fullname, email, mobile, bank, bankno, ewalletnum, url, created_time) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssssss', $username, $password, $fname, $email, $mobile, $bank, $bankno, $ewallet, $url, $malaysiaTime);

    if ($stmt->execute()) {
        echo "Data saved to the database successfully!";
    } else {
        echo "Error saving data to the database: " . $conn->error;
    }

    $stmt->close();
}
?>
