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
$status = $_SESSION['Status'];
$Phone_Nu= $_SESSION['num'];
if($Status == "admin"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $_SESSION['num']=$New;
    $currentNum = $New;
    $update = "UPDATE admin SET Phone_Number='$New' WHERE AdminID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit phone number successful')</script>";

    } else {
        echo "<script>alert('Edit phone number unsuccessful')</script>";
    }
} else {
 
    $currentNum = $Phone_Nu;
}
}
elseif($Status == "manager"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $_SESSION['num']=$New;
    $currentNum = $New;
    $update = "UPDATE manager SET Phone_Number='$New' WHERE ManagerID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit phone number successful')</script>";

    } else {
        echo "<script>alert('Edit phone number unsuccessful')</script>";
    }
} else {

    $currentNum = $Phone_Nu;
}
}
 elseif($Status == "user"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $_SESSION['num']=$New;
    $currentNum = $New;
    $update = "UPDATE users SET Phone_Number='$New' WHERE UserID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit phone number successful')</script>";

    } else {
        echo "<script>alert('Edit phone number unsuccessful')</script>";
    }
} else {

    $currentNum = $Phone_Nu;
}
} 
$sambungan->close();
?>

<body>
<form method="post" >
    <title>Account Setting</title>
       <div class=""> 
    <h1>Edit Phone Number</h1>
    <p>Current Number: <?php echo $currentNum;  ?></p>
    <input placeholder="Enter New Name" class="" type="text" name="New">
    <button type="submit">Update Phone Number</button>
    </div>
</form>
    </body>
</html>
