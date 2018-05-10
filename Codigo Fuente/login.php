<?php
include "database.php";

$mail = $_REQUEST['mail'];

if (existDoc("users", $mail)){
    $json = readDoc("users", $mail);
    $array = json_decode($json);
    if (password_verify($_REQUEST['pass'], $array->{'pass'})){
        session_start();
        $_SESSION['mail'] = $mail;
        echo "successful";
    }else{
        echo "error";
    }

} else {
    echo "error";
}
?>
