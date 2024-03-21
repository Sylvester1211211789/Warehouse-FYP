<?php
include('sambung.php');
session_start();

if (!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: user_login.php");
    exit();
}

$ids = $_SESSION['ID'];
$Name = $_SESSION['Name'];
$Status = $_SESSION['Status'];

$result = false;

if(isset($_POST['UserID'])){
    $UserID = $_POST['UserID']; 
    $sql = "SELECT * FROM payment WHERE Flag = 0 AND UserID = '$UserID'"; 
    $result = mysqli_query($sambungan, $sql);
    if(!$result) {
        echo "Error: " . mysqli_error($sambungan);
        exit();
    }
}
else{
    $sql = "SELECT * FROM payment WHERE Flag = 0 "; 
    $result = mysqli_query($sambungan, $sql);
}

if(isset($_POST["New"])) {
    $New = $_POST["New"];
    $PaymentID = $_POST["payment_id"];
    $update_query = "UPDATE payment SET Total='$New' WHERE PaymentID='$PaymentID'";
    $update_result = $sambungan->query($update_query);

    if ($update_result) {
        echo "<script>alert('Edit Total successful')</script>";
    } else {
        echo "<script>alert('Edit total unsuccessful')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
 <link rel="stylesheet" type="text/css" href="style_edit.css">
</head>
<body>
    <div class="AccountContainer">
        <h1>Payment List</h1>
        <form action="edit_payment.php" method="post">
            <div class="ttable">
                <label for="UserID">Search by UserID:</label>
                <input type="text" name="UserID" id="UserID">
                <button type="submit">Search</button>
            </div>
        </form>
        <form action="" method="post">
            <div class="ttable">
                <table>
                    <tr>
                        <th>User ID</th>
                        <th>Payment ID</th>
                        <th>Time</th>
                        <th>Total</th>
                        <th>Sku</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if ($result !== false && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['UserID']."</td>";
                            echo "<td>".$row['PaymentID']."</td>";
                            echo "<td>".$row['Time']."</td>";
                            echo "<td> RM ".$row['Total']."</td>";
                            echo "<td>".$row['Sku']."</td>";
                            echo "<td>
                                    <input type='hidden' name='payment_id' value='".$row['PaymentID']."'>
                                    <input placeholder='Change total' class='input-field' type='text' name='New'>
                                    <button type='submit'>Update</button>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No results found</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </form>
    </div>
</body>
</html>
