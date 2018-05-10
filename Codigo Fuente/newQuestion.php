<?php
include "database.php";

$name = $_REQUEST['name'];
$lastname = $_REQUEST['lastname'];
$mail = $_REQUEST['mail'];
$pass = password_hash($_REQUEST['pass'], PASSWORD_BCRYPT);

$document = newDoc();
$document->set("_key", $mail);
$document->set("name", $name);
$document->set("lastname", $lastname);
$document->set("pass", $pass);

$id = saveDoc("users", $document);
echo $id;
?>