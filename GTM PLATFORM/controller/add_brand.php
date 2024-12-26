<?php
include '../auth/connect.php';

if (isset($_POST['submit'])) {
    $country = $_POST['country'];
    $brandname = $_POST['brandname'];
    $url = $_POST['url'];
    $register = $_POST['register'];
    $deposit = $_POST['deposit'];

    // Get the current date in d/m/Y format
    $installdate = date("d/m/Y");

    // Update the SQL query to include installdate
    $sql = "INSERT INTO gtmrecord (country, brandname, url, register, deposit, installdate) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $country, $brandname, $url, $register, $deposit, $installdate);

    if ($stmt->execute()) {
        echo "New brand added successfully"; 
        header("Location: ../home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
