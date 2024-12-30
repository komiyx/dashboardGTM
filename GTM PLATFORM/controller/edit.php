<?php
// Include database connection
include '../auth/connect.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("No record ID provided.");
}

// Sanitize and retrieve the ID
$id = intval($_GET['id']);

// Fetch the existing record
$query = "SELECT * FROM gtmrecord WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the record exists
if ($result->num_rows === 0) {
    die("Record not found.");
}

// Get record data
$record = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Record</h2>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($record['id']) ?>">
            
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="<?= htmlspecialchars($record['country']) ?>" required>
            </div>

            <div class="form-group">
                <label for="brandname">Brand Name</label>
                <input type="text" class="form-control" id="brandname" name="brandname" value="<?= htmlspecialchars($record['brandname']) ?>" required>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url" value="<?= htmlspecialchars($record['url']) ?>" required>
            </div>


            <div class="form-group">
                <label for="register">Register</label>
                <select class="form-control" id="register" name="register" required>
                    <option value="Yes" <?= $record['register'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="No" <?= $record['register'] === 'No' ? 'selected' : '' ?>>No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deposit">Deposit</label>
                <select class="form-control" id="deposit" name="deposit" required>
                    <option value="Yes" <?= $record['deposit'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="No" <?= $record['deposit'] === 'No' ? 'selected' : '' ?>>No</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
