<?php

    if ( $_SESSION ){
        header('Location: index.php');
    }

    if ( $_POST ){

    $sNewUserName = $_POST['agentName'];
    $sNewUserLastName = $_POST['agentLastName'];
    $sNewUserEmail = $_POST['agentEmail'];
    $sNewUserPassword = $_POST['agentPassword'];
    $sNewUserAddress = $_POST['agentAddress'];
    $sNewUserCity = $_POST['agentCity'];
    $sNewUserCountry = $_POST['agentCountry'];
    $sNewUserProfilePicture = $_FILES['agentImage'];

// CHECK IF FIELDS HAS BEEN FILLED OUT
if ( empty($sNewUserName) ){showErrorMessage('Missing name', __LINE__);}
if ( empty($sNewUserLastName) ){showErrorMessage('Missing last name', __LINE__);}
if ( empty($sNewUserEmail) ){showErrorMessage('Missing email', __LINE__);}
if ( empty($sNewUserPassword) ){showErrorMessage('Missing password', __LINE__);}
if ( empty($sNewUserAddress) ){showErrorMessage('Missing address', __LINE__);}
if ( empty($sNewUserCity) ){showErrorMessage('Missing city', __LINE__);}
if ( empty($sNewUserCountry) ){showErrorMessage('Missing country', __LINE__);}
if ( empty($sNewUserProfilePicture) ){showErrorMessage('Missing image', __LINE__);}


if(strlen($sNewUserName) < 2 ){
    showErrorMessage('first name must be at least 2 characters', __LINE__);
}

if(strlen($sNewUserName) > 25 ){
    showErrorMessage('first name cannot be more than 25 characters', __LINE__);
}

if(strlen($sNewUserLastName) < 2 ){
    showErrorMessage('last name must be at least 2 characters', __LINE__);
}

if(strlen($sNewUserLastName) > 25 ){
    showErrorMessage('last name cannot be more than 25 characters', __LINE__);
}

if(strlen($sNewUserPassword) < 6 ){
    showErrorMessage('password must be at least 6 characters', __LINE__);
}

if(strlen($sNewUserPassword) > 35 ){
    showErrorMessage('password cannot be more than 35 characters', __LINE__);
}

if( !filter_var($sNewUserEmail, FILTER_VALIDATE_EMAIL) ){
    showErrorMessage('email must be a valid email', __LINE__);
}

// OPEN JSON + ADD NEW USER + CLOSE JSON
$sjData = file_get_contents(__DIR__.'/data.json');
$jData = json_decode($sjData);

foreach( $jData->agents as $sUser => $sValue ){

    if( $sNewUserEmail == $sValue->email ){
        showErrorMessage('email is already signed up', __LINE__);
    }
}

if ( !file_exists($_FILES['agentImage']['tmp_name']) ) {
    showErrorMessage('agents must have profile pictures', __LINE__);
}  else {

    $sExtension = pathinfo($_FILES['agentImage']['name'], PATHINFO_EXTENSION);
    $sExtension = strtolower($sExtension);
    $aAllowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

    if( !in_array( $sExtension, $aAllowedExtensions ) ){
        showErrorMessage('only png, jpg, jpeg and gifs allowed', __LINE__);
    }

    // Check if the image size is too small
    if( $_FILES['agentImage']['size'] < 2480 ){
        showErrorMessage('the image size is too small', __LINE__);
    }

    // Check if the image size is too big
    if( $_FILES['agentImage']['size'] > 5242880 ){
       showErrorMessage('the image size is too big', __LINE__);
    }

}




// MOVE THE IMAGE TO THE IMAGES FOLDER WITH EXTENTION OF FILE
    $sUniqueUserProfilePictureId = uniqid();

    move_uploaded_file($sNewUserProfilePicture['tmp_name'], __DIR__.'/images/'.$sUniqueUserProfilePictureId.'.'.pathinfo($sNewUserProfilePicture['name'], PATHINFO_EXTENSION));

// OPEN JSON + ADD NEW USER + CLOSE JSON
    $sjData = file_get_contents(__DIR__.'/data.json');
    $jData = json_decode($sjData);

    $uniqueUserId = 'agent'.uniqid();
    $activationKey = uniqid();

    $jAgent = new stdClass();
    $jAgent->id = $uniqueUserId;
    $jAgent->firstname = $sNewUserName;
    $jAgent->lastname = $sNewUserLastName;
    $jAgent->email = $sNewUserEmail;
    $jAgent->password = $sNewUserPassword;
    $jAgent->address = $sNewUserAddress;
    $jAgent->city = $sNewUserCity;
    $jAgent->country = $sNewUserCountry;
    $jAgent->activationKey = $activationKey;
    $jAgent->activated = 0;
    $jAgent->profilepicture = $sUniqueUserProfilePictureId.'.'.pathinfo($sNewUserProfilePicture['name'], PATHINFO_EXTENSION);
    $jAgent->properties = new stdClass();

    $jData->agents->$uniqueUserId = $jAgent;

    $sjData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__.'/data.json', $sjData);
    header("Location: api-send-activation-key.php?type=agent&key=$uniqueUserId&email=$sNewUserEmail&activationkey=$activationKey&name=$sNewUserName;");

}

// ***************************** FUNCTIONS ************************************

function showErrorMessage($sErrorMessage, $sErrorMessageLineNumber){
    echo '{"status":0,"message":"'.$sErrorMessage.'","line":"'.$sErrorMessageLineNumber.'"}';
    exit;
}