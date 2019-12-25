<?php

session_start();

$sUserId = $_SESSION['id'];

if( !$_SESSION ){
    header('Location: index.php');
}

$sjData = file_get_contents(__DIR__.'/data.json');
$jData = json_decode($sjData);

// ************************************* IF USER **********************************************
if(!preg_match('/agent/', $_SESSION['id']) ){

    unset($jData->users->$sUserId);
    session_destroy();
    header('Location: index.php');

 // ************************************* IF AGENT **********************************************
} else {

    unset($jData->agents->$sUserId);
    session_destroy();
    header('Location: index.php');

}

$sjData = json_encode( $jData, JSON_PRETTY_PRINT );
file_put_contents(__DIR__.'/data.json', $sjData);

