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


if ($Status == 'admin' || $Status == 'manager') {
    $boo = 1;
} elseif ($Status == 'user') {
    $boo = 2; 
} else {
 
    $boo = 0;
}

$sambungan->close();
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More Payment</title>
    <link rel="stylesheet" type="text/css" href="sss.css">
</head>
<body>
    <div class="AccountContainer">
        <h1>More Payment</h1>
        <form  method="post">
            <?php if($boo==2){?>
            <table>
                <tr>
                    <td><a href="http://localhost/warehouse/u_pay_payment">Payment</a></td>
                </tr>
                <tr>
                    <td><a href="http://localhost/warehouse/u_history_payment">Payment History</a></td>
                </tr>

            </table>
             <?php } elseif($boo== 1){ ?>
                        <table>
                <tr>
                    <td><a href="http://localhost/warehouse/am_edit_payment">Edit User Payment</a></td>
                </tr>
                <tr>
                    <td><a href="http://localhost/warehouse/am_history_payment">Payment List</a></td>
                </tr>

            </table>
            <?php } ?>
        </form>
    </div>
</body>
</html>
