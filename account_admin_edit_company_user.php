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
require_once('bootstrap.php');
$ID = $_SESSION['ID'];
$Name = $_SESSION['Name'];
$Statuss = $_SESSION['Status'];
$Previous = $_SESSION['user'];
if(isset($_POST["New"]) and isset($_POST["userID"])) {
    $New = $_POST["New"];
    $use = $_POST["userID"];



    $update = "UPDATE users SET Company_Name=? WHERE UserID='$use'";
    $binding = $sambungan->prepare($update);    
    $binding ->bind_param('s',$New);
    $role ='users';


    if($binding->execute()){
        echo "<script>alert('Edit Email successful')</script>";

    } else {
        echo "<script>alert('Edit name unsuccessful')</script>";
    }
}
    

$sambungan->close();
?>
<body>
<form method="post" >
    <title>Account Setting</title>
       <div class="AccountContainer"> 

    <h1>Edit User Company</h1>

    <input placeholder="Enter User ID" class="input-field" type="text" name="userID">  
    <input placeholder="Enter New Address" class="input-field" type="text" name="New">
    <button type="submit">Update Company</button>
    </div>
</form>
    </body>
</html>
