<?php
include('sambung.php');
session_start();


if (!isset($_SESSION['Status']) || !isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {

    header("Location: user_login.php");
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More Payment</title>
    <link rel="stylesheet" type="text/css" href="style_account.css">
</head>
<body>
    <div class="AccountContainer">
        <h1>More Payment</h1>
        <form action="account_setting.php" method="post">
            <?php if($boo==2){?>
            <table>
                <tr>
                    <td><a href="payment.php">Payment</a></td>
                </tr>
                <tr>
                    <td><a href="payment_history.php">Payment History</a></td>
                </tr>

            </table>
             <?php } elseif($boo== 1){ ?>
                        <table>
                <tr>
                    <td><a href="profile.php">Edit User Payment</a></td>
                </tr>
                <tr>
                    <td><a href="user_payment_list.php">Payment List</a></td>
                </tr>

            </table>
            <?php } ?>
        </form>
    </div>
</body>
</html>
