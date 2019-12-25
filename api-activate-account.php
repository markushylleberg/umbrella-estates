<?php

$newUserName = $_GET['name'];
$newUserId = $_GET['id'];
$newAgent = $_GET['type'];

echo "<h1>Welcome $newUserName</h1>";
echo "<h3>You have activated your account!</h3>";

$sjData = file_get_contents('data.json');
$jData = json_decode($sjData);

if ( $newAgent == 'agent' ){

    if( $jData->agents->$newUserId->activated == 1 ){
        echo 'You cannot activate this account again';
        exit;
    }

    if( $jData->agents->$newUserId->activated == 0 ){
        echo 'match found!';
        $jData->agents->$newUserId->activated = 1;
    
        $sjData = json_encode($jData, JSON_PRETTY_PRINT);
        file_put_contents('data.json', $sjData);
        exit;
    }
}


if( $jData->users->$newUserId->activated == 1 ){
    echo 'You cannot activate this account again';
    exit;
}

if( $jData->users->$newUserId->activated == 0 ){
    echo 'match found!';
    $jData->users->$newUserId->activated = 1;

    $sjData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $sjData);
} else {
    echo 'no match found';
}