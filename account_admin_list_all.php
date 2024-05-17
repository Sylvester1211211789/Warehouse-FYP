<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();

if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/Login");
    exit();
}

$id = $_SESSION['ID'];
$Name = $_SESSION['Name'];

if(isset($_GET['status'])) {
    $selected_status = $_GET['status'];
} else {
    $selected_status = 'user';
}

$boo = 0;
$result = null;

if ($selected_status == 'admin') {
    $This = "SELECT * FROM admin where Active = '1'";
    $stmt = $sambungan->prepare($This);
    $stmt->execute();
    $result = $stmt->get_result();
    $boo = 1;
} elseif ($selected_status == 'user') {
    $This = "SELECT * FROM users where Active = '1'";
    $stmt = $sambungan->prepare($This);
    $stmt->execute();
    $result = $stmt->get_result();
    $boo = 2;
} elseif ($selected_status == 'manager') {
    $This = "SELECT * FROM manager where Active = '1'";
    $stmt = $sambungan->prepare($This);
    $stmt->execute();
    $result = $stmt->get_result();
    $boo = 3;
} else {
    $boo = 0;
}
include("header.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
        <style>
       
        body {
            background-color: #1e1e1e;
            color: #ffffff;
        }
            h1{
                margin-top: 50px;
                text-align: center;
            }
        .ttable table {
            width: 100%;
            border-collapse: collapse;
            background-color: #2c2c2c; 
            color: #ffffff; 
        }

          .ttable th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #444; 
        }

          .ttable tr:hover {
            background-color: #444;
        }

         .ttable th {
            background-color: #333; 
        }


          .ttable select, button {
            background-color: #333; 
            color: #ffffff; 
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        
          .ttable select:hover, button:hover {
            background-color: #444; 
        }
    input[type="text"] {
    width: 80%;
    padding: 5px;
    box-sizing: border-box;
    border: 1px solid transparent;
    border-radius: 4px;
    background-color:transparent;
        color:white;
}
            select{
                margin-bottom:10px;
            }
    </style>
</head>
<body>
    <div class="AccountContainer">
        <h1>Manage Account</h1>
        <form method="get">
            <div class = "ttable">
            <label for="status">Select User Type:</label>
            <select id="status" name="status">
                <option value="user" <?php if ($selected_status == 'user') echo 'selected'; ?>>User</option>
                <option value="manager" <?php if ($selected_status == 'manager') echo 'selected'; ?>>Manager</option>
                <option value="admin" <?php if ($selected_status == 'admin') echo 'selected'; ?>>Admin</option>
            </select>
            <button type="submit">Search</button>
            <br>
                
            <table>
                <tr>
                    <?php

                    if ($selected_status == 'admin') {
                        echo "<th>ID</th><th>Name</th><th>Email</th><th>Phone Number</th>";
                    } elseif ($selected_status == 'user') {
                        echo "<th>ID</th><th>Name</th><th>Address</th><th>Email</th><th>Phone Number</th><th>Company Name</th>";
                    } elseif ($selected_status == 'manager') {
                        echo "<th>ID</th><th>Name</th><th>Email</th><th>Phone Number</th>";
                    }
                    ?>
                </tr>
<?php
$i = 0;
$j = 0;
$j1 = 1;
$j2 = 2;
$j3 = 3;
$j4 = 4;
$j5 = 5;
$j6 = 6;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        if ($selected_status == 'admin') {
            ${"value1_" . $row["AdminID"]} = $row["Fullname"];
            ${"value2_" . $row["AdminID"]} = $row["Email"];
            ${"value3_" . $row["AdminID"]} = $row["Phone_Number"];
            
            echo "<td><input type='text' name='value1"  . $row["AdminID"] .  "' value='" . $row["AdminID"] . "' readonly></td>";
            echo "<td><input type='text' name='value2"  . $row["AdminID"] .  "' value='" . $row["Fullname"] . "'></td>";
            echo "<td><input type='text' name='value3"  . $row["AdminID"] .  "' value='" . $row["Email"] . "'></td>";
            echo "<td><input type='text' name='value4"  . $row["AdminID"] .  "' value='" . $row["Phone_Number"] . "'></td>";           
            echo "<td><button type='submit' name='editadmin' value='" .$row["AdminID"]. "'>Edit</button></td>";
            echo "<td><button type='submit' name='deleteadmin' value='" .$row["AdminID"]. "'>Delete</button></td>";
            
        } elseif ($selected_status == 'user') {
            ${"value1_" . $row["UserID"]} = $row["Fullname"];
            ${"value2_" . $row["UserID"]} = $row["Address"];
            ${"value3_" . $row["UserID"]} = $row["Email"];
            ${"value4_" . $row["UserID"]} = $row["Phone_Number"];
            ${"value5_" . $row["UserID"]} = $row["Company_Name"];
            echo "<td><input type='text' name='value1" . $row["UserID"] . "' value='" . $row["UserID"] . "' readonly></td>";
            echo "<td><input type='text' name='value2" . $row["UserID"] . "' value='" . $row["Fullname"] . "'></td>";
            echo "<td><input type='text' name='value3" . $row["UserID"] . "' value='" . $row["Address"] . "'></td>";
            echo "<td><input type='text' name='value4" . $row["UserID"] . "' value='" . $row["Email"] . "'></td>";           
            echo "<td><input type='text' name='value5" . $row["UserID"] . "' value='" . $row["Phone_Number"] . "'></td>";
            echo "<td><input type='text' name='value6" . $row["UserID"] . "' value='" . $row["Company_Name"] . "'></td>";
            echo "<td><button type='submit' name='edituser' value='" .$row["UserID"]. "'>Edit</button></td>";
            echo "<td><button type='submit' name='deleteuser' value='" .$row["UserID"]. "'>Delete</button></td>";
                
        } elseif ($selected_status == 'manager') {        
            
            ${"value1_" . $row["ManagerID"]} = $row["Fullname"];
            ${"value2_" . $row["ManagerID"]} = $row["Email"];
            ${"value3_" . $row["ManagerID"]} = $row["Phone_Number"];
            
            echo "<td><input type='text' name='value1"  . $row["ManagerID"] .  "' value='" . $row["ManagerID"] . "' readonly></td>";
            echo "<td><input type='text' name='value2"  . $row["ManagerID"] .  "' value='" . $row["Fullname"] . "'></td>";
            echo "<td><input type='text' name='value3"  . $row["ManagerID"] .  "' value='" . $row["Email"] . "'></td>";
            echo "<td><input type='text' name='value4"  . $row["ManagerID"] .  "' value='" . $row["Phone_Number"] . "'></td>";           
            echo "<td><button type='submit' name='editmanager' value='" .$row["ManagerID"]. "'>Edit</button></td>";
            echo "<td><button type='submit' name='deletemanager' value='" .$row["ManagerID"]. "'>Delete</button></td>";
        }
        echo "</tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='5'>0 results</td></tr>";
}
?>
            </table>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["deleteuser"])){
        $update = "UPDATE users SET Active = '0' WHERE UserID=?";
            $binding = $sambungan->prepare($update);
            
            // Bind parameters
            $binding->bind_param("s", $_GET["deleteuser"]);
            
            if ($binding->execute()) {
                echo "<script>alert('Delete Successful')</script>";
                echo "<script>window.location.href = 'http://localhost/warehouse/a_list_account?status=user';</script>";
                exit();
            } else {
                echo "<script>alert('Delete Unsuccessful')</script>";
            }
            $binding->close();
            $stmt->close();
            $sambungan->close();
    }
    
    elseif(isset($_GET["deleteadmin"])){
            $update = "UPDATE admin SET Active = '0' WHERE AdminID=?";
            $binding = $sambungan->prepare($update);
            $binding->bind_param("s", $_GET["deleteadmin"]);
            
            if ($binding->execute()) {
                echo "<script>alert('Delete Successful')</script>";
                echo "<script>window.location.href = 'http://localhost/warehouse/a_list_account?status=admin';</script>";
                exit();
            } else {
                echo "<script>alert('Delete Unsuccessful')</script>";
            }
            $binding->close();
            $stmt->close();
            $sambungan->close();
    }
    elseif(isset($_GET["deletemanager"])){
        $update = "UPDATE manager SET Active = '0' WHERE ManagerID=?";
            $binding = $sambungan->prepare($update);
            
            // Bind parameters
            $binding->bind_param("s", $_GET["deletemanager"]);
            
            if ($binding->execute()) {
                echo "<script>alert('Delete Successful')</script>";
                echo "<script>window.location.href = 'http://localhost/warehouse/a_list_account?status=manager';</script>";
                exit();
            } else {
                echo "<script>alert('Delete Unsuccessful')</script>";
            }
            $binding->close();
            $stmt->close();
            $sambungan->close();
    }
    
    elseif(isset($_GET["edituser"])) {
        $userID = $_GET["edituser"];
        $value1 = $_GET['value1' . $userID];
        $value2 = $_GET['value2' . $userID];
        $value3 = $_GET['value3' . $userID];
        $value4 = $_GET['value4' . $userID];
        $value5 = $_GET['value5' . $userID];
        $value6 = $_GET['value6' . $userID];
        
        if(${"value1_" . $userID} != $value2 or ${"value2_" . $userID} != $value3 or ${"value3_" . $userID} != $value4 or ${"value4_" . $userID} != $value5 or ${"value5_" . $userID} != $value6){
            $update = "UPDATE users SET Company_Name=?, Fullname=?, Address=?, Phone_Number=?, Email=? WHERE UserID=?";
            $binding = $sambungan->prepare($update);
            
            // Bind parameters
            $binding->bind_param("ssssss", $value6, $value2, $value3, $value5, $value4, $userID);
            
            if ($binding->execute()) {
                echo "<script>alert('Edit Successful')</script>";
                echo "<script>window.location.reload();</script>";
            } else {
                echo "<script>alert('Edit Unsuccessful')</script>";
            }
            
            // Close the prepared statement
            $binding->close();
            
            // Close the MySQLi connection after executing all queries
            $stmt->close();
            $sambungan->close();
        }
    }
    elseif(isset($_GET["editadmin"])) {
        // Retrieve the values sent by the edit button
        $userID = $_GET["editadmin"];
        $value1 = $_GET['value1' . $userID];
        $value2 = $_GET['value2' . $userID];
        $value3 = $_GET['value3' . $userID];
        $value4 = $_GET['value4' . $userID];
        
        if(${"value1_" . $userID} != $value2 or ${"value2_" . $userID} != $value3 or ${"value3_" . $userID} != $value4){
            $update = "UPDATE admin SET Fullname=?, Email=?, Phone_Number=? WHERE AdminID=?";
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
            $stmt->close();
            $sambungan->close();
        }
    }
    elseif(isset($_GET["editmanager"])) {
        // Retrieve the values sent by the edit button
        $userID = $_GET["editmanager"];
        $value1 = $_GET['value1' . $userID];
        $value2 = $_GET['value2' . $userID];
        $value3 = $_GET['value3' . $userID];
        $value4 = $_GET['value4' . $userID];
        
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
            $stmt->close();
            $sambungan->close();
        }
    }
    elseif(isset($_GET["delete"])) {
        $userID_to_delete = $_GET["delete"];
        
        // Process delete here
    }
}
?>
