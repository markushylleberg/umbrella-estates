<?php

$sLikedProperty = $_GET['id'];
$sPropertyAgent = $_GET['agent'];

session_start();

$sLikedPropertyUserId = $_SESSION['id'];

// echo 'property '.$sLikedProperty.'<br>';
// echo 'user '.$sLikedPropertyUserId.'<br';
// echo 'agent '.$sPropertyAgent;

$sjData = file_get_contents('data.json');
$jData = json_decode($sjData);


// foreach( $jData->users as $user => $sValue){
//     foreach($sValue->liked as $likedProperty){
//         if ( $likedProperty == $sLikedProperty){
//             echo 'x';
//         }
//     }
// }

$currentLiked = $jData->agents->$sPropertyAgent->properties->$sLikedProperty->liked;

unset($jData->users->$sLikedPropertyUserId->liked->$sLikedProperty);
$jData->agents->$sPropertyAgent->properties->$sLikedProperty->liked = ($currentLiked - 1);

$sjData = json_encode($jData, JSON_PRETTY_PRINT);
file_put_contents('data.json', $sjData);

header('Location: index.php');