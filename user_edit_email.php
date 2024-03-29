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
$Status = $_SESSION['Status'];
$email = $_SESSION['Email'];
if($Status == "admin"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $currentName = $New;
    $_SESSION['Email'] = $New;
    $update = "UPDATE admin SET Email='$New' WHERE AdminID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit Email successful')</script>";

    } else {
        echo "<script>alert('Edit Email unsuccessful')</script>";
    }
} else {
 
    $currentName = $email;
}
}
elseif($Status == "manager"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $_SESSION['Email'] = $New;
    $currentName = $New;

    $update = "UPDATE manager SET Email='$New' WHERE ManagerID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit Email successful')</script>";

    } else {
        echo "<script>alert('Edit Email unsuccessful')</script>";
    }
} else {

    $currentName = $email;
}
}
 elseif($Status == "user"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $currentName = $New;
    $_SESSION['Email'] = $New;
    $update = "UPDATE users SET Email='$New' WHERE UserID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit Email successful')</script>";

    } else {
        echo "<script>alert('Edit Email unsuccessful')</script>";
    }
} else {

    $currentName = $email;
}
}   
    
$sambungan->close();
?>
<body>
<form  method="post" >
    <title>Account Setting</title>
       <div class=""> 
    <h1>Change Email</h1>
    <p>Current Email: <?php echo $currentName; ?></p>
    <input placeholder="Enter New Email" class="" type="email" name="New">
    <button type="submit">Update Email</button>
    </div>
    
</form>
    </body>
</html>