<?php
// Include database connection
include '../auth/connect.php';

// Set headers for CSV export
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="gtmrecord_export.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Open the output stream
$output = fopen('php://output', 'w');

// Write the CSV header
fputcsv($output, ['ID', 'Country', 'Brand Name', 'URL', 'Register', 'Deposit', 'Install Date']);

// Fetch data from the database
$query = "SELECT * FROM gtmrecord ORDER BY id ASC";
$result = $conn->query($query);

// Check if there are results
if ($result && $result->num_rows > 0) {
    // Loop through each row and write to the CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['id'],
            $row['country'],
            $row['brandname'],
            $row['url'],
            $row['register'],
            $row['deposit'],
            $row['installdate']
        ]);
    }
} else {
    // No data found
    fputcsv($output, ['No records found']);
}

// Close the output stream
fclose($output);
$conn->close();
?>
