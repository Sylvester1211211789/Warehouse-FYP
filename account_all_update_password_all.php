<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sss.css">

</head>

<?php
include('sambung.php');
session_start();
require_once('bootstrap.php');

$ID = $_SESSION['ID']; 
$Name = $_SESSION['Name'];
$Status = $_SESSION['Status'];

if ($Status == 'admin') {
    $table = "admin";
    $column = "AdminID";
    $boo = 1;
} elseif ($Status == 'user') {
    $table = "users";
    $column = "UserID";
    $boo = 2;
} elseif ($Status == 'manager') {
    $table = "manager";
    $column = "ManagerID";
    $boo = 3;
}

$This = "SELECT * FROM $table WHERE $column = ?";
$stmt = $sambungan->prepare($This);
$stmt->bind_param("s", $ID);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $olderpassword = $row["Password"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST["New"]) and isset($_POST["Old"]) and isset($_POST["confirm"]) and !empty($_POST["New"]) and !empty($_POST["Old"]) and !empty($_POST["confirm"])) {
    
    $hash = password_hash($_POST["confirm"], PASSWORD_DEFAULT);
    
    $oldpassword = $_POST["Old"];
    $newpassword = $_POST["New"];
    $confirmpassword = $_POST["confirm"];
    $isPasswordCorrect = password_verify($oldpassword, $olderpassword);

    if($Status == 'admin'){
        $role = 'admin';
        $roles = "Admin";
    }   
    else if($Status == 'user'){
        $role = 'users';
        $roles = "User";       
    }
    else if($Status == 'manager'){
        $role = 'manager';
        $roles = "Manager";
    }
    if($isPasswordCorrect and $newpassword == $confirmpassword){
    $update = "UPDATE $role SET Password=? WHERE {$roles}ID='$ID'";
    $statement = $sambungan->prepare($update);
    $statement->bind_param('s', $hash);
    $result = $statement->execute();

    if ($result) {
        echo "<script>alert('Edit password successful')</script>";
    } else {
        echo "<script>alert('Edit password unsuccessful')</script>";
    }
    }
    elseif(!$isPasswordCorrect){
        echo "<script>alert('Old Password Incorrect!')</script>";
    }
    elseif($newpassword != $confirmpassword){
        echo "<script>alert('The New Password and Confirm Password is Not The Same!')</script>";
    }
    
}
    else {
    echo "<script>alert('Please fill up all the box!')</script>";
}
}

    
?>

<body>
<form method="post" >
    <title>Account Setting</title>
    <div class="AccountContainer"> 
    <h1>Update Password</h1>
    <input placeholder="Enter Old Password" class="input-field" type="text" name="Old">
    <input placeholder="Enter New Password" class="input-field" type="text" name="New">
    <input placeholder="Confirm Password" class="input-field" type="text" name="confirm">
    <button type="submit">Update password</button>
    </div>
    
</form>
    </body>
</html>