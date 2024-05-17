<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
$ID = $_SESSION['ID']; 
$Name = $_SESSION['Name'];
$Status = $_SESSION['Status'];
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/index.php?login");
    exit();
}

if(isset($_GET['Status'])) {
    $selected_status = $_GET['Status'];
} else {
    $selected_status = 'user';
}

if ($selected_status == 'admin') {
    $This = "SELECT pa.*, p.Product_Name, p.UserID, p.ProductID, b.Block_Name, IF(pa.Outbound_date IS NULL, 0, 1) AS has_outbound_date
        FROM pallet pa 
        JOIN product p ON pa.ProductID = p.ProductID 
        JOIN users u ON p.UserID = u.UserID
        JOIN block b ON b.BlockID = pa.BlockID";      
    $stmt = $sambungan->prepare($This);
    $stmt->execute();
    $result = $stmt->get_result();
} elseif ($selected_status == 'user') {
    $This = "SELECT pa.*, p.Product_Name, p.UserID, p.ProductID, b.Block_Name, IF(pa.Outbound_date IS NULL, 0, 1) AS has_outbound_date
        FROM pallet pa 
        JOIN product p ON pa.ProductID = p.ProductID 
        JOIN users u ON p.UserID = u.UserID
        JOIN block b ON b.BlockID = pa.BlockID
        WHERE u.UserID = '$ID'";
    $stmt = $sambungan->prepare($This);
    $stmt->execute();
    $result = $stmt->get_result();
}
include('head.html');
?>
<script>
        function confirmOutbound(sku) {
            if (confirm('Are you sure you want to request OutBound?')) {
                window.location.href = 'http://localhost/warehouse/u_inoutbound?editadmin=' + sku;
            }
        }
    </script>

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
    </style>
</head>
<body>
    <div class="AccountContainer">
        <h1>In/Outbound List</h1>
        <form method="get">
            <div class = "ttable">
            <br> 
            <table>
                <tr>
                    <?php
                    if ($selected_status == 'admin') {
                        echo "<th>SKU</th><th>User ID</th><th>Product</th><th>Block</th><th>InBound Date</th><th>OutBound Date</th><th>OutBound Request</th>";
                    } elseif ($selected_status == 'user') {
                        echo "<th>SKU</th><th>Product</th><th>Block</th><th>InBound Date</th><th>OutBound Date</th><th>OutBound Request</th><th></th>";
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
            ${"value1_" . $row["Sku"]} = $row["ProductID"];
            ${"value2_" . $row["Sku"]} = "No";
            echo "<td>" . $row["Sku"] . "</td>";
            echo "<td>" . $row["UserID"] . "</td>";
            echo "<td>" . $row["Product_Name"] . "</td>";

            echo "<td>" . $row["Block_Name"] . "</td>";
            echo "<td>" . $row["Inbound_date"] . "</td>";
            if($row["Outbound_date"] == NULL){
                echo "<td>N/A</td>";
            }
            else{
            echo "<td>" . $row["Outbound_date"] . "</td>";
            }
            
            $s1 = $row["Sku"];
            $s2 = 0;
            $This1 = "SELECT Action FROM task where Sku = ?";
            $stmt1 = $sambungan->prepare($This1);
            $stmt1->bind_param("s", $s1); // Bind the parameter
            $stmt1->execute();
            $result1 = $stmt1->get_result(); // Get the result

            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    if ($row1["Action"] == "Retrieve" and $s2 == 0) {
                        echo "<td> Yes </td>";
                        ${"value2_" . $row["Sku"]} = "Yes";
                        $s2 = 1;
                    }
                }
                if ($s2 == 0) {
                    echo "<td> No </td>";
                }
            } else {
                echo "<td> No </td>";
            }
            
            echo "<td><button type='button' onclick='confirmOutbound(" . $row["Sku"] . ")'>Request OutBound</button></td>";
            
        } elseif ($selected_status == 'user') {
            ${"value1_" . $row["Sku"]} = $row["ProductID"];
            ${"value2_" . $row["Sku"]} = "No";
            echo "<td>" . $row["Sku"] . "</td>";
            echo "<td>" . $row["Product_Name"] . "</td>";

            echo "<td>" . $row["Block_Name"] . "</td>";
            echo "<td>" . $row["Inbound_date"] . "</td>";
            
            if($row["Outbound_date"] == NULL){
                echo "<td>N/A</td>";
            }
            else{
            echo "<td>" . $row["Outbound_date"] . "</td>";
            }
            
            $s1 = $row["Sku"];
            $s2 = 0;
            $This1 = "SELECT Action FROM task where Sku = ?";
            $stmt1 = $sambungan->prepare($This1);
            $stmt1->bind_param("s", $s1); // Bind the parameter
            $stmt1->execute();
            $result1 = $stmt1->get_result(); // Get the result

            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    if ($row1["Action"] == "Retrieve" and $s2 == 0) {
                        ${"value2_" . $row["Sku"]} = "Yes";
                        echo "<td> Yes </td>";
                        $s2 = 1;
                    }
                }
                if ($s2 == 0) {
                    echo "<td> No </td>";
                }
            } else {
                echo "<td> No </td>";
            }
            
            echo "<td><button type='button' onclick='confirmOutbound(" . $row["Sku"] . ")'>Request OutBound</button></td>";
                
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
$randomNumber = rand(1, 2);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if(isset($_GET["editadmin"])) {
        $userID = $_GET["editadmin"];
        $value1 = ${"value1_" . $userID};
        $value2 = ${"value2_" . $userID};
        if($value2 == "No"){
            $update = "INSERT INTO task (Action, ProductID, Date, Time, Lane, Sku) VALUES ('Retrieve', ?, CURRENT_DATE, CURRENT_TIME, ?, ?)";
            $binding = $sambungan->prepare($update);
            
            // Bind parameters
            $binding->bind_param("sss", $value1, $randomNumber, $userID);
            
            if ($binding->execute()) {
                echo "<script>alert('Requested For OutBound Successful')</script>";
                echo "<script>window.location.href = 'http://localhost/warehouse/u_inoutbound';</script>";
                exit();
            } else {
                echo "<script>alert('Requested For OutBound Unsuccessful')</script>";
            }

            $binding->close();
            $stmt->close();
            $sambungan->close();
        }
        else{
            echo "<script>alert('This Pallet Already Requested For OutBound!')</script>";
        }
    }
    
    }
?>