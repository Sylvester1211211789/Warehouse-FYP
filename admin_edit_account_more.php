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
$pangkat = $_SESSION['user'];
$boo = 0;
if ($Status == 'admin') {
    $check_query = "SELECT * FROM admin WHERE AdminID = '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 1;
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
    if ($pangkat == 'user') {
        ?>
        <table>
            <tr>
                <td><a href="http://localhost/warehouse/a_edit_company">Edit User Company</a></td>
            </tr>
                         <tr>
                <td><a href="http://localhost/warehouse/a_edit_address">Edit User Address</a></td>
            </tr>  
            <tr>
                <td><a href="http://localhost/warehouse/a_edit_email">Edit User Email</a></td>
            </tr>
        </table>
     <?php }
    elseif ($pangkat == 'manager') {
        ?>
        <table>
                         <tr>
                <td><a href="http://localhost/warehouse/a_edit_address">Edit Manager Address</a></td>
            </tr>  
            <tr>
                <td><a href="http://localhost/warehouse/a_edit_email">Edit Manager Email</a></td>
            </tr>
        </table>
     <?php }
    elseif ($pangkat == 'admin') {
        ?>
        <table>
                         <tr>
                <td><a href="http://localhost/warehouse/a_edit_address">Edit Admin Address</a></td>
            </tr>  
            <tr>
                <td><a href="http://localhost/warehouse/a_edit_email">Edit Admin Email</a></td>
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
