<?php
// Include database connection
include '../auth/connect.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input data
    $id = intval($_POST['id']);
    $country = htmlspecialchars($_POST['country']);
    $brandname = htmlspecialchars($_POST['brandname']);
    $url = htmlspecialchars($_POST['url']);
    $installdate = htmlspecialchars($_POST['installdate']);
    $register = intval($_POST['register']);
    $deposit = intval($_POST['deposit']);

    // Update the record
    $query = "UPDATE gtmrecord SET country = ?, brandname = ?, url = ?, installdate = ?, register = ?, deposit = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssiii', $country, $brandname, $url, $installdate, $register, $deposit, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully!";
        header("Location: ../home.php"); // Redirect back to the main page
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
