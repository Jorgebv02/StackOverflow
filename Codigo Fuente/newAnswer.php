<?php
include "database.php";

/*
 * Requests
 */
session_start();
if(isset($_SESSION['mail'])) {
    $question = $_REQUEST['question'];
    $answer = $_REQUEST['answer'] . "<>" . $_SESSION['mail'] . "<>" . $_SESSION['name'] . "<>" . $_SESSION['lastname'];

    /*
     * Get Current Answers
     */

    $json = readDoc("questions", $question);
    $array = json_decode($json);
    $currAnswers = $json->{'answers'};

    /*
     * Add separator
     */

    if ($currAnswers != "") {
        $currAnswers = "||" . $currAnswers;
    }


    /*
     * Modify current answers
     */

    //echo " collection:".$collection." id:".$id." key:".$key." value:".$value;
    update("questions", $question, "answers", $answer . $currAnswers);

}
?>
