<?php
require_once('bootstrap.php');
include("sambung.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST["submit"])){
    if(isset($_SESSION['otp'])){
        $enteredOTP = $_POST["otp"];
        $otp = $_SESSION['otp'];
        
        if ($enteredOTP == $otp) {
        echo "<script>alert('Success.'); window.location='http://localhost/warehouse/new_password'</script>";
        } else {
            echo "<script>alert('Incorrect OTP! Please try again.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <style>
        body {
            background-color: #1a1a1a;
            font-family: Arial, sans-serif;
        }

        .form-container {
            width: 350px;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 10px;
            padding: 20px 30px;
            margin: 50px auto;
        }

        .title {
            text-align: center;
            font-size: 28px;
 
            margin-bottom: 30px;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .input {
            border-radius: 20px;
            border: 1px solid #c0c0c0;
            padding: 12px 15px;
            flex: 1; /* Take remaining space */
        }

        .buttons-container {
            display: flex;
            gap: 10px;
        }

        #send_otp {
            flex-shrink: 0; /* Prevent shrinking */
            background-color: teal;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            cursor: pointer;
        }

        #send_otp:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        #otpContainer {
            display: flex;
            align-items: center; /* Center vertically */
        }

        #otpContainer label {
            font-weight: bold;
            margin-right: 10px;
        }

        .form-btn {
            background-color: teal;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            cursor: pointer;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .form-btn:active {
            box-shadow: none;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1 class="title">Reset Password</h1>
    
    <form class="form" method="post">               

            <input placeholder="OTP " type="text" id="otp" name="otp" class="input" required>



        <button type="submit" class="form-btn" name="submit">Next</button>
            <?php
    include('header.php');
    ?>
    </form>
    <?php
    include('loading.html');
    ?>
</div>



</body>
</html>
