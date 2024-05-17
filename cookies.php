<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

<h2>Admin Panel</h2>

<form method="post">
    <button type="submit" name="edit_user">Edit User Name</button>
    <button type="submit" name="edit_admin">Edit Admin Name</button>
    <button type="submit" name="edit_manager">Edit Manager Name</button>
</form>

<?php
include('sambung.php');
session_start();

    $_SESSION['user'] = null;

echo $_SESSION['user'];
if (isset($_POST['edit_user'])) {

    $_SESSION['user']='user'; 
    header("Location: Admin_edit_name.php");
    exit();
} elseif (isset($_POST['edit_admin'])) {

    $_SESSION['user']='admin'; 
    header("Location: Admin_edit_name.php");
    exit();
} elseif (isset($_POST['edit_manager'])) {
    $_SESSION['user']='manager'; 
    header("Location: Admin_edit_name.php");
    exit();
}
?>

</body>
</html>
