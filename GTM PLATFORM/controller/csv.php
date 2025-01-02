<?php
// Include database connection
include '../auth/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $fileName = $_FILES['csv_file']['tmp_name'];

    if ($_FILES['csv_file']['size'] > 0) {
        // Open the CSV file
        $file = fopen($fileName, 'r');

        // Skip the first line (header row)
        fgetcsv($file);

        // Prepare the SQL statement
        $query = "INSERT INTO hk_user_records 
            (username, password, fullname, email, mobile, bank_emoney_selected, bank_emoney, bank_emoney_name, bank_no_emoney_no, url, created_time)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Process each row
        while (($row = fgetcsv($file, 1000, ",")) !== false) {
            // Bind parameters for each row
            $stmt->bind_param(
                "sssssssssss",
                $row[0], // username
                $row[1], // password
                $row[2], // fullname
                $row[3], // email
                $row[4], // mobile
                $row[5], // bank_emoney_selected
                $row[6], // bank_emoney
                $row[7], // bank_emoney_name
                $row[8], // bank_no_emoney_no
                $row[9], // url
                $row[10] // created_time
            );

            // Execute the query
            if (!$stmt->execute()) {
                echo "Error inserting row: " . $stmt->error . "<br>";
            }
        }

        // Close the file and statement
        fclose($file);
        $stmt->close();

        echo "CSV data successfully imported!";
    } else {
        echo "Error: Empty file.";
    }
} else {
    echo "Error: File not uploaded.";
}
?>
