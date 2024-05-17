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

if($Previous == 'admin'){
    $update = "UPDATE admin SET Address=? WHERE AdminID='$use'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('s',$New);
    $role = 'admin';
}
    

elseif($Previous == 'user'){
    $update = "UPDATE users SET Address=? WHERE UserID='$use'";
    $binding = $sambungan->prepare($update);    
    $binding ->bind_param('s',$New);
    $role ='users';
}

elseif($Previous == ' manager'){
    $update = "UPDATE manager SET Address=? WHERE ManagerID='$use'";
    $binding = $sambungan->prepare($update);    
    $binding ->bind_param('s',$New);
    $role ='manager';

}
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
    <?php if($Previous == 'user'){ ?>
    <h1>Edit User Address</h1>
    <?php } elseif($Previous == 'admin'){ ?>
    <h1>Edit Admin Address</h1>
    <?php } elseif($Previous == 'manager'){ ?>
    <h1>Edit Manager Address</h1>  
     <?php } ?>
    <input placeholder="Enter User ID" class="input-field" type="text" name="userID">  
    <input placeholder="Enter New Address" class="input-field" type="text" name="New">
    <button type="submit">Update Address</button>
    </div>
</form>
    </body>
</html>
