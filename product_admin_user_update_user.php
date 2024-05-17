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
if(isset($_POST["New"]) and isset($_POST["userID"])) {
    $ProductID = $_POST["ProductID"];
    $Product_Name = $_POST['Product_Name'];
if($Statuss == 'user'){
    $add = "UPDATE product set Product_Name=? WHERE ProductID = '$ProductID' and UserID ='$ID'";
    $stmt = mysqli_prepare($sambungan, $add);
    mysqli_stmt_bind_param($stmt, "s", $Product_Name);
}
    

elseif($Statuss == 'admin'){
    $add = "UPDATE product set Product_Name=? WHERE ProductID = '$ProductID'";
    $stmt = mysqli_prepare($sambungan, $add);
    mysqli_stmt_bind_param($stmt, "s", $Product_Name);
}

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Product Name edit successful')</script>";
            } else {
                echo "<script>alert('Product Name edit unsuccessful')</script>";
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
    <?php } elseif($Statuss == 'admin'){ ?>
    <h1>Add User Product</h1>
    <?php } ?>          
    <input placeholder="Enter Product ID" class="input-field" type="text" name="ProductID">  
    <input placeholder="Enter Product Name" class="input-field" type="text" name="Product_Name">

    <button type="submit">Add Product</button>
    </div>
</form>
    </body>
</html>
