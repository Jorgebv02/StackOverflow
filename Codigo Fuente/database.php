<?php

include "../vendor/autoload.php";

function arangoConnect (){
    $connectionOptions =array(
        // server endpoint to connect to
        \ArangoDBClient\ConnectionOptions::OPTION_ENDPOINT => 'tcp://127.0.0.1:8529',
        // authorization type to use (currently supported: 'Basic')
        \ArangoDBClient\ConnectionOptions::OPTION_AUTH_TYPE => 'Basic',
        // user for basic authorization
        \ArangoDBClient\ConnectionOptions::OPTION_AUTH_USER => 'root',
        // password for basic authorization
        \ArangoDBClient\ConnectionOptions::OPTION_AUTH_PASSWD => '123',
        // connection persistence on server. can use either 'Close' (one-time connections) or 'Keep-Alive' (re-used connections)
        \ArangoDBClient\ConnectionOptions::OPTION_CONNECTION => 'Close',
        // connect timeout in seconds
        \ArangoDBClient\ConnectionOptions::OPTION_TIMEOUT => 3,
        // whether or not to reconnect when a keep-alive connection has timed out on server
        \ArangoDBClient\ConnectionOptions::OPTION_RECONNECT => true,
        // optionally create new collections when inserting documents
        \ArangoDBClient\ConnectionOptions::OPTION_CREATE => true,
        // optionally create new collections when inserting documents
        \ArangoDBClient\ConnectionOptions::OPTION_UPDATE_POLICY => \ArangoDBClient\UpdatePolicy::LAST,
    );

// open connection
    $connection = new \ArangoDBClient\Connection($connectionOptions);
    return $connection;
}

function newCollection($name){
    // create a new collection
    $conn = arangoConnect();
    $collectionName = $name;
    $collection = new \ArangoDBClient\Collection($collectionName);
    $collectionHandler = new \ArangoDBClient\CollectionHandler($conn);

    if ($collectionHandler->has($collectionName)) {
        // drops an existing collection with the same name to make
        // tutorial repeatable
        //$collectionHandler->drop($collectionName);
    } else {

    }

    $collectionId = $collectionHandler->create($collection);
    return $documentHandler = new \ArangoDBClient\DocumentHandler($conn);

    var_dump($collectionId);
}

function newDoc(){
// create a document with some attributes
    return $document = new \ArangoDBClient\Document();
}

function saveDoc($collection, $document){
    $conn = arangoConnect();
    $handler = new \ArangoDBClient\DocumentHandler($conn);
    $documentId = $handler->save($collection, $document);
    echo "InsertedDocument:".$documentId;
    return $documentId;
}

function readDoc($collection, $id){
    $conn = arangoConnect();
    $documentHandler = new \ArangoDBClient\DocumentHandler($conn);
    $document = $documentHandler->get($collection, $id);
    return $document;
}

function existDoc($collection, $id){
    $conn = arangoConnect();
    $documentHandler = new \ArangoDBClient\DocumentHandler($conn);
    try{
        if($id = $documentHandler->get($collection, $id)){
            return true;
        }
    }catch (Exception $e){
        return false;
    }
}

function update($collection, $_key, $key, $value){

    $query = "  UPDATE { _key: '$_key' }
                    WITH { $key: '$value' }
                    IN $collection";
    $connection = arangoConnect();
    $statement = new \ArangoDBClient\Statement(
        $connection,
        array(
            "query"     => $query,
            "count"     => true,
            "batchSize" => 1000,
            "sanitize"  => true
        )
    );
    $cursor = $statement->execute();
    $resultingDocuments = array();
    foreach ($cursor as $key => $value) {
        $resultingDocuments[$key] = $value;
    }

}

function loadQuestions(){
    $query = "FOR question IN questions
                RETURN question";
    $connection = arangoConnect();
    $statement = new \ArangoDBClient\Statement(
        $connection,
        array(
            "query"     => $query,
            "count"     => true,
            "batchSize" => 1000,
            "sanitize"  => true
        )
    );
    $cursor = $statement->execute();
    $resultingDocuments = array();
    foreach ($cursor as $key => $value) {
        $resultingDocuments[$key] = $value;
    }
    return $resultingDocuments;
}

function printQuestions(){
    $arr = loadQuestions();
    for ($i = 0; $i < count($arr); $i++){
        $doc = json_decode($arr[$i]);
        //echo " ".$doc->{'question'};
        $cantR = explode("||", $doc->{'answers'});
        $text = "<div id=\"\" class=\"w3-row-padding\">
        <div class=\"w3-col m12\">
            <div class=\"w3-card-2 w3-round w3-dark-gray\">
                <div class=\"w3-container w3-padding\">
                    <div class=\"w3-col m3\">
                        <img src=\"../imgs/question.png\" class=\"w3-left\" alt=\"Norway\" style=\"width:50%\">
                    </div>
                    <div class=\"w3-col m6\">
                        <h3>".$doc->{'question'}."</h3>
                        <p>".(count($cantR)-1)." respuestas</p>
                    </div>
                    <div class=\"w3-col m3\">
                        <button name=\"".$doc->{'_key'}."\" onclick='view(this.name)' type=\"button\" class=\"btn btn-defaul w3-right w3-gray w3-hover-light-gray\" data-dismiss=\"modal\"><span class=\"fa fa-eye\"></span> Ver respuestas</button>
                        <h6>date</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h6></h6>";
        echo $text;
    }
}

function loadAnswers($answers){
    if($answers != "") {
        $arr = explode("||", $answers);
        for ($i = 0; $i < count($arr); $i++) {
            $answer = explode("<>", $arr[$i]);
            $text = "<div id=\"\" class=\"w3-row-padding\">
        <div class=\"w3-col m12\">
            <div class=\"w3-card-2 w3-round w3-gray\">
                <div class=\"w3-container w3-padding\">
                    <div class=\"w3-col m3\">
                        <img src=\"../imgs/reply.png\" class=\"w3-left\" alt=\"Norway\" style=\"width:50%\">
                    </div>
                    <div class=\"w3-col m6\">
                        <h3>" . $answer[2] . " " . $answer[3] . " (" . $answer[1] . ")</h3>
                        <p>" . $answer[0] . "</p>
                    </div>
                </div>
            </div>
        </div>
    </div><h6></h6>";
            echo $text;
        }
    }
}


/*
    $document = newDoc();
    $document->set("_key", "as@gmail.com");
    $document->set("a", "Foo");
    $document->set("b", "bar");
    $document->set("c", "abcd");

    $id = saveDoc("firstCollection", $document);
    readDoc("firstCollection", $id);
*/
?>