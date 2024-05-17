<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sss.css">

</head>

<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}
$ID = $_SESSION['ID']; 
$Status = $_SESSION['Status'];
$Phone_Nu= $_SESSION['num'];
if($Status == "admin"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $_SESSION['num']=$New;
    $currentNum = $New;
    $update = "UPDATE admin SET Phone_Number=? WHERE AdminID='$ID'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('s',$New);
    if ($binding->execute()) {
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
    $update = "UPDATE admin SET Phone_Number=? WHERE ManagerID='$ID'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('s',$New);

    if ($binding->execute()) {
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
    $update = "UPDATE admin SET Phone_Number=? WHERE UserID='$ID'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('s',$New);

    if ($binding->execute()) {
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
       <div class="AccountContainer"> 
    <h1>Edit Phone Number</h1>
    <p>Current Number: <?php echo $currentNum;  ?></p>
    <input placeholder="Enter New Name" class="input-field" type="text" name="New">
    <button type="submit">Update Phone Number</button>
    </div>
</form>
    </body>
</html>
