<?php
require_once('bootstrap.php');
include('sambung.php');


if(isset($_SESSION['ID']) && isset($_SESSION['Name'])) {
     include('testt.php');
}
else{
     include('testtt.php');
}
    $sambungan->close();
?>
