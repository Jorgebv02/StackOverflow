<?php
include "database.php";
$conn = arangoConnect();
if (existDoc("users", $_REQUEST['mail'])){
    echo "exist";
} else {
    echo "not";
}
?>
