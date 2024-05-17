<?php

require_once('bootstrap.php');
include('sambung.php');
session_start();


if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    $is = 0;

}
else{
    if($_SESSION['Status'] == 'user'){
    $is = 1;}
    else if ($_SESSION['Status'] == 'admin'){
        $is = 2;}
        else if ($_SESSION['Status'] == 'manager'){
        $is = 3;}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Warehouse</title>
    <style>
        body {
            margin: 0;
            font-family: Helvetica, Arial, sans-serif;
        }

        .headers {
            background-color: #005baa;
            height: 90px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .headers p {
            float: left;
            font-size: 24px;
            color: white;
            margin: 0;
            padding: 30px;
        }

        .headers a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 30px 20px;
            font-size: 18px;
            text-decoration: none;
        }

        .headers a:hover {
            background-color: #ddd;
            color: black;
        }

        .headerdrop {
            float: left;
            position: relative;
        }

        .headerdrop .headerdropbtn {
            font-size: 18px;
            border: none;
            outline: none;
            color: white;
            padding: 30px 20px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .headerdropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1001;
        }

        .headerdropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .headerdropdown-content a:hover {
            background-color: #ddd;
        }

        .headerdrop:hover .headerdropdown-content {
            display: block;
        }

        .headernavbar-right {
            float: right;
        }

    </style>
</head>
<body>
    <div class="headers">
        <p>CRSST</p>
        <a href="http://localhost/warehouse/Mains">Home</a>
        <a href="http://localhost/warehouse/u_inoutbound">Control</a>
        <div class="headerdrop">
            <button class="headerdropbtn">More</button>
            <div class="headerdropdown-content">
<?php if ($is == 1) { ?>  
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound History</a>
<?php } elseif ($is == 2) { ?>      
  <a href="http://localhost/warehouse/a_signup">Signup Admin Account</a>
  <a href="http://localhost/warehouse/m_signup">Signup Manager Account</a>
  <a href="http://localhost/warehouse/a_list_account">Manage Account </a>
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
  <a href="http://localhost/warehouse/a_block_more">Block</a>
<?php } elseif ($is == 3) { ?>        
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
<?php } else { ?>        
  <a href="http://localhost/warehouse/more_payment">Payment</a>
  <a href="http://localhost/warehouse/all_inoutbound_history">In/Outbound List</a>
<?php } ?>
            </div>
        </div>
        <div class="headernavbar-right">
            <?php if($is == 0){ ?>
              <a href ="al_login">Login</a>
             <a href="u_signup">Signup</a>            
            <?php } else { ?>
              <a href="al_logout.php">Logout</a>  
              <a href="http://localhost/warehouse/al_profile">Profile</a>            
            <?php } ?>  

        </div>
    </div>
</body>
</html>
