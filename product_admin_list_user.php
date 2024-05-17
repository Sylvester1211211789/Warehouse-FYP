<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
$ID = $_SESSION['ID']; 
$Name = $_SESSION['Name'];
$Status = $_SESSION['Status'];
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}

if(isset($_GET['Status'])) {
    $selected_status = $_GET['Status'];
} else {
    $selected_status = 'user';
}

if ($selected_status == 'admin') {
    $This = "SELECT * FROM admin where Active = '1'";
    $stmt = $sambungan->prepare($This);
    $stmt->execute();
    $result = $stmt->get_result();
} elseif ($selected_status == 'user') {
    $This = "SELECT * FROM product where Userid = '$ID' and Active = '1'";
    $stmt = $sambungan->prepare($This);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
        <style>
       
        body {
            background-color: #1e1e1e;
            color: #ffffff;
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
    </style>
</head>
<body>
    <div class="AccountContainer">
        <h1>Account</h1>
        <form method="get">
            <div class = "ttable">
            <br> 
            <table>
                <tr>
                    <?php
                    if ($selected_status == 'admin') {
                        echo "<th>Product Name</th><th>Added Date</th><th>User ID</th>";
                    } elseif ($selected_status == 'user') {
                        echo "<th>Product Name</th><th>Added Date</th>";
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
            ${"value2_" . $row["ProductID"]} = $row["Product_Name"];
            
            echo "<td><input type='text' name='value1"  . $row["ProductID"] .  "' value='" . $row["Product_Name"] . "' ></td>";
            echo "<td><input type='text' name='value2"  . $row["ProductID"] .  "' value='" . $row["Date"] . "' readonly></td>";
            echo "<td><input type='text' name='value3"  . $row["ProductID"] .  "' value='" . $row["UserID"] . "' readonly></td>";          
            echo "<td><button type='submit' name='editadmin' value='" .$row["ProductID"]. "'>Edit</button></td>";
            echo "<td><button type='submit' name='deleteadmin' value='" .$row["ProductID"]. "'>Delete</button></td>";
            
        } elseif ($selected_status == 'user') {
            ${"value2_" . $row["ProductID"]} = $row["Product_Name"];
            
            echo "<td><input type='text' name='value1"  . $row["ProductID"] .  "' value='" . $row["Product_Name"] . "' ></td>";
            echo "<td><input type='text' name='value2"  . $row["ProductID"] .  "' value='" . $row["Date"] . "' readonly></td>";        
            echo "<td><button type='submit' name='edituser' value='" .$row["ProductID"]. "'>Edit</button></td>";
            echo "<td><button type='submit' name='deleteuser' value='" .$row["ProductID"]. "'>Delete</button></td>";
                
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
        $update = "UPDATE product SET Active = '0' WHERE ProductID=?";
            $binding = $sambungan->prepare($update);
            
            // Bind parameters
            $binding->bind_param("s", $_GET["deleteuser"]);
            
            if ($binding->execute()) {
                echo "<script>alert('Delete Product Successful')</script>";
                echo "<script>window.location.href = 'http://localhost/warehouse/a_list_product';</script>";
                exit();
            } else {
                echo "<script>alert('Delete Product Unsuccessful')</script>";
            }
            $binding->close();
            $stmt->close();
            $sambungan->close();
    }
    
    elseif(isset($_GET["deleteadmin"])){
            $update = "UPDATE product SET Active = '0' WHERE ProductID=?";
            $binding = $sambungan->prepare($update);
            $binding->bind_param("s", $_GET["deleteadmin"]);
            
            if ($binding->execute()) {
                echo "<script>alert('Delete Product Successful')</script>";
                echo "<script>window.location.href = 'http://localhost/warehouse/a_list_product';</script>";
                exit();
            } else {
                echo "<script>alert('Delete Product Unsuccessful')</script>";
            }
            $binding->close();
            $stmt->close();
            $sambungan->close();
    }
    
    elseif(isset($_GET["edituser"])) {
        $userID = $_GET["edituser"];
        $value2 = $_GET['value1' . $userID];
        
        if(${"value2_" . $userID} != $value2){
            $update = "UPDATE product SET Product_Name = ? WHERE ProductID = ?";
            $binding = $sambungan->prepare($update);
            
            // Bind parameters
            $binding->bind_param("ss", $value2, $userID);
            
            if ($binding->execute()) {
                echo "<script>alert('Update Product Name Successful')</script>";
                echo "<script>window.location.reload();</script>";
            } else {
                echo "<script>alert('Update Product Name Unsuccessful')</script>";
            }

            $binding->close();
            $stmt->close();
            $sambungan->close();
        }
    }
    elseif(isset($_GET["editadmin"])) {
        // Retrieve the values sent by the edit button
        $userID = $_GET["editadmin"];
        $value2 = $_GET['value1' . $userID];
    
        if(${"value2_" . $userID} != $value2){
            $update = "UPDATE product SET Product_Name = ? WHERE ProductID = ?";
            $binding = $sambungan->prepare($update);
            
            // Bind parameters
            $binding->bind_param("ss", $value2, $userID);
            
            if ($binding->execute()) {
                echo "<script>alert('Update Product Name Successful')</script>";
                echo "<script>window.location.reload();</script>";
            } else {
                echo "<script>alert('Update Product Name Unsuccessful')</script>";
            }

            $binding->close();
            $stmt->close();
            $sambungan->close();
        }
    }
    }
?>