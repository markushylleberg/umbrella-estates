<?php

if ( $_SESSION ){
    $sProfileId = $_SESSION['id'];




// echo $sProfileId;

$sjData = file_get_contents('data.json');
$jData = json_decode($sjData);

if( strpos($sProfileId, 'agent') !== false ){
    // echo 'agent has logged in';
    // echo json_encode($jData->agents->$sProfileId);


} else {
    // echo 'user has logged in';
    // echo json_encode($jData->users->$sProfileId);


}

}