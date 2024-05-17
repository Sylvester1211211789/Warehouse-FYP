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
$email = $_SESSION['Email'];
if($Status == "admin"){
if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $currentName = $New;
    $update = "UPDATE admin SET Email=? WHERE AdminID='$ID'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('s',$New);


    if ($binding->execute()) {
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

    $update = "UPDATE manager SET Email=? WHERE ManagerID='$ID'";
    $binding = $sambungan->prepare($update);    
    $binding ->bind_param('s',$New);

    if ($binding->execute()) {
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
    $update = "UPDATE users SET Email=? WHERE UserID='$ID'";
    $binding = $sambungan->prepare($update);    
    $binding ->bind_param('s',$New);

    if ($binding->execute()) {
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
       <div class="AccountContainer"> 
    <h1>Change Email</h1>
    <p>Current Email: <?php echo $currentName; ?></p>
    <input placeholder="Enter New Email" class="input-field" type="email" name="New">
    <button type="submit">Update Email</button>
    </div>
    
</form>
    </body>
</html>