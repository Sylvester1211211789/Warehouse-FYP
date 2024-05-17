<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sss.css">

</head>

<?php
include('sambung.php');
session_start();
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}
require_once('bootstrap.php');
$ID = $_SESSION['ID'];
$Name = $_SESSION['Name'];
$Statuss = $_SESSION['Status'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $Product_Name = $_POST["Product_Name"];

if($Statuss == 'user'){
if(!empty($_POST["Product_Name"])) {
    $add = "INSERT into product (Product_Name,Date,UserID) VALUES (?,CURRENT_DATE,?)";
    $stmt = mysqli_prepare($sambungan, $add);
    mysqli_stmt_bind_param($stmt, "ss", $Product_Name, $ID);
    if (mysqli_stmt_execute($stmt)) {
         echo "<script>alert('Product added successful')</script>";
      } else {
         echo "<script>alert('Product added unsuccessful')</script>";
    }
}
else{
    echo "<script>alert('Please Fill Up The Empty Box!')</script>";
}
}

elseif($Statuss == 'admin'){
if(!empty($_POST["Product_Name"]) and !empty($_POST["userID"])) {
    $use = $_POST["userID"];
    $add = "INSERT into product (Product_Name,Date,UserID) VALUES (?,CURRENT_DATE,?)";
    $stmt = mysqli_prepare($sambungan, $add);
    mysqli_stmt_bind_param($stmt, "ss", $Product_Name, $use);
    if (mysqli_stmt_execute($stmt)) {
         echo "<script>alert('Product added successful')</script>";
      } else {
         echo "<script>alert('Product added unsuccessful')</script>";
    }
}
else{
    echo "<script>alert('Please Fill Up The Empty Box!')</script>";
}
}

}

    

$sambungan->close();
?>
<body>
<form method="post" >
    <title>Account Setting</title>
       <div class="AccountContainer"> 
    <?php if($Statuss == 'user'){ ?>
    <h1>Add Product</h1>
    <input placeholder="Enter Product Name" class="input-field" type="text" name="Product_Name">
    <?php } elseif($Statuss == 'admin'){ ?>
    <h1>Add User Product</h1>
    <input placeholder="Enter User ID" class="input-field" type="text" name="userID">
    <input placeholder="Enter Product Name" class="input-field" type="text" name="Product_Name">
    <?php } ?>
    <button type="submit">Add Product</button>
    </div>
</form>
    </body>
</html>
