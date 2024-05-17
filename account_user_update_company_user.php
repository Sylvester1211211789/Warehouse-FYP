<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}
$ID = $_SESSION['ID'];
$Name = $_SESSION['Name'];
$check = "SELECT Company_Name FROM users WHERE UserID='$ID'";
$result = $sambungan->query($check);

// Check if 'data' parameter is set in the URL
if (isset($_GET['data'])) {
    $data = $_GET['data'];
    echo "<script>alert('$data');</script>"; // Display the value of 'data' using JavaScript alert
} else {
    $data = ''; // Set default value if 'data' parameter is not set
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current = $row["Company_Name"];
} else {
    $current = "Unknown";
}
if (isset($_POST["New"]) and isset($_POST["userID"])) {
    $New = $_POST["New"];
    $use = $_POST["userID"];

    $update = "UPDATE users SET Company_Name=? WHERE UserID='$use'";
    $binding = $sambungan->prepare($update);
    $binding->bind_param('s', $New);
    $role = 'users';

    if ($binding->execute()) {
        echo "<script>alert('Edit Email successful')</script>";
    } else {
        echo "<script>alert('Edit name unsuccessful')</script>";
    }
}
$sambungan->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sss.css">
</head>

<body>
<form method="post">
    <title>Account Setting</title>
    <div class="AccountContainer">
        <h1>Edit Company Name</h1>
        <p>Current Company Name: <?php echo $current; ?></p>
        <input placeholder="Enter New Name" class="input-field" type="text" name="New">
        <button type="submit">Update Company Name</button>
    </div>
</form>
</body>
</html>
