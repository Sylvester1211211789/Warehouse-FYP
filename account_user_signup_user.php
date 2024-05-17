<?php
require_once('bootstrap.php');
include('sambung.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fullname = $_POST["Fullname"];
    $Address = $_POST["Address"];
    $Phone_Number = $_POST["Phone_Number"];
    $Company_Name = $_POST["Company_name"]; 
    $Date = date("Y/m/d");
    $pass = $_POST["Password"];
    $conf = $_POST["Confirm_Password"];
    $Password = password_hash($_POST["Password"], PASSWORD_DEFAULT); 
    $Email = $_POST["Email"];
    if (empty($Fullname) || empty($Address) || empty($Phone_Number) || empty($Company_Name) || empty($Password) || empty($Email)) {
        echo "<script>alert('Please fill in all registration form.')</script>";
        echo "<script>window.location='http://localhost/warehouse/main?signup'</script>";   
        exit;
    }
    if ($conf != $pass) {
        echo "<script>alert('Password not match ! ')</script>";
        echo "<script>window.location='http://localhost/warehouse/main?signup'</script>";   
        exit;
    }
    $find = "SELECT MAX(CAST(SUBSTRING(UserID, 2) AS UNSIGNED)) AS Latest FROM users";
    $result = mysqli_query($sambungan, $find);
    $late = mysqli_fetch_assoc($result);
    $latest = $late['Latest'];
    $UserID = 'U' . str_pad($latest + 1, strlen($latest), '0', STR_PAD_LEFT);







    $exist = "SELECT * FROM users WHERE Email = ?";
    if ($stmt = $sambungan->prepare($exist)) {
        $stmt->bind_param('s', $Email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists. Please use other email or forget password to reset your password.')</script>";
            echo "<script>window.location='http://localhost/warehouse/u_signup'</script>";
            exit;
        } else {
            $insert = "INSERT INTO users (UserID, Fullname, Address, Phone_Number, Company_Name, Date, Password, Email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($sambungan, $insert);
            mysqli_stmt_bind_param($stmt, "ssssssss", $UserID, $Fullname, $Address, $Phone_Number, $Company_Name, $Date, $Password, $Email); 
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Sign up successful. Please check you email, we have send your ID to your email.)</script>";
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

        $mail->Subject = 'UserID';
        $mail->Body = 'Thanks for register account from our website. This is the ID for you to login : ' . $UserID;

        $mail->send();
           
            mysqli_stmt_close($stmt);
            mysqli_close($sambungan);

            echo "<script>window.location='http://localhost/warehouse/main?login'</script>";
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
    <link rel="stylesheet" href="signup_styles.css">
    <title>Signup Pages</title>
    <style>
     .sign-up-links {
  margin-left: 1px;
  font-size: 11px;
  text-decoration: underline;
  text-decoration-color: teal;
  color: teal;
  cursor: pointer;
  font-weight: 800;
    font-family: Helvetica, Arial, sans-serif;
}
        
.sign-up-label {
  margin: 0;
  font-size: 10px;
  color: #747474;
    font-family: Helvetica, Arial, sans-serif;
}
.page-links {
  text-decoration: underline;
  margin: 0;
  text-align: end;
  color: #747474;
  text-decoration-color: #747474;
}   
    
    </style>
</head>
<body>
        <div class="background-blur"></div>
    <div class="form-containers" style = "height:820px;">
        <p class="title">Register Account</p>
        <form class="form" method="post" id="registrationForm">
            <input placeholder="Name" class="input" type="text" name="Fullname" required>
            <input placeholder="Address" class="input" type="text" name="Address" required>
            <input placeholder="Phone Number" class="input" type="text" name="Phone_Number" pattern="\d{11}" title="Please input correct number" required>
            <input placeholder="Email" class="input" type="email" name="Email" required>
            <input placeholder="Company Name" class="input" type="text" name="Company_name" required>
            <input id="password" placeholder="Password (min. 8 characters, at least 1 uppercase, 1 lowercase, 1 number, and 1 special character)" class="input" type="password" name="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long" required>
            <input placeholder="Password Confirmation" class="input" type="password" name="Confirm_Password" required>
   <div>    
                            <p> Password must contain :</p>
            <div id="passwordRequirements" style="font-size:12px; margin-left:20px;">

                <div id="check0"><i class="far fa-check-circle"></i><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> At least 8 characters long.</div>
                <div id="check1"><i class="far fa-check-circle"></i><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> At least 1 number.</div>
                <div id="check2"><i class="far fa-check-circle"></i><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> At least 1 special symbol.</div>
                <div id="check3"><i class="far fa-check-circle"></i><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> At least 1 lowercase letter.</div>
                <div id="check4"><i class="far fa-check-circle"></i><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> At least 1 uppercase letter.</div>
            </div>
            </div> 

            <p class="page-links">
                <span class="sign-up-link"><a href="http://localhost/warehouse/u_reset_password" style="color:teal">Forgot Password?</a></span>
            </p>
            <button class="form-btn" type="submit">Register</button>
        </form>
        <p class="sign-up-label">
            Already have an account? <span class="sign-up-link"><a onclick="openForm()">Login</a></span>
        </p>
    </div>

    <script>

        function check() {
            var input = document.getElementById("password").value;
            input = input.trim();
            document.getElementById("password").value = input;

           if (input.length >= 8) {
                document.getElementById("check0").innerHTML = '<i class="far fa-check-circle" style="color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></i> At least 8 characters long.';
            } else {
                document.getElementById("check0").innerHTML = '<i class="far fa-check-circle" style="color: red;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></i> At least 8 characters long.';
            }

            if (input.match(/[0-9]/)) {
                document.getElementById("check1").innerHTML = '<i class="far fa-check-circle" style="color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></i> At least 1 number.';
            } else {
                document.getElementById("check1").innerHTML = '<i class="far fa-check-circle" style="color: red;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></i> At least 1 number.';
            }

            if (input.match(/[!@#$%^&*(),.?":{}|<>]/)) {
                document.getElementById("check2").innerHTML = '<i class="far fa-check-circle" style="color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></i> At least 1 special symbol.';
            } else {
                document.getElementById("check2").innerHTML = '<i class="far fa-check-circle" style="color: red;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></i> At least 1 special symbol.';
            }

            if (input.match(/[a-z]/)) {
                document.getElementById("check3").innerHTML = '<i class="far fa-check-circle" style="color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></i> At least 1 lowercase letter.';
            } else {
                document.getElementById("check3").innerHTML = '<i class="far fa-check-circle" style="color: red;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></i> At least 1 lowercase letter.';
            }

            if (input.match(/[A-Z]/)) {
                document.getElementById("check4").innerHTML = '<i class="far fa-check-circle" style="color: green;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></i> At least 1 uppercase letter.';
            } else {
                document.getElementById("check4").innerHTML = '<i class="far fa-check-circle" style="color: red;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></i> At least 1 uppercase letter.';
            }
        
            if (input.length >= 8) {
                document.getElementById("check0").style.color = "green";
                
            } else {
                document.getElementById("check0").style.color = "red";
            }
        
            if(input.match(/[0-9]/i)){
                document.getElementById('check1').style.color = "green";
            }
        else {
                document.getElementById("check1").style.color = "red";
            }
            if(input.match(/[!@#$%^&*(),.?":{}|<>]/)){
                document.getElementById("check2").style.color = "green";
            }
        else {
                document.getElementById("check2").style.color = "red";        
        
        }
             if(input.match(/[a-z]/) ){
                document.getElementById("check3").style.color = "green";
            }
        else {
                document.getElementById("check3").style.color = "red";        
        
        }           
              if(input.match(/[A-Z]/) ){
                document.getElementById("check4").style.color = "green";
            }
        else {
                document.getElementById("check4").style.color = "red";        
        
        }            
            
        }
        document.getElementById("password").addEventListener("input", check);
        
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            var password = document.getElementsByName("Password")[0].value;
            var confirmPassword = document.getElementsByName("Confirm_Password")[0].value;

            var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;

            if (!passwordPattern.test(password)) {
                alert("Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character.");
                event.preventDefault();
            } else if (password !== confirmPassword) {
                alert("Passwords do not match.");
                event.preventDefault(); 
            }
        });
    </script>
</body>
</html>