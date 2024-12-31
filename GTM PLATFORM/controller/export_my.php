<?php
include("../auth/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $limit = $_POST['limit']; // This will be "all" or a number

    $startDate = htmlspecialchars($startDate);
    $endDate = htmlspecialchars($endDate);

    // Base query for fetching records
    $query = "SELECT * FROM my_user_records WHERE created_time BETWEEN ? AND ?";
    
    // Add a limit clause if "All Records" is not selected
    if ($limit !== 'all') {
        $query .= " LIMIT ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $startDate, $endDate, $limit);
    } else {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $startDate, $endDate);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Set headers for Excel export
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="my_user_records_' . $startDate . '_to_' . $endDate . '.xls"');
    header('Pragma: no-cache');
    header('Expires: 0');

    echo "<table border='1'>";
    echo "<tr>
            <th>Username</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Bank</th>
            <th>Created Time</th>
          </tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bank']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_time']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found for the selected date range.</td></tr>";
    }

    echo "</table>";
    exit;
} else {
    echo "Invalid request.";
}
?>
