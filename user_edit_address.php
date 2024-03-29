<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php

include('sambung.php');
session_start();

$ID = $_SESSION['ID']; 
$Name = $_SESSION['Name'];
$Status = $_SESSION['Status'];

$check = "SELECT Address FROM users WHERE UserID='$ID'";
$result = $sambungan->query($check);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentAddress = $row["Address"];
} else {
    $currentAddress= "Unknown";
}

if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $update = "UPDATE users SET Address='$New' WHERE UserID='$ID'";
    $result = $sambungan->query($update);

    if ($result) {
        echo "<script>alert('Edit address successful')</script>";
        $currentAddress = $New;
    } else {
        echo "<script>alert('Edit address unsuccessful')</script>";
    }
} 

$sambungan->close();
?>
<body>
<form method="post" >
    <title>Account Setting</title>
       <div class=""> 
    <h1>Change Address</h1>
    <p>Current Address: <?php echo $currentAddress; ?></p>
    <input placeholder="Enter New address" class="" type="text" name="New">
    <button type="submit">Update Address</button>
    </div>
    
</form>
    </body>
</html>