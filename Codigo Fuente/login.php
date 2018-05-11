<?php
include "database.php";
session_start();
if(!isset($_SESSION['mail'])) {
    $mail = $_REQUEST['mail'];

    if (existDoc("users", $mail)) {
        $json = readDoc("users", $mail);
        $array = json_decode($json);
        if (password_verify($_REQUEST['pass'], $array->{'pass'})) {
            session_start();
            $_SESSION['mail'] = $mail;
            $_SESSION['name'] = $json->{'name'};
            $_SESSION['lastname'] = $json->{'lastname'};
            echo "successful";
        } else {
            echo "error";
        }

    } else {
        echo "error";
    }
}
?>
