<?php
require_once('bootstrap.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send_otp"])){
    $email = $_POST["email"];
    $ID = $_POST["Usernames"];

    include("sambung.php");
    $check_query = "SELECT * FROM Users WHERE UserID='$ID' AND Email='$email'";
    $result = mysqli_query($sambungan, $check_query);

    if(mysqli_num_rows($result) == 1) {
        $otp = rand(100000, 999999);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'crsstwarehouse@gmail.com'; 
        $mail->Password = 'pfrfgjjveyrbqeyx'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('crsstwarehouse@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'OTP for Password Reset';
        $mail->Body = 'Your OTP is: ' . $otp;

        $mail->send();

        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        echo "<script>alert('OTP sent successfully.')</script>";
    } else {
        echo "<script>alert('The provided UserID does not own the entered email. Please try again.')</script>";
    }
}

if(isset($_POST["submit"])){
    if(isset($_SESSION['otp'])){
        $enteredOTP = $_POST["otp"];
        $otp = $_SESSION['otp'];
        $email = $_SESSION['email'];

        if ($enteredOTP == $otp) {
            include("sambung.php"); 

            $ID = $_POST["Usernames"];
            $Email = $_POST["email"];
            $Pass = $_POST["password"];

            $sql = "UPDATE Users SET Password='$Pass' WHERE UserID='$ID' AND Email='$Email'";
            $result = mysqli_query($sambungan, $sql);

            if ($result) {
                echo "<script>alert('Password changed successfully.')</script>";
                echo "<script>window.location='user_login.php'</script>";
            } else {
                echo "<script>alert('Failed to change password. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('Incorrect OTP! Please try again.')</script>";
        }
    } else {
        echo "<script>alert('Please send OTP first.')</script>";
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
        <input placeholder="ID" class="input" type="text" name="Usernames" required>         
        <input placeholder="Email" class="input" type="email" name="email" required> 
        <input placeholder="New Password" type="password" class="input" name="password" required>       
        <div id="otpContainer">
            <input placeholder="OTP " type="text" id="otp" name="otp" class="input" required>
            <button type="button" id="send_otp">Request OTP</button>
        </div>

        <button type="submit" class="form-btn" name="submit">Reset Password</button>
    </form>
</div>

<script>
    document.getElementById("send_otp").addEventListener("click", function() {
        // Simulate sending OTP (replace with actual logic)
        setTimeout(function() {
            document.querySelector('form').submit();
        }, 1000); // Adjust timeout as needed
    });
</script>

</body>
</html>
