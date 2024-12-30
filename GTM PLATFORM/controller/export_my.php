<?php
// Include database connection
include("../auth/connect.php");

// Start output buffering to prevent premature output
ob_start();

// Fetch data from my_user_records table
$query = "SELECT * FROM my_user_records";
$result = $conn->query($query);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Set headers for Excel export
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="my_user_records.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Start table structure
echo "<table border='1'>";
echo "<tr>
        <th>Deposit_User</th>   
        <th>Username</th>
        <th>Password</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Bank</th>
        <th>BankNo</th>
        <th>EWalletNum</th>
        <th>URL</th>
        <th>Created Time</th>
      </tr>";

// Output data rows if available
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . htmlspecialchars($row['deposit_status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['password']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bank']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bankno']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ewalletnum']) . "</td>";
            echo "<td>" . htmlspecialchars($row['url']) . "</std>";
            echo "<td>" . htmlspecialchars($row['created_time']) . "</td>";
        echo "</tr>";
    }
} else {
    // If no data is available
    echo "<tr><td colspan='11'>No data available to export.</td></tr>";
}

echo "</table>";

// Flush the buffer and send the output
ob_end_flush();
?>
