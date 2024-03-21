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


$sql = "SELECT p.*, pa.*
        FROM payment p
        JOIN pallet pa ON p.Sku = pa.Sku
        WHERE p.UserID = '".$ids."' and p.flag = 0";

$result = mysqli_query($sambungan, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script>
        function calculateTotal() {
            var checkboxes = document.getElementsByName('payment_items[]');
            var total = 0;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    total += parseFloat(checkboxes[i].value);
                }
            }
            document.getElementById('total').innerHTML = total.toFixed(2);
        }
    </script>
 
  <link rel="stylesheet" type="text/css" href="style_edit.css">
</head>
<body>
    <div class="AccountContainer">
        <h1>Payment List</h1>
        <form action="payment.php" method="get">

                

        </form>
        <form action="process_payment.php" method="post">       <div class="ttable">
            <table>
                <tr>
                    <th>Select</th>
                    <th>User ID</th>
                    <th>Payment ID</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Flag</th>
                    <th>Total</th>
                    <th>Sku</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='payment_items[]' value='".$row['Total']."' onclick='calculateTotal()'></td>";
                        echo "<td>".$row['UserID']."</td>";
                        echo "<td>".$row['PaymentID']."</td>";
                        echo "<td>".$row['Time']."</td>";
                        echo "<td>".$row['Date']."</td>";
                            if($row["Flag"] == 1){
                                echo "<td>" . 'Payed' . "</td>";
                            }
                            elseif($row["Flag"] == 0){
                                echo "<td>" . 'Pending' . "</td>";
                            }  
                        echo "<td> RM ".$row['Total']."</td>";
                        echo "<td>".$row['Sku']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>0 results</td></tr>";
                }
                ?>
            </table>
            <p style="text-align: center;">Total: $<span id="total">0.00</span></p>
            <button type="submit" style="margin-left:700px;">Process Payment</button>
            </div>
        </form>
    </div>
</body>
</html>
