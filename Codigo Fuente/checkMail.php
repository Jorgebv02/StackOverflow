<?php
include "database.php";
session_start();
if(isset($_SESSION['mail'])) {
    $conn = arangoConnect();
    if (existDoc("users", $_REQUEST['mail'])) {
        echo "exist";
    } else {
        echo "not";
    }
}
?>
