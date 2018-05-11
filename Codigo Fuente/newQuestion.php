<?php
include "database.php";

session_start();
if(isset($_SESSION['mail'])) {

    $question = $_REQUEST['question'];
    $tags = $_REQUEST['tags'];

    $document = newDoc();
    $document->set("question", $question);
    $document->set("tags", $tags);
    $document->set("mail", $_SESSION['mail']);
    $document->set("name", $_SESSION['name']);
    $document->set("lastname", $_SESSION['lastname']);
    $document->set("answers", "");

    $id = saveDoc("questions", $document);
    echo $id;
}
?>
