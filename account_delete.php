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
    $sql = "SELECT * FROM users";
    $result = mysqli_query($sambungan, $sql);
    $found = FALSE;
    while($users = mysqli_fetch_array($result)){
        if($users['UserID']==$userid){
            $found = TRUE;   
            $pangkat = 1;
            break;
        }
    }
    if($found == FALSE){
        $sql = "SELECT * FROM admin";
        $result = mysqli_query($sambungan, $sql);      
        while($admin = mysqli_fetch_array($result)){
            if($admin['AdminID']==$userid){
                $found = TRUE; 
                $pangkat =2;
                break;
            }
        }
    }
    if($found == FALSE){
        $sql = "SELECT * FROM manager";
        $result = mysqli_query($sambungan, $sql);      
        while($admin = mysqli_fetch_array($result)){
            if($admin['ManagerID']==$userid){
                $found = TRUE; 
                $pangkat = 3;
                break;
            }
        }
    }
$ik = $_SESSION['Status'];
    if($found == TRUE){
        if($pangkat == 1){
        $sql = "delete from users where UserID = '$userid'";
        $result = mysqli_query($sambungan, $sql);
        echo "<script>alert('Delete User Account successful')</script>";   
        }
        elseif($pangkat == 2){
        $sql = "delete from admin where AdminID = '$userid'";
        $result = mysqli_query($sambungan, $sql);
        echo "<script>alert('Delete Admin Account successful')</script>";   
        }
        elseif($pangkat == 3){
        $sql = "delete from admin where ManagerID = '$userid'";
        $result = mysqli_query($sambungan, $sql);
        echo "<script>alert('Delete Manager Account successful')</script>";       
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
</head>
<body>
    <div class="">
        <form method="post">
       <div class=""> 
    <h1>Delete Account</h1>
    <input placeholder="Enter ID" class="" type="text" name="userid">
    <button type="submit">Delete ID</button>
    </div>
        </form>
    </div>
</body>
</html>
