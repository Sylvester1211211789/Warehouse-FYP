<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();


if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}

$Status = $_SESSION['Status'];
$ids =  $_SESSION['ID'];
$Name = $_SESSION['Name'];
$boo = 0;


if ($Status == 'admin' ) {
    $boo = 2;
} 
 else {
 
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
    <link rel="stylesheet" type="text/css" href="sss.css">
</head>
<body>
    <div class="AccountContainer">
        <h1>More Block</h1>
        <form  method="post">
            <?php if($boo==2){?>
            <table>
                <tr>
                    <td><a href="http://localhost/warehouse/a_block_add">Add Block</a></td>
                </tr>
                <tr>
                    <td><a href="http://localhost/warehouse/a_block_edit_name">Edit Block</a></td>
                </tr>
                <tr>
                      <td><a href="http://localhost/warehouse/a_block_delete">Delete Block</a></td>                  
                </tr>

            </table>
            <?php }?>
        </form>
    </div>
</body>
</html>
