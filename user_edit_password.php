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
$Status = $_SESSION['Status'];

if($Status == "admin"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];


    $update = "UPDATE admin SET Password='$New' WHERE AdminID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit password successful')</script>";

    } else {
        echo "<script>alert('Edit password unsuccessful')</script>";
    }
} 
}
elseif($Status == "user"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];


    $update = "UPDATE users SET Password='$New' WHERE UserID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit password successful')</script>";

    } else {
        echo "<script>alert('Edit password unsuccessful')</script>";
    }
}
}
elseif($Status == "manager"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];


    $update = "UPDATE manager SET Password='$New' WHERE ManagerID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit password successful')</script>";

    } else {
        echo "<script>alert('Edit password unsuccessful')</script>";
    }
} 
}    
$sambungan->close();
?>
<body>
<form method="post" >
    <title>Account Setting</title>
       <div class=""> 
    <h1>Change Password</h1>
    <input placeholder="Enter New password" class="" type="text" name="New">
    <button type="submit">Update password</button>
    </div>
    
</form>
    </body>
</html>