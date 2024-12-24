<?php

    include("../../auth/connect.php");
    
    // Capture data from POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Capture form data
        $username = isset($_POST['username']) ? $_POST['username'] : '-';
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
        $username = htmlspecialchars($username);
        $fname = htmlspecialchars($fname);
        $password = htmlspecialchars($password);
        $email = htmlspecialchars($email);
        $isBankSelected = htmlspecialchars($isBankSelected);
        $mobile = htmlspecialchars($mobile);
        $bank = htmlspecialchars($bank);
        $bankno = htmlspecialchars($bankno);
        $bankname = htmlspecialchars($bankname);
        $url = htmlspecialchars($url);

        // Ensure mobile number starts with '0'
        if ($mobile !== '-' && strpos($mobile, '0') !== 0) {
            $mobile = '0' . $mobile;
        }


        $query = "INSERT INTO indo_user_records 
        (username, password, fullname, email, mobile, bank_emoney_selected, bank_emoney, bank_emoney_name, bank_no_emoney_no, url, created_time)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $created_time = date('Y-m-d H:i:s'); // Current time
            $stmt->bind_param("sssssssssss", $username, $password, $fname, $email, $mobile, $isBankSelected, $bank, $bankname, $bankno, $url, $created_time);
    
            // Execute the query
            if ($stmt->execute()) {
                error_log("Data successfully inserted into the database: Username: $username, Email: $email, Mobile: $mobile");
                
                // Verify by checking if the data exists in the database
                $last_id = $conn->insert_id; // Get the last inserted ID
                $verification_query = "SELECT * FROM indo_user_records WHERE id = ?";
                $verification_stmt = $conn->prepare($verification_query);
    
                if ($verification_stmt) {
                    $verification_stmt->bind_param("i", $last_id);
                    $verification_stmt->execute();
                    $result = $verification_stmt->get_result();
    
                    if ($result->num_rows > 0) {
                        error_log("Verification successful. Data exists in the database for ID: $last_id");
                    } else {
                        error_log("Verification failed. Data not found in the database for ID: $last_id");
                    }
                    $verification_stmt->close();
                }
            } else {
                error_log("Error inserting data: " . $stmt->error);
            }
    
            $stmt->close();
        } else {
            error_log("Error preparing statement: " . $conn->error);
        }
    }

    $conn->close();
 
?>
