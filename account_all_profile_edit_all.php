<?php include('header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

    <style>
/* Resetting default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: lightgray;
    color: black;
}

/* Account container */
.AccountContainer {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 80px;
}

/* Profile styles */
.Profile {
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 8px;
    background-color: white;
}

.AccountContainer h1 {
text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

.Profile .ProfilePic {
    width: 100px;
    height: 100px;
    margin-left: 40%;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 20px;
}

.Profile .ProfilePic img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.Profile a.s {
    float: right;
    font-size: 13px;
    color: #007bff;
    text-decoration: none;
}

.Profile a.s:hover {
    text-decoration: underline;
}

/* Additional styling for specific elements */
/* You can add more specific styles if needed */

        

/* Button styles */
button[type="submit"] {
    background-color: #007bff;
    margin-left: 9%;
    color: #fff;
    padding: 10px 20px;
    border: none;
    width:80%;
    border-radius: 4px;
    cursor: pointer;
    align-content: center;
    text-align: center;
    margin-top: 30px;
}
        button[type="submits"] {
    background-color: #007bff;
    margin-left: -1%;
    color: #fff;
    padding: 10px 20px;
    border: none;
    width:80%;
    border-radius: 4px;
    cursor: pointer;
    align-content: center;
    text-align: center;
    margin-top: 30px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}
/* Center align the button */
.button-container {
    text-align: center;
}

         .Profile td {
     padding: 2px;
     vertical-align: middle;
 }
        
.users1{
background-color: white;
position: absolute;
 pointer-events: none;
 transform: translateY(1rem);
 transform: translateY(-50%) scale(0.8);
 padding: 0 .2em;
 color:grey;
    
            
        }
/* Additional styling for specific elements */
/* You can add more specific styles if needed */
.input {
 margin-bottom: 20px;
 border: solid 1.5px lightgrey;
 border-radius: 1rem;
 background: none;
 padding: 10px;
 font-size: 1rem;
 width: 230%;
    height:20%;
 color: black;
 transition: border 150ms cubic-bezier(0.4,0,0.2,1);
}

.input:focus, input:valid {
 outline: none;
 border: 1.5px solid lightgrey;
}

.input:focus ~ label, input:valid ~ label {
 transform: translateY(-50%) scale(0.8);
 background-color: #212121;
 padding: 0 .2em;
 color: #2196f3;
}

        .input:focus{
            border: 1.5px solid blue;
        }
    </style>

</head>

<?php
    require_once('bootstrap.php');
include('sambung.php');
$Status = $_SESSION['Status'];
$ids =  $_SESSION['ID'];
$Name = $_SESSION['Name'];
$boo = 0;
if ($Status == 'admin') {
    $check_query = "SELECT * FROM admin WHERE AdminID = '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 1;
} elseif ($Status == 'user') {
    $check_query = "SELECT * FROM users WHERE UserID= '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 2;
}
elseif ($Status == 'manager') {
    $check_query = "SELECT * FROM manager WHERE ManagerID= '$ids'";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 3;
}   
else{
    $boo = 0;
}


?>
    <body>
<form  method="post">
    <title>Account </title>
        <div class="AccountContainer">
            
    <h1>Account </h1>
    <?php
    if ($result ->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($Status == 'admin'){
         
            ${"value1_" . $row["AdminID"]} = $row["Fullname"];
            ${"value2_" . $row["AdminID"]} = $row["Email"];
            ${"value3_" . $row["AdminID"]} = $row["Phone_Number"];            
            echo "<div class='Profile'>";
            echo "<div class='ProfilePic'><img src='ios.png' alt='Profile Picture'></div>";     
            echo "<table><tr><td>
            <label class ='users1' for='value1_" . $row["AdminID"] . "'>   ID : </label>
            <div class='form'><input class='input' type='text' name='value1" . $row["AdminID"] . "' value='" . $row["AdminID"] . "' readonly></div></td></tr>";
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["AdminID"] . "'>Name : </label><div class='form'><input class='input' type='text' name='value2" . $row["AdminID"] . "' value='" . $row["Fullname"] . "'></div></td></tr>";
            echo "<tr><td>           
            <label class ='users1' for='value1_" . $row["AdminID"] . "'>Email : </label><div class='form'><input class='input' type='text' name='value3" . $row["AdminID"] . "' value='" . $row["Email"] . "'></div></td></tr>";
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["AdminID"] . "'>Phone Number : </label><div class='form'><input class='input' type='text' name='value4" . $row["AdminID"] . "' value='" . $row["Phone_Number"] . "'></div></td></tr>";           
            echo "</table><div class='button-container'>
            <button type='submits' name='editadmin' value='" . $row['AdminID'] . "'>Edit</button></div>";

            }
            
            elseif($Status == 'user'){
            ${"value1_" . $row["UserID"]} = $row["Fullname"];
            ${"value2_" . $row["UserID"]} = $row["Address"];
            ${"value3_" . $row["UserID"]} = $row["Email"];
            ${"value4_" . $row["UserID"]} = $row["Phone_Number"];
            ${"value5_" . $row["UserID"]} = $row["Company_Name"];           
            echo "<div class='Profile'>";
            echo "<div class='ProfilePic'><img src='ios.png' alt='Profile Picture'></div>";     
            echo "<table><tr><td><label class ='users1' for='value1_" . $row["UserID"] . "'>   ID : </label>
            <div class='form'><input class='input'  name='value1" . $row["UserID"] . "' value='" . $row["UserID"] . "' readonly></div></td></tr>";
           
            echo "<td><tr><td>            
            <label class ='users1' for='value1_" . $row["UserID"] . "'>Name : </label><div class='form'><input class='input' name='value2" . $row["UserID"] . "' value='" . $row["Fullname"] . "'></div></td></tr>";
           
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["UserID"] . "'>Address : </label><div class='form'><input class='input'  name='value3" . $row["UserID"] . "' value='" . $row["Address"] . "'></div></td></tr>";
                
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["UserID"] . "'>Email : </label><div class='form'><input class='input'  name='value4" . $row["UserID"] . "' value='" . $row["Email"] . "'></div></td></tr>";  
                
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["UserID"] . "'>Phone Number: </label><div class='form'><input class='input'  name='value5" . $row["UserID"] . "' value='" . $row["Phone_Number"] . "'></div></td></tr>";
                
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["UserID"] . "'>Company Name : </label><div class='form'><input class='input'  name='value6" . $row["UserID"] . "' value='" . $row["Company_Name"] . "'></div></td></tr></table>";
                
            echo "<td><button type='submit' name='edituser' value='" .$row["UserID"]. "'>Edit</button></td>";
           
            }
            if($Status == 'manager'){
            ${"value1_" . $row["ManagerID"]} = $row["Fullname"];
            ${"value2_" . $row["ManagerID"]} = $row["Email"];
            ${"value3_" . $row["ManagerID"]} = $row["Phone_Number"];
            
            echo "<table><tr><td>            
            <label class ='users1' for='value1" . $row["ManagerID"] . "'>ID : </label><div class='form'><input class='input' type='text' name='value1"  . $row["ManagerID"] .  "' value='" . $row["ManagerID"] . "' readonly></div></td></tr>";
            echo "<tr><td>            
            <label class ='users1' for='value2" . $row["ManagerID"] . "'>Name : </label><div class='form'><input class='input' type='text' name='value2"  . $row["ManagerID"] .  "' value='" . $row["Fullname"] . "'></div></td></tr>";
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["ManagerID"] . "'>Email : </label><div class='form'><input class='input' type='text' name='value3"  . $row["ManagerID"] .  "' value='" . $row["Email"] . "'></div></td></tr>";
            echo "<tr><td>            
            <label class ='users1' for='value1_" . $row["ManagerID"] . "'>Phone Number : </label><div class='form'><input class='input' type='text' name='value4"  . $row["ManagerID"] .  "' value='" . $row["Phone_Number"] . "'></div></td></tr></table>";           
            echo "<td><button type='submit' name='editmanager' value='" .$row["ManagerID"]. "'>Edit</button></td>";

            }
        }
    } else {
        echo "0 results";
    }
    ?>
    </div>
</form>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){ // Check if the form is submitted via POST
    if(isset($_POST["editadmin"])) {
        // Retrieve the values sent by the edit button
        $userID = $_POST["editadmin"];
        $value1 = $_POST['value1' . $userID];
        $value2 = $_POST['value2' . $userID];
        $value3 = $_POST['value3' . $userID];
        $value4 = $_POST['value4' . $userID];
        
        // Validate and sanitize input here if necessary
        
        if(${"value1_" . $userID} != $value2 or ${"value2_" . $userID} != $value3 or ${"value3_" . $userID} != $value4){
            // Update user information using prepared statement
            $update_query = "UPDATE admin SET Fullname=?, Email=?, Phone_Number=? WHERE AdminID=?";
            $stmt = $sambungan->prepare($update_query);
            
            // Bind parameters
            $stmt->bind_param("ssss", $value2, $value3, $value4, $userID);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Edit Successful')</script>";
                echo "<script>window.location.reload();</script>";
            } else {
                echo "<script>alert('Edit Unsuccessful')</script>";
            }
            
            // Close the prepared statement
            $stmt->close();
        }
    }
