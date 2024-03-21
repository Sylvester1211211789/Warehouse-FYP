<?php
include('sambung.php');
session_start();

if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: user_login.php");
    exit();
}

$ids = $_SESSION['ID'];
$Name = $_SESSION['Name'];
$Status = $_SESSION['Status'];
if(isset($_GET['status'])) {
    $selected_status = $_GET['status'];
} else {
    $selected_status = 0;
}

$boo = 0;

if ($selected_status == 0) {
    $check_query = "SELECT * FROM payment where Flag = 0";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 1;
} elseif ($selected_status == 1) {
    $check_query = "SELECT * FROM payment where Flag = 1";
    $result = mysqli_query($sambungan, $check_query);
    $boo = 2;
} else {
    $boo = 0;
}

$sambungan->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

 
            <link rel="stylesheet" type="text/css" href="style_edit.css">

</head>
                 <div class = "ttable">
<body>
  
        <h1>Payment List</h1>
        <form action="user_payment_list.php" method="get">

            <label for="status">Select payment Type:</label>
            <select id="status" name="status">
                <option value="1" <?php if ($selected_status == '1') echo 'selected'; ?>>Payed</option>
                <option value="0" <?php if ($selected_status == '0') echo 'selected'; ?>>Unpayed</option>
            </select>
            <button type="submit">Enter</button>
            <br>
           
            <table>
                <tr>
                    <?php

 
                        echo "<th>User ID</th><th>Payment ID</th><th>Time</th><th>Date</th><th>Flag</th><th>Total</th><th>Sku</th>";

                    ?>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                            echo "<td>" . $row["UserID"] . "</td>";
                            echo "<td>" . $row["PaymentID"] . "</td>";
                            echo "<td>" . $row["Time"] . "</td>";
                            echo "<td>" . $row["Date"] . "</td>";
                            if($row["Flag"] == 1){
                                echo "<td>" . 'Payed' . "</td>";
                            }
                            elseif($row["Flag"] == 0){
                                echo "<td>" . 'Pending' . "</td>";
                            }                      
  
                            echo "<td>RM " . $row["Total"] . "</td>";
                            echo "<td>" . $row["Sku"] . "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>0 results</td></tr>";
                }
                ?>
            </table>

        </form>
    
</body>
    </div>
</html>
