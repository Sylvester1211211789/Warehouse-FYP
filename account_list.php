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



if ($selected_status == 'admin') {
    $This = "SELECT * FROM admin";
    $result = mysqli_query($sambungan, $This);
 
} elseif ($selected_status == 'user') {
    $This = "SELECT * FROM users";
    $result = mysqli_query($sambungan, $This);

} elseif ($selected_status == 'manager') {
    $This = "SELECT * FROM manager";
    $result = mysqli_query($sambungan, $This);

} 
$sambungan->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
</head>
<body>
    <div class="AccountContainer">
        <h1>Account</h1>
        <form method="get">
                         <div>
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
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        if ($selected_status == 'admin') {
            echo "<td>" . $row["AdminID"] . "</td>";
            echo "<td>" . $row["Fullname"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";           
            echo "<td>" . $row["Phone_Number"] . "</td>";           
        } elseif ($selected_status == 'user') {
            echo "<td>" . $row["UserID"] . "</td>";
            echo "<td>" . $row["Fullname"] . "</td>";
            echo "<td>" . $row["Address"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";           
            echo "<td>" . $row["Phone_Number"] . "</td>";
            echo "<td>" . $row["Company_Name"] . "</td>";
        } elseif ($selected_status == 'manager') {
            echo "<td>" . $row["ManagerID"] . "</td>";
            echo "<td>" . $row["Fullname"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";           
            echo "<td>" . $row["Phone_Number"] . "</td>";          
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
    </div>
</body>
</html>
