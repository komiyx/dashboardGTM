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

        // Prepare the SQL statement for the new table
        $query = "INSERT INTO indo_user_dep_records (username, url, last_created_time)
                  VALUES (?, ?, ?)
                  ON DUPLICATE KEY UPDATE 
                      url = VALUES(url),
                      last_created_time = VALUES(last_created_time)";
        $stmt = $conn->prepare($query);

        // Process each row
        while (($row = fgetcsv($file, 1000, ",")) !== false) {
            // Map CSV columns to table columns
            $username = $row[0]; // Column 1: Username
            $url = $row[1];      // Column 2: URL
            $lastCreatedTime = $row[2]; // Column 3: Last Created Time

            // Bind parameters for each row
            $stmt->bind_param('sss', $username, $url, $lastCreatedTime);

            // Execute the query
            if (!$stmt->execute()) {
                echo "Error inserting row: " . $stmt->error . "<br>";
            }
        }

        // Close the file and statement
        fclose($file);
        $stmt->close();

        echo "CSV data successfully imported into indo_user_dep_records!";
    } else {
        echo "Error: Empty file.";
    }
} else {
    echo "Error: File not uploaded.";
}
?>
