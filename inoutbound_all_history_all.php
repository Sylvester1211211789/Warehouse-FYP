<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();

if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}

$ids = $_SESSION['ID'];
$Name = $_SESSION['Name'];
$sta = $_SESSION['Status'];

if(isset($_GET['status'])) {
    $selected_status = $_GET['status'];
} else {
    $selected_status = 'Inbound';
}

$boo = 0;
if ($sta == 'admin' || $sta == 'manager') {
    if ($selected_status == 'Inbound') {
        $sql = "SELECT p.*, pa.*
                FROM product p
                JOIN pallet pa ON p.ProductID = pa.ProductID
                WHERE pa.Outbound_date IS NULL"; 
    } elseif ($selected_status == 'Outbound') {
        $sql = "SELECT p.*, pa.*
                FROM product p
                JOIN pallet pa ON p.ProductID = pa.ProductID
                WHERE pa.Outbound_date IS NOT NULL"; 
    } else {
        $boo = 0;
    }
} elseif ($sta == 'user') {
    if ($selected_status == 'Inbound') {
        $sql = "SELECT p.*, pa.*
                FROM product p
                JOIN pallet pa ON p.ProductID = pa.ProductID
                WHERE p.UserID = ? AND pa.Outbound_date IS NULL"; 
    } elseif ($selected_status == 'Outbound') {
        $sql = "SELECT p.*, pa.*
                FROM product p
                JOIN pallet pa ON p.ProductID = pa.ProductID
                WHERE p.UserID = ? AND pa.Outbound_date IS NOT NULL"; 
    } else {
        $boo = 0;
    }
}

if ($sql) {
    $statement = $sambungan->prepare($sql);
    if ($sta == 'user') {
        $statement->bind_param("i", $ids);
    }
    $statement->execute();
    $result = $statement->get_result();
}
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bound List</title>
    <link rel="stylesheet" type="text/css" href="style_edit.css">
</head>
<body>
    <form method="get">
        <div class="ttable">
            <h1>In/Outbound History</h1>
            <label for="status">Select type:</label>
            <select id="status" name="status">
                <option value="Inbound" <?php if ($selected_status == 'Inbound') echo 'selected'; ?>>Inbound</option>
                <option value="Outbound" <?php if ($selected_status == 'Outbound') echo 'selected'; ?>>Outbound</option>
            </select>
            <button type="submit">Search</button>
            <br>

            <table>
                <tr>
                    <?php
                    if ($sta == 'user' and $selected_status == "Outbound") {
                        echo "<th>Sku</th><th>Weight</th><th>Product Name</th><th>Inbound Date</th><th>Outbound Date</th><th>OutBound Status</th>";
                    } 
                    elseif ($sta == 'user' and $selected_status == "Inbound") {
                        echo "<th>Sku</th><th>Weight</th><th>Product Name</th><th>Inbound Date</th><th>InBound Status</th>";
                    }
                    elseif (($sta == 'admin' or $sta == 'manager') and $selected_status == "Inbound") {
                        echo "<th>Sku</th><th>User ID</th><th>Weight</th><th>Product Name</th><th>Inbound Date</th><th>InBound Status</th>";
                    }
                    elseif(($sta == 'admin' or $sta == 'manager') and $selected_status == "Outbound") {
                        echo "<th>Sku</th><th>User ID</th><th>Weight</th><th>Product Name</th><th>Inbound Date</th><th>Outbound Date</th><th>OutBound Status</th>";
                    }
                    ?>
                </tr>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if($sta == 'user' and $selected_status == "Outbound"){
                        echo "<tr>";
                        echo "<td>" . $row["Sku"] . "</td>";
                        echo "<td>" . $row["Pallet_weight"] . "</td>";
                        echo "<td>" . $row["Product_Name"] . "</td>";
                        echo "<td>" . $row["Inbound_date"] . "</td>";
                        echo "<td>" . ($row["Outbound_date"] ? $row["Outbound_date"] : "N/A") . "</td>"; 
                            
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

                                            echo "<td>" . ($row["Outbound_date"] ? "Complete" : "In Progress") . "</td>"; 
                                    $s2 = 1;
                                        }
                                    }
                                    if ($s2 == 0) {
                                                echo "<td> N/A </td>";
                                            }
                                } else {
                            echo "<td> N/A </td>";
                                }
                            
                        }
                        elseif($sta == 'user' and $selected_status == "Inbound"){
                        echo "<tr>";
                        echo "<td>" . $row["Sku"] . "</td>";
                        echo "<td>" . $row["Pallet_weight"] . "</td>";
                        echo "<td>" . $row["Product_Name"] . "</td>";
                        echo "<td>" . ($row["Inbound_date"] ? $row["Inbound_date"] : "N/A") . "</td>"; 
                        echo "<td>" . ($row["Inbound_date"] ? "Complete" : "In Progress") . "</td>"; 
                        }
                        elseif(($sta == 'admin' or $sta == 'manager') and $selected_status == "Inbound"){
                        echo "<tr>";
                        echo "<td>" . $row["Sku"] . "</td>";
                        echo "<td>" . $row["UserID"] . "</td>";
                        echo "<td>" . $row["Pallet_weight"] . "</td>";
                        echo "<td>" . $row["Product_Name"] . "</td>";
                        echo "<td>" . ($row["Inbound_date"] ? $row["Inbound_date"] : "N/A") . "</td>"; 
                        echo "<td>" . ($row["Inbound_date"] ? "Complete" : "In Progress") . "</td>"; 
                            
                        }
                        elseif(($sta == 'admin' or $sta == 'manager') and $selected_status == "Outbound"){
                        echo "<tr>";
                        echo "<td>" . $row["Sku"] . "</td>";
                        echo "<td>" . $row["UserID"] . "</td>";
                        echo "<td>" . $row["Pallet_weight"] . "</td>";
                        echo "<td>" . $row["Product_Name"] . "</td>";
                        echo "<td>" . $row["Inbound_date"] . "</td>";
                        echo "<td>" . ($row["Outbound_date"] ? $row["Outbound_date"] : "N/A") . "</td>"; 
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
                                            echo "<td>" . ($row["Outbound_date"] ? "Complete" : "In Progress") . "</td>"; 
                                    $s2 = 1;
                                        }
                                    }
                                    if ($s2 == 0) {
                                                echo "<td> N/A </td>";
                                            }
                                } else {
                            echo "<td> N/A </td>";
                                }
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>0 results</td></tr>";
                }
                
                
                
                ?>
            </table>
        </div>
    </form>
</body>
</html>
