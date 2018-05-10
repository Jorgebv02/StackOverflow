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