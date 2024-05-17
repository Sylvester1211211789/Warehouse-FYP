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
} elseif ($Status == 'user') {
    $check_query = "SELECT * FROM users WHERE UserID= '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 2;
}
    elseif ($Status == 'manager') {
    $check_query = "SELECT * FROM manager WHERE ManagerID= '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 3;   
}
else{
    $boo = 0;
}

$sambungan->close();
?>
<body>
         <div class="AccountContainer">   
<form method="post">
    
    <title>Account Setting </title>

    <h1>Account Setting</h1>
    <?php
    if ($boo == 1) {
        ?>
        <table>
            <tr>
                <td><a href="http://localhost/warehouse/al_update_name">Edit Name</a></td>
            </tr>
                         <tr>
                <td><a href="http://localhost/warehouse/al_update_email">Change Email</a></td>
            </tr>  
            <tr>
                <td><a href="http://localhost/warehouse/al_update_password">Change Password</a></td>
            </tr>
                        <tr>
                <td><a href="http://localhost/warehouse/al_update_number">Change Phone Number</a></td>
            </tr>
        </table>
    <?php
    } elseif ($boo == 2) {
        ?>
        <table>
            <tr>
                <td><a href="http://localhost/warehouse/al_update_name">Edit Name</a></td>
            </tr>
            <tr>
                <td><a href="http://localhost/warehouse/u_update_address">Change Address</a></td>
            </tr>
            <tr>
                <td><a href="http://localhost/warehouse/u_update_company">Change Company Name</a></td>
            </tr>
             <tr>
                <td><a href="http://localhost/warehouse/al_update_email">Change Email</a></td>
            </tr>  
                        <tr>
                <td><a href="http://localhost/warehouse/al_update_number">Change Phone Number</a></td>
            </tr>
            <tr>
                <td><a href="http://localhost/warehouse/al_update_password">Change Password</a></td>
            </tr>


        </table>
        <?php
    } elseif ($boo == 3) {
        ?>
        <table>
             <tr>
                <td><a href="http://localhost/warehouse/al_update_name">Edit Name</a></td>
            </tr>
                         <tr>
                <td><a href="http://localhost/warehouse/al_update_email">Change Email</a></td>
            </tr>  
            <tr>
                <td><a href="http://localhost/warehouse/al_update_password">Change Password</a></td>
            </tr>
                        <tr>
                <td><a href="http://localhost/warehouse/al_update_number">Change Phone Number</a></td>
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
