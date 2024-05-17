<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
$ids = $_SESSION['ID']; 
$Name = $_SESSION['Name'];
$status = $_SESSION['Status'];
if(!isset($_SESSION['ID']) || !isset($_SESSION['Name']) || !isset($_SESSION['Status'])) {
    header("Location: http://localhost/warehouse/al_login");
    exit();
}

if($status == "admin") {
    $querys = "SELECT BlockID, Block_Name FROM block";
    $results = $sambungan->query($querys);
    if ($results) {
        $blocks = array();
        while ($row = $results->fetch_assoc()) {
            $blocks[] = array(
                'BlockID' => $row['BlockID'],
                'Block_Name' => $row['Block_Name']
            );
        }
    } else {
        echo "Error retrieving blocks: " . $sambungan->error;
    }

    if(isset($_POST["New"])) {
        $BlockID = $_POST["New"];
        $Block_Name = $_POST["Name"];

        // Check if the BlockID already exists
        $exists_query = "SELECT * FROM block WHERE BlockID = '$BlockID'";
        $exists_result = $sambungan->query($exists_query);

        if($exists_result->num_rows > 0) {
            echo "<script>alert('BlockID already exists. Please choose a different ID.')</script>";
        } else {
            // Perform the insertion
            $update_query = "INSERT INTO block VALUES ('$BlockID','$Block_Name')";
            $result = $sambungan->query($update_query);

            if ($result) {
                echo "<script>alert('Add block successful')</script>";
            } else {
                echo "<script>alert('Add block unsuccessful')</script>";
            }
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
    <link rel="stylesheet" href="style_edit.css">
    <title>Account Setting</title>
</head>
<body>
    <div class = "ttable">
                    <h1>Add block</h1>
                <table>
                <tr>
                    <th>Block ID</th>
                    <th>Block Name</th>
                </tr>
                <?php foreach ($blocks as $block): ?>
                    <tr>
                        <td><?php echo $block['BlockID']; ?></td>
                        <td><?php echo $block['Block_Name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
    <form method="post">
        <div class="AccountContainer"> 


            <input placeholder="Enter Block ID" class="input-field" type="text" name="New">
            <input placeholder="Enter Block Name" class="input-field" type="text" name="Name">
            <button type="submit">Enter</button>
        </div>
    </form>
    </div>
</body>
</html>
