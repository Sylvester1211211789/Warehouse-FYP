           <?php
    include('header.php');
    ?>
<?php
require_once('bootstrap.php');
include("sambung.php");

if(isset($_POST["submit"])){
    if(isset($_SESSION['email']) && isset($_SESSION['ID'])) {
        $email = $_SESSION['email'];
        $ID = $_SESSION['ID'];
        $Pass = $_POST["password"];
        $Pass2 = $_POST["password2"];
        $Pp = password_hash($_POST["password"], PASSWORD_DEFAULT);
        if ($Pass == $Pass2) {
            $sql = "UPDATE Users SET Password='$Pp' WHERE UserID='$ID' AND Email='$email'";
            $result = mysqli_query($sambungan, $sql);

            if ($result) {
                echo "<script>alert('Password changed successfully.'); window.location='http://localhost/warehouse/index.php?login'</script>";
            } else {
                echo "<script>alert('Failed to change password. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match! Please try again.')</script>";
        }
    } else {
        echo "<script>alert('Session variables not set. Please try again.')</script>";
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
            background-color: rgba(0,0,0,0.04);
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

        #passwordRequirements {
            font-size: 10px;
        }

        .requirement {
            display: flex;
            align-items: center;
        }

        .requirement svg {
            margin-right: 5px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passwordInput = document.getElementById("password");
            const requirements = document.querySelectorAll(".requirement");

            passwordInput.addEventListener("input", function () {
                const value = passwordInput.value;
                const checks = [
                    value.length >= 8,
                    /\d/.test(value),
                    /[!@#$%^&*(),.?":{}|<>]/.test(value),
                    /[a-z]/.test(value),
                    /[A-Z]/.test(value)
                ];

                requirements.forEach((requirement, index) => {
                    requirement.style.color = checks[index] ? "green" : "red";
                });
            });
        });
    </script>
</head>
<body>
<div class="form-container" id="ResetForm">
    <h1 class="title">Reset Password</h1>
    <form class="form" method="post">
        <input placeholder="New Password" id="password" type="password" class="input" name="password" required>
        <input placeholder="Confirmation Password" type="password" class="input" name="password2" required>
        
        <div id="passwordRequirements">
            <div class="requirement" id="check0">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> At least 8 characters long.
            </div>
            <div class="requirement" id="check1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> At least 1 number.
            </div>
            <div class="requirement" id="check2">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> At least 1 special symbol.
            </div>
            <div class="requirement" id="check3">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> At least 1 lowercase letter.
            </div>
            <div class="requirement" id="check4">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg> At least 1 uppercase letter.
            </div>
        </div>
        <button type="submit" class="form-btn" name="submit">Reset Password</button>
 
    </form>
</div>
</body>
</html>