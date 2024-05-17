<!DOCTYPE html>
<html>
<head>
    <style>
 table {
            border-collapse: collapse;
            margin: 20px auto;
        }
        td {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 20px;
        }
        .green {
            background-color: lightgreen;
            cursor: pointer;
        }
        

        
        
 
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbound and Outbound Control</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="head_text">
        <h1>Inbound and Outbound Control</h1>
        </div>
    </header>
<div class="navbar">
  <a href="http://localhost/warehouse/Main">Home</a>
  <a href="http://localhost/warehouse/Inbound_and_outbound">Control</a>
  <a href="http://localhost/warehouse/Privacy_setting">Profile</a>    
  <div class="dropdown">
    <button class="dropbtn"> ☰
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
  <a href="http://localhost/warehouse/Admin_register">Admin Account</a>
  <a href="http://localhost/warehouse/Manager_register">Manager Account</a>
  <a href="http://localhost/warehouse/List_of_account">Account List</a>
  <a href="http://localhost/warehouse/More_payment">Payment</a>
  <a href="http://localhost/warehouse/Inbound_and_outbound_history">In/Outbound List</a>
    </div>
  </div> 
</div>
    <main>

        <h2>Welcome to our modern control website</h2>
        <p>You may hover over the available goods or click the available goods to check the detail of the goods.</p>

 <div id="gridContainer">
<?php
$host = 'localhost';
$user = 'root';
$password = ''; 
$database = 'warehouse';

$sambung = mysqli_connect($host, $user, $password, $database);

if (!$sambung) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
$ids = $_SESSION['ID'];
$sta = $_SESSION['Status'];

$sql = "SELECT pa.*, p.UserID,p.ProductID, u.*, IF(pa.Outbound_date IS NULL, 0, 1) AS has_outbound_date
        FROM pallet pa
        JOIN product p ON pa.ProductID = p.ProductID 
        JOIN users u ON p.UserID = u.UserID";

$result = mysqli_query($sambung, $sql);

if ($sta == 'admin') {
    if ($result->num_rows > 0) {

        $grid = array_fill(0, 10, array_fill(0, 10, '🔴')); 

        while ($row = $result->fetch_assoc()) {
            $row_number = $row['Current_row'];
            $col_number = $row['Current_col'];
            $has_outbound_date = $row['has_outbound_date'];

 
            if ($has_outbound_date == 0) {
                $grid[$row_number][$col_number] = '🟢';
            }
        }


        echo '<table>';
        echo '<tr><td></td>';
        for ($k = 0; $k < 10; $k++) {
            echo '<td>A' . ($k + 1) . '</td>';
        }
        echo '</tr>';
        for ($i = 0; $i < 10; $i++) {
            echo '<tr>';
            echo '<td>B' . ($i + 1) . '</td>';
            for ($j = 0; $j < 10; $j++) {
                if ($grid[$i][$j] == '🟢') {
                    echo '<td class="green" data-row="' . $i . '" data-column="' . $j . '">' . $grid[$i][$j] . '</td>';
                } else {
                    echo '<td>' . $grid[$i][$j] . '</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }
} else {
    echo 'Error 404';
}

$sambung->close();
?>

     <div id="hoverInfo"></div>
        </div>
        
    </main>
    <footer>
        <p>&copy; 2023 Inbound & Outbound Control</p>
        <div class="footer">By Sylvester, Samuel & Tai</div>
    </footer>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var cells = document.querySelectorAll('td.green');

        cells.forEach(function(cell) {
            cell.addEventListener('mouseover', function() {
                var row = this.getAttribute('data-row');
                var column = this.getAttribute('data-column');
                var locationId = this.getAttribute('data-locationid');
                var userId = this.getAttribute('data-userid');
                var fullname = this.getAttribute('data-fullname');

                var locationText = 'Location: [ B' + ++row + ', A' + ++column + ' ID: ' + locationId + ']';
                var userText = 'User ID: ' + userId + ', Fullname: ' + fullname;

                document.getElementById('hoverInfo').innerHTML = locationText + '<br>' + userText;
                document.getElementById('hoverInfo').style.display = 'block';
                document.getElementById('hoverInfo').style.top = (this.offsetTop + this.offsetHeight) + 'px';
                document.getElementById('hoverInfo').style.left = this.offsetLeft + 'px';
            });

            cell.addEventListener('mouseleave', function() {
                document.getElementById('hoverInfo').style.display = 'none';
            });

            cell.addEventListener('click', function() {
                var row = this.getAttribute('data-row');
                var column = this.getAttribute('data-column');
                  window.location.reload();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert('Outbound selected for number: [' + 'A' + (parseInt(row) + 1) + ',' + 'B' + (parseInt(column) + 1) + ']');

        }
    };
                
    xhttp.open("POST", "out.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("row=" + row + "&column=" + column);
               
            });
        });
    });
</script>



</body>
</html>