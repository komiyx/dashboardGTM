<?php
include("../auth/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize input
    $startDate = htmlspecialchars($_POST['start_date']);
    $endDate = htmlspecialchars($_POST['end_date']);
    $limit = $_POST['limit']; // Could be "all" or a specific number

    // Validate date input
    if (!$startDate || !$endDate) {
        die("Invalid date range.");
    }

    // Build the query
    $query = "SELECT * FROM bdt_user_records WHERE created_time BETWEEN ? AND ?";
    if ($limit !== 'all') {
        $query .= " LIMIT ?";
    }

    $stmt = $conn->prepare($query);

    if ($limit !== 'all') {
        $stmt->bind_param("ssi", $startDate, $endDate, $limit);
    } else {
        $stmt->bind_param("ss", $startDate, $endDate);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Set headers for Excel export
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="bdt_user_records_' . $startDate . '_to_' . $endDate . '.xls"');
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
            <th>Bank/Emoney Selected</th>
            <th>Bank/Emoney</th>
            <th>Bank/Emoney Name</th>
            <th>Bank No/Emoney No</th>
            <th>URL</th>
            <th>Created Time</th>
          </tr>";

    // Output data rows
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['deposit_status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['password']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bank_emoney_selected']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bank_emoney']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bank_emoney_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bank_no_emoney_no']) . "</td>";
            echo "<td>" . htmlspecialchars($row['url']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_time']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='12'>No records found for the selected date range.</td></tr>";
    }

    echo "</table>";
    exit;
} else {
    echo "Invalid request.";
}
?>
