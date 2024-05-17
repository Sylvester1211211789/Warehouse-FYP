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
$status = $_SESSION['Status'];

if ($status == "admin") {
    
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

    if (isset($_POST["New"])) {
        $BlockID = $_POST["New"];

        
        $update_query = "DELETE FROM block WHERE BlockID = ?";
        $stmt = $sambungan->prepare($update_query);
        $stmt->bind_param("i", $BlockID); 

        
        if ($stmt->execute()) {
            echo "<script>alert('Delete block successful')</script>";
        } else {
            echo "<script>alert('Delete block unsuccessful')</script>";
        }

    
        $stmt->close();
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
                    <h1>Delete Block</h1>
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
            <button type="submit">Enter</button>
        </div>
    </form>
    </div>
</body>
</html>
