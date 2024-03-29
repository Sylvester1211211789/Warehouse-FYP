<?php
include('sambung.php');
session_start();
$ID = $_SESSION['ID']; 
$Status = $_SESSION['Status'];

if($Status == "admin") {
    $querys = "SELECT * FROM product";
    $results = $sambungan->query($querys);
    if ($results) {
        $product = array();
        while ($row = $results->fetch_assoc()) {
            $product[] = array(
                'ProductID' => $row['ProductID'],
                'Product_Name' => $row['Product_Name'],
                'Date' => $row['Date'],
                'UserID' => $row['UserID']               
            );
        }
    } else {
        echo "Error retrieving product: " . $sambungan->error;
    }

    if(isset($_POST["New"])) {
        $BlockID = $_POST["New"];
        $Block_Name = $_POST["Name"];

        // Check if the BlockID already exists
        $exists_query = "SELECT * FROM product WHERE ProductID = '$ProductID'";
        $exists_result = $sambungan->query($exists_query);

        if($exists_result->num_rows > 0) {
            $update_query = "UPDATE product SET Product_Name = '$Product_Name' where ProductID = '$ProductID' ";
            $result = $sambungan->query($update_query);
                        if ($result) {
                echo "<script>alert('Add Product successful')</script>";
            } else {
                echo "<script>alert('Add Product unsuccessful')</script>";
            }
        } else {
            echo "<script>alert('ProductID not exists. Please enter other ID.')</script>";

        }
    } 
} else {
    echo "<script>alert('Error')</script>";
}

$sambungan->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product List</title>
</head>
<body>
    <div class = "">
                    <h1>Product List</h1>
                <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Date</th>
                    <th>User ID</th>
                </tr>
                <?php foreach ($product as $product): ?>
                    <tr>
                        <td><?php echo $product['ProductID']; ?></td>
                        <td><?php echo $product['Product_Name']; ?></td>
                         <td><?php echo $product['Date']; ?></td>
                        <td><?php echo $product['UserID']; ?></td>                       
                    </tr>
                <?php endforeach; ?>
            </table>

    </div>
</body>
</html>
