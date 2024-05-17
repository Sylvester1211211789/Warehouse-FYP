<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

    <link rel="stylesheet" type="text/css" href="sss.css">
</head>
<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
$Status = $_SESSION['Status'];
$ids =  $_SESSION['ID'];
$Name = $_SESSION['Name'];
$boo = 0;
if ($Status == 'admin') {
    $check_query = "SELECT * FROM admin WHERE AdminID = '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 1;
}
else{
    $boo = 0;
}
    
$_SESSION['user'] = NULL;

if (isset($_POST['edit_user'])) {

    $_SESSION['user']='user'; 
    header("Location: http://localhost/warehouse/edit");
    exit();
} elseif (isset($_POST['edit_admin'])) {

    $_SESSION['user']='admin'; 
    header("Location: http://localhost/warehouse/edit");
    exit();
} elseif (isset($_POST['edit_manager'])) {
    $_SESSION['user']='manager'; 
    header("Location: http://localhost/warehouse/edit");
    exit();
}
$sambungan->close();
?>
<body>
         <div class="A">   
<form method="post">
    
    <title>Account Setting </title>

    <h1>Account Setting</h1>
    <?php
    if ($boo == 1) {
        ?>
        <table>
            <tr>
            <td>  <a href="http://localhost/warehouse/a_list_account">Account List</a></td></tr>
            <tr>        
                <td><button type="submit" name="edit_user">Edit User Account</button></td>
            </tr>
                         <tr>
                <td><button type="submit" name="edit_admin">Edit Admin Account</button></td>
            </tr>  
            <tr>
                <td><button type="submit" name="edit_manager">Edit Manager Account</button></td>
            </tr>
            
        </table>
    <?php
    } else {
        echo "error";
    }
    ?>

</form>
                 </div>
    </body>
    
</html>
