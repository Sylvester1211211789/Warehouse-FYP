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
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}
    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if($Status == 'admin' and !empty($_POST["Fullname"]) and !empty($_POST["email"]) and !empty($_POST["PhoneNumber"])){
    $update = "UPDATE admin SET Fullname = ?, Email = ?, Phone_Number = ? WHERE AdminID='$ID'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('sss',$_POST["Fullname"],$_POST["email"],$_POST["PhoneNumber"]);
    $role = 'admin';
    if($binding->execute()){
        echo "<script>alert('Update Information Successful')</script>";
        $check_query = "SELECT Fullname FROM $Status WHERE {$role}ID='$ID'";
        $result = $sambungan->query($check_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentName = $row["Fullname"];
        } else {
            $currentName = "Unknown";
        }
    }
    else{
         echo "<script>alert('Update Information Unsuccessful')</script>";
    }
}
    elseif($Status == 'manager' and isset($_POST["Fullname"]) and isset($_POST["email"]) and isset($_POST["PhoneNumber"])){
    $update = "UPDATE manager SET Fullname = ?, Email = ?, Phone_Number = ? WHERE ManagerID='$ID'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('sss',$_POST["Fullname"],$_POST["email"],$_POST["PhoneNumber"]);
    $role = 'manager';
        if($binding->execute()){
        echo "<script>alert('Update Information Successful')</script>";
            $check_query = "SELECT Fullname FROM $Status WHERE {$role}ID='$ID'";
        $result = $sambungan->query($check_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentName = $row["Fullname"];
        } else {
            $currentName = "Unknown";
        }
    }
    else{
         echo "<script>alert('Update Information Unsuccessful')</script>";
    }
}
    elseif($Status == 'user' and isset($_POST["Fullname"]) and isset($_POST["email"]) and isset($_POST["PhoneNumber"]) and isset($_POST["companyname"]) and isset($_POST["address"])){
    $update = "UPDATE users SET Fullname = ?, Address=?, Phone_Number=?, Company_Name=?, Email = ? WHERE UserID='$ID'";
    $binding = $sambungan->prepare($update);
    $binding ->bind_param('sssss',$_POST["Fullname"],$_POST["address"],$_POST["PhoneNumber"],$_POST["companyname"],$_POST["email"]);
    $role = 'user';
        if($binding->execute()){
        echo "<script>alert('Update Information Successful')</script>";
            $check_query = "SELECT Fullname FROM $Status WHERE {$role}ID='$ID'";
        $result = $sambungan->query($check_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentName = $row["Fullname"];
        } else {
            $currentName = "Unknown";
        }
    }
    else{
         echo "<script>alert('Update Information Unsuccessful')</script>";
    }
}
    else{
        echo "<script>alert('Update Information Unsuccessful')</script>";
    }
} 

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
    
$sambungan->close();
?>
<body>
<form method="post" >
    <title>Account Setting</title>
       <div class="AccountContainer"> 
           
    <h1>Edit Name</h1>
    <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        if ($Status == 'admin' or $Status == 'manager') {
            echo"<label for='name'>Name:</label>";
            echo"<input type='text' class='input-field' id='name' name='Fullname' value = '".$row['Fullname']."'>";
            echo"<label for='email'>Email:</label>";
            echo"<input type='text' class='input-field' id='email' name='email' value = '".$row['Email']."'>";
            echo"<label for='phone'>Phone Number:</label>";
            echo"<input type='text' class='input-field' id='phone' name='PhoneNumber' value = '".$row['Phone_Number']."'>  ";     
            echo"<button type='submit'>Update Information</button>";
                
        }
        elseif($Status == 'user'){
            echo"<label for='name'>Name:</label>";
            echo"<input type='text' class='input-field' id='name' name='Fullname' value = '".$row['Fullname']."'>";
            echo"<label for='address'>Address:</label>";
            echo"<input type='text' class='input-field' id='address' name='address' value = '".$row['Address']."'>";
            echo"<label for='phone'>Phone Number:</label>";
            echo"<input type='text' class='input-field' id='phone' name='PhoneNumber' value = '".$row['Phone_Number']."'>  "; 
            echo"<label for='companyname'>Company Name:</label>";
            echo"<input type='text' class='input-field' id='companyname' name='companyname' value = '".$row['Company_Name']."'>  "; 
            echo"<label for='email'>Email:</label>";
            echo"<input type='text' class='input-field' id='email' name='email' value = '".$row['Email']."'>";    
            echo"<button type='submit'>Update Information</button>";
        }
    }}
    ?>
    </div>
</form>
    </body>
</html>

