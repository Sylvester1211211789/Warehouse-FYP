<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
include('sambung.php');
session_start();
$ID = $_SESSION['ID']; 
$Name = $_SESSION['Name'];
$check = "SELECT Company_Name FROM users WHERE UserID='$ID'";
$result = $sambungan->query($check);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current = $row["Company_Name"];
} else {
    $current = "Unknown";
}
if(isset($_POST["New"])) {
    $current = $_POST["New"];
    $update = "UPDATE users SET Company_Name='$current' WHERE UserID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit Company name successful')</script>";



    } else {
        echo "<script>alert('Edit name unsuccessful')</script>";
    }

}
$sambungan->close();
?>


<body>
<form method="post" >
    <title>Account Setting</title>
       <div> 
    <h1>Edit Company Name</h1>
    <p>Current Company Name: <?php echo $current; ?></p>
    <input placeholder="Enter New Name" class="" type="text" name="New">
    <button type="submit">Update Company Name</button>
    </div>
</form>
    </body>
</html>