elseif(isset($_POST["edituser"])) {
    $userID = $_POST["edituser"];
    $value1 = $_POST['value1' . $userID];
    $value2 = $_POST['value2' . $userID];
    $value3 = $_POST['value3' . $userID];
    $value4 = $_POST['value4' . $userID];
    $value5 = $_POST['value5' . $userID];
    $value6 = $_POST['value6' . $userID];
    
    if(${"value1_" . $userID} != $value2 or ${"value2_" . $userID} != $value3 or ${"value3_" . $userID} != $value4 or ${"value4_" . $userID} != $value5 or ${"value5_" . $userID} != $value6){
        $update = "UPDATE users SET Company_Name=?, Fullname=?, Address=?, Phone_Number=?, Email=? WHERE UserID=?";
        $binding = $sambungan->prepare($update);
        
        // Bind parameters
        $binding->bind_param("ssssss", $value6, $value2, $value3, $value5, $value4, $userID);
        
        if ($binding->execute()) {
            echo "<script>alert('Edit Successful')</script>";
            echo "<script>window.location.reload();</script>";
            echo "<script>window.location='http://localhost/warehouse/al_profile'</script>";
        } else {
            echo "<script>alert('Edit Unsuccessful')</script>";
        }
        
        // Close the prepared statement
        $binding->close();
        
        // Close the MySQLi connection after executing all queries
        $sambungan->close();
    }
}

elseif(isset($_POST["editmanager"])) {
    // Retrieve the values sent by the edit button
    $userID = $_POST["editmanager"];
    $value1 = $_POST['value1' . $userID];
    $value2 = $_POST['value2' . $userID];
    $value3 = $_POST['value3' . $userID];
    $value4 = $_POST['value4' . $userID];
    
    if(${"value1_" . $userID} != $value2 or ${"value2_" . $userID} != $value3 or ${"value3_" . $userID} != $value4){
        $update = "UPDATE manager SET Fullname=?, Email=?, Phone_Number=? WHERE ManagerID=?";
        $binding = $sambungan->prepare($update);
        // Bind parameters
        $binding->bind_param("ssss", $value2, $value3, $value4, $userID);
        
        if ($binding->execute()) {
            echo "<script>alert('Edit Successful')</script>";
            echo "<script>window.location.reload();</script>";
        } else {
            echo "<script>alert('Edit Unsuccessful')</script>";
        }
        
        // Close the prepared statement
        $binding->close();
        
        // Close the MySQLi connection after executing all queries
        $sambungan->close();
    }
}

}
?>