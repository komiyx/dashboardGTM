<?php

include("../../auth/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $username = isset($_POST['username']) && !empty(trim($_POST['username'])) ? $_POST['username'] : null;
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '-';
    $password = isset($_POST['password']) ? $_POST['password'] : '-';
    $email = isset($_POST['email']) ? $_POST['email'] : '-';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '-';
    $bank = isset($_POST['bank']) ? $_POST['bank'] : '-';
    $isBankSelected = isset($_POST['isBankSelected']) ? $_POST['isBankSelected'] : '-';
    $bankno = isset($_POST['bankno']) ? $_POST['bankno'] : '-';
    $bankname = isset($_POST['bankname']) ? $_POST['bankname'] : '-';
    $url = isset($_POST['url']) ? $_POST['url'] : '-';

    // Sanitize inputs
    $fname = htmlspecialchars($fname);
    $password = htmlspecialchars($password);
    $email = htmlspecialchars($email);
    $isBankSelected = htmlspecialchars($isBankSelected);
    $mobile = htmlspecialchars($mobile);
    $bank = htmlspecialchars($bank);
    $bankno = htmlspecialchars($bankno);
    $bankname = htmlspecialchars($bankname);
    $url = htmlspecialchars($url);

    // Ensure username is defined and not empty
    if ($username === null) {
        error_log("Username is undefined or empty. Skipping insertion.");
        exit;
    }

    $username = htmlspecialchars($username);

    // Ensure mobile number starts with '0'
    if ($mobile !== '-' && strpos($mobile, '0') !== 0) {
        $mobile = '0' . $mobile;
    }

    // Check if the mobile number already exists
    $check_query = "SELECT id FROM bdt_user_records WHERE mobile = ?";
    $check_stmt = $conn->prepare($check_query);
    if ($check_stmt) {
        $check_stmt->bind_param("s", $mobile);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            // Mobile number already exists
            error_log("Mobile number $mobile already exists in the database. Skipping insertion.");
        } else {
            // Mobile number does not exist; proceed with insertion
            $query = "INSERT INTO bdt_user_records 
            (username, password, fullname, email, mobile, bank_emoney_selected, bank_emoney, bank_emoney_name, bank_no_emoney_no, url, created_time)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
                $created_time = $date->format('Y-m-d H:i:s');
                $stmt->bind_param("sssssssssss", $username, $password, $fname, $email, $mobile, $isBankSelected, $bank, $bankname, $bankno, $url, $created_time);

                if ($stmt->execute()) {
                    error_log("Data successfully inserted into the database: Username: $username, Email: $email, Mobile: $mobile");
                } else {
                    error_log("Error inserting data: " . $stmt->error);
                }

                $stmt->close();
            } else {
                error_log("Error preparing insert statement: " . $conn->error);
            }
        }

        $check_stmt->close();
    } else {
        error_log("Error preparing check statement: " . $conn->error);
    }
}

$conn->close();

?>
