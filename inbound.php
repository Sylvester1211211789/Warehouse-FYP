<?php
require_once('bootstrap.php');
include('sambung.php');
session_start();
$id = $_SESSION['ID'];
echo $id;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Product = $_POST["ProductsID"];
    $act = "RETRIEVE";
    $date = date("Y/m/d");
    $time = date("h:i:sa");

    $insert = "INSERT INTO task(ProductID, Action, Date, Time) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($sambungan, $insert);
    mysqli_stmt_bind_param($stmt, "ssss", $Product, $act, $date, $time);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Sign up successful! The ManagerID had sended to the admin email.')</script>";
    } else {
        echo "<script>alert('Signup unsuccessful')</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($sambungan);

    echo "<script>window.location='inbound.php'</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup_style.css">
    <title>Signup Pages</title>
    <style>
            select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
    body {
    background-color: #1a1a1a;
    background-image: url("j.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center; 
    height: 100vh; 
    margin: 0; 
    overflow: hidden; 
    font-family: Helvetica, Arial, sans-serif;
}


.form-container {
  width: 350px;
  height: 400px;
  background-color: #fff;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  border-radius: 10px;
  box-sizing: border-box;
  padding: 20px 30px;
  display: flex; /* Add flex container */
  flex-direction: column; /* Arrange children vertically */
  justify-content: center; /* Center align vertically */
  align-items: center; /* Center align horizontally */
  margin-left:auto;
  margin-right:auto;
}

.title {
  text-align: center;
  font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
        "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
  margin: 10px 0 30px 0;
  font-size: 28px;
  font-weight: 800;
}

.form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 18px;
  margin-bottom: 15px;
}

.input {
  border-radius: 20px;
  border: 1px solid #c0c0c0;
  outline: 0 !important;
  box-sizing: border-box;
  padding: 12px 15px;
}

.page-link {
  text-decoration: underline;
  margin: 0;
  text-align: end;
  color: #747474;
  text-decoration-color: #747474;
}

.page-link-label {
  cursor: pointer;
    font-family: Helvetica, Arial, sans-serif;
  font-size: 9px;
  font-weight: 700;
}

.page-link-label:hover {
  color: #000;
}

.form-btn {
  padding: 10px 15px;
    font-family: Helvetica, Arial, sans-serif;
  border-radius: 20px;
  border: 0 !important;
  outline: 0 !important;
  background: teal;
  color: white;
  cursor: pointer;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}

.form-btn:active {
  box-shadow: none;
}

.sign-up-label {
  margin: 0;
  font-size: 10px;
  color: #747474;
    font-family: Helvetica, Arial, sans-serif;
}

.sign-up-link {
  margin-left: 1px;
  font-size: 11px;
  text-decoration: underline;
  text-decoration-color: teal;
  color: teal;
  cursor: pointer;
  font-weight: 800;
    font-family: Helvetica, Arial, sans-serif;
}

.buttons-container {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  margin-top: 20px;
  gap: 15px;
}

.apple-login-button,
    .google-login-button {
  border-radius: 20px;
  box-sizing: border-box;
  padding: 10px 15px;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px,
        rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
    font-family: Helvetica, Arial, sans-serif;
  font-size: 11px;
  gap: 5px;
}

.apple-login-button {
  background-color: #000;
  color: #fff;
  border: 2px solid #000;
}

.google-login-button {
  border: 2px solid #747474;
}

.apple-icon,
    .google-icon {
  font-size: 18px;
  margin-bottom: 1px;
}</style>
</head>
<body>
    <div class="form-container">
        <p class="title">Inbound</p>
        <form class="form" method="post">
            <select name="ProductsID">
                <option value="" class="input">Select Product ID</option>
                <?php
                $query = "SELECT ProductID, Product_Name FROM product where UserID='$id'";
                $result = mysqli_query($sambungan, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($optionData = mysqli_fetch_assoc($result)) {
                        $option = $optionData['Product_Name'];
                        $ids = $optionData['ProductID'];
                ?>
                        <option value="<?php echo $ids; ?>"><?php echo $option; ?> </option>
                <?php
                    }
                }
                ?>
            </select>
            <button class="form-btn" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
