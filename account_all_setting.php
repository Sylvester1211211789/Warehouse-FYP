<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();


if (!isset($_SESSION['Status']) || !isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {

    header("Location: http://localhost/warehouse/al_login");
    exit(); 
}

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
} elseif ($Status == 'manager') {
    $check_query = "SELECT * FROM manager WHERE ManagerID= '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 3;   
} else {
 
    $boo = 0;
}

$sambungan->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" type="text/css" href="sss.css">
</head>
<body>
    <div class="AccountContainer">
        <h1>Account Settings</h1>
        <form method="post">
            <table>
                <tr>
                    <td><a href="http://localhost/warehouse/al_profile">View Profile</a></td>
                </tr>
                <tr>
                    <td><a href="http://localhost/warehouse/al_other">Privacy Settings</a></td>
                </tr>


            </table>
        </form>
    </div>
</body>
</html>
