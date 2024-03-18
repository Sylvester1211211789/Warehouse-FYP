<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();

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
        .form {
    margin: 0 auto;
    width: 300px;
    padding: 20px;
    background-color: #171717;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.form p#heading {
    text-align: center;
    margin: 0;
    color: white;
    font-size: 1.2em;
    margin-bottom: 20px;
}

.field {
    display: flex;
    align-items: center;
    gap: 10px;
}

.input-icon {
    height: 20px;
    width: 20px;
    fill: white;
}

.input-field {
    flex: 1;
    background: none;
    border: none;
    outline: none;
    color: #d3d3d3;
    padding: 10px;
    border-radius: 5px;
}

.button {
    padding: 10px 20px;
    border: none;
    outline: none;
    background-color: #252525;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #333333;
}

    </style>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php if(!isset($_SESSION['otp'])) { ?>

        <form class="form" action="reset_password.php" method="post">
            <p id="heading">Reset Password</p>
            <div class="field">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                </svg>
                <input placeholder="ID" class="input-field" type="text" name="Usernames" required>
            </div>
            <div class="field">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                </svg>
                <input placeholder="Email" class="input-field" type="email" name="email" required>
            </div>
    
            <button class="button" type="submit" name="send_otp">Send OTP</button>
        </form>
    <?php } else { ?>
                <p id="heading">Reset Password</p>

        <form class="form" action="reset_password.php" method="post">
            <div class="field">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                </svg>
                <input placeholder="OTP" class="input-field" type="text" name="otp" required>
            </div>
            <div class="field">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                </svg>
                <input placeholder="Password" class="input-field" type="password" name="password" required>
            </div>

            <button class="button" type="submit" name="submit">Submit</button>
        </form>
    <?php } ?>
</body>
</html>

