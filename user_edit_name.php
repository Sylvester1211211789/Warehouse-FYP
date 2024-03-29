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


    $update= "UPDATE admin SET Fullname='$New' WHERE AdminID='$ids'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit Fullname successful')</script>";

    } else {
        echo "<script>alert('Edit Fullname unsuccessful')</script>";
    }
} else {
 
    $currentName = $Name;
}
}
elseif($Status == "manager"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];


    $update = "UPDATE manager SET Fullname='$New' WHERE ManagerID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit Fullname successful')</script>";

    } else {
        echo "<script>alert('Edit Fullname unsuccessful')</script>";
    }
} else {

    $currentName = $Name;
}
}
 elseif($Status == "user"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];


    $update = "UPDATE users SET Fullname='$New' WHERE UserID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit Fullname successful')</script>";

    } else {
        echo "<script>alert('Edit Fullname unsuccessful')</script>";
    }
} else {

    $currentName = $Name;
}
}   
    
$sambungan->close();
?>
<body>
<form method="post" >
    <title>Account Setting</title>
       <div class=""> 
    <h1>Edit Name</h1>
    <p>Current Name: <?php echo $currentName; ?></p>
    <input placeholder="Enter New Name" class="" type="text" name="New">
    <button type="submit">Update Name</button>
    </div>
</form>
    </body>
</html>
