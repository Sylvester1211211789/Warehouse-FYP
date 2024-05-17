<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}

$id = $_SESSION['ID'];
$Name = $_SESSION['Name'];

$pangkat = 0;
if (isset($_POST['userid'])){
    $ProductID = $_POST['ProductID'];
    $sql = "SELECT * FROM product WHERE ProductID=? and UserID='$id'";
    if ($stmt = $sambungan->prepare($sql)) {
        $stmt->bind_param('s', $ProductID);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {   
            $found = TRUE;
            exit;
        }
    }
    if($found == FALSE){
    $sql = "SELECT * FROM product WHERE ProductID=?";
    if ($stmt = $sambungan->prepare($sql)) {
        $stmt->bind_param('s', $_ProductID);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {   
            $found = TRUE;   
            $pangkat = 2;
            exit;
        }
    }
    }


    if($found == TRUE){
        $sql = "delete from product where ProductID = '$ProductID' ";
        $result = mysqli_query($sambungan, $sql);
        echo "<script>alert('Delete product successful')</script>";   
        }

    else{
        echo "<script>alert('Incorrect ID! Please enter another ID.')</script>";
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
    <h1>Delete Product</h1>
    <input placeholder="Enter Product ID" class="input-field" type="text" name="ProductID">
    <button type="submit">Delete Product</button>
    </div>
        </form>
    </div>
</body>
</html>
