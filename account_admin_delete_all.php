<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/Login");
    exit();
}


$id = $_SESSION['ID'];
$Name = $_SESSION['Name'];

$pangkat = 0;
if (isset($_POST['userid'])){
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM users WHERE UserID=?";
    if ($stmt = $sambungan->prepare($sql)) {
        $stmt->bind_param('s', $_POST['userid']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {   
            $found = TRUE;
            $usertype = 'users';
            $iden = 'UserID';
            $pangkat = 1;
            exit;
        }
    }
    if($found == FALSE){
    $sql = "SELECT * FROM admin WHERE AdminID=?";
    if ($stmt = $sambungan->prepare($sql)) {
        $stmt->bind_param('s', $_POST['userid']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {   
            $found = TRUE;   
            $usertype = 'admin';
            $iden = 'AdminID';
            $pangkat = 2;
            exit;
        }
    }
    }
    if($found == FALSE){
    $sql = "SELECT * FROM manager WHERE ManagerID=?";
    if ($stmt = $sambungan->prepare($sql)) {
        $stmt->bind_param('s', $_POST['userid']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {   
            $found = TRUE;  
            $usertype = 'manager';
            $iden = 'ManagerID';
            $pangkat = 3;
            exit;
        }
    }
    }
$ik = $_SESSION['Status'];
    if($found == TRUE){
        if($pangkat == 1){
        $sql = "delete from '$usertype' where '$iden' = '$userid'";
        $result = mysqli_query($sambungan, $sql);
        echo "<script>alert('Delete $usertype Account successful')</script>";   
        }

    else{
        echo "<script>alert('ID is not registered in our system')</script>";
    }      
    
    } 
}

$sambungan->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
<link rel="stylesheet" href="sss.css">
</head>
<body>
    <div class="AccountContainer">
        <form method="post">
       <div class="AccountContainer"> 
    <h1>Delete Account</h1>
    <input placeholder="Enter ID" class="input-field" type="text" name="userid">
    <button type="submit">Delete ID</button>
    </div>
        </form>
    </div>
</body>
</html>
