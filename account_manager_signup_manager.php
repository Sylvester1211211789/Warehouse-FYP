
<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fullname = $_POST["Fullname"];
    $Date =  date("Y/m/d");
    $pass = $_POST["Password"];
    $conf = $_POST["Confirm_Password"];
    $Password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
    $Email = $_POST["Email"];
    $Phone_Number = $_POST["Phone_Number"];   
    
    if ( empty($Fullname) || empty($Phone_Number) || empty($Password) || empty($Email)) {
        echo "<script>alert('Please fill in all registration form.')</script>";
        echo "<script>window.location='http://localhost/warehouse/m_signup'</script>";   
        exit;
    }
    if ($conf != $pass) {
        echo "<script>alert('Password not match ! ')</script>";
        echo "<script>window.location='http://localhost/warehouse/u_signup'</script>";   
        exit;
    } 
    $find = "SELECT MAX(CAST(SUBSTRING(ManagerID, 2) AS UNSIGNED)) AS Latest FROM Manager";
    $result = mysqli_query($sambungan, $find);
    $late = mysqli_fetch_assoc($result);
    $latest = $late['Latest'];

    if ($latest === null) {
        $latest = 0;
    }

    $ManagerID = 'M' . str_pad($latest + 1, 2, '0', STR_PAD_LEFT);
    
  
    
    
    $exist = "SELECT * FROM manager WHERE Email=?";
    if ($stmt = $sambungan->prepare($exist)) {
        $stmt->bind_param('s', $_POST['Email']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists! Please use other email or reset password')</script>";
            echo "<script>window.location='http://localhost/warehouse/m_signup'</script>";
            exit;
        } else {
            $insert = "INSERT INTO manager(ManagerID, Fullname, Phone_Number, Date, Password, Email) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($sambungan, $insert);
            mysqli_stmt_bind_param($stmt, "ssssss", $ManagerID, $Fullname,  $Phone_Number, $Date, $Password, $Email); // corrected parameter name

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Sign up successful! The ManagerID had sended to the admin email.')</script>";
            } else {
                echo "<script>alert('Signup unsuccessful')</script>";
            }
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
        $mail->addAddress($Email);
        $mail->isHTML(true);

        $mail->Subject = 'ManagerID';
        $mail->Body = 'Thanks for register account from our website. This is the ID for you to login : ' . $ManagerID;

        $mail->send();   
            mysqli_stmt_close($stmt);
            mysqli_close($sambungan);

            echo "<script>window.location='http://localhost/warehouse/m_signup'</script>";
            exit;
        }
    }   
}
?>



<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="signup_style.css">   
    <title>Signup Pages</title>
</head>
<body >



    
    
 <div class="form-container">
      <p class="title">Register Manager Account</p>
      <form class="form" method="post">         
      <input placeholder="Name" class="input" type="text" name="Fullname" >    
<input placeholder="Phone Number" class="input" type="text" name="Phone_Number" pattern="\d{11}" title="Please input correct number" required>
      
      <input placeholder="Email" class="input" type="email" name="Email"> 
   
<input placeholder="Password (min. 8 characters, at least 1 uppercase, 1 lowercase, 1 number, and 1 special character)" class="input" type="password" name="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Password must contain number, uppercase letter, lowercase letter, special character, and be at least 8 characters long" required>
   <input placeholder="Password Confirmation" class="input" type="Password" name="Confirm_Password">           
          
          
          
        <p class="page-link">
            <span class="page-link-label" ><a href="http://localhost/warehouse/u_reset_password">Forgot Password?</a></span>
        </p>
        <button class="form-btn" type="submit">Register</button>
      </form>
      <p class="sign-up-label">
          Don't have an account?<span class="sign-up-link" ><a href="http://localhost/warehouse/al_login">Login</a></span>
      </p>

    </div>

</body>
</html>