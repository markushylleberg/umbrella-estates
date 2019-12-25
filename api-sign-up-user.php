<?php

    if ( $_SESSION ){
        header('Location: index.php');
    }


    if ( $_POST ){

        $sNewUserName = $_POST['userName'];
        $sNewUserLastName = $_POST['userLastName'];
        $sNewUserEmail = $_POST['userEmail'];
        $sNewUserPassword = $_POST['userPassword'];
        $sNewUserProfilePicture = $_FILES['userImage'];


        // OPEN JSON + ADD NEW USER + CLOSE JSON
    $sjData = file_get_contents(__DIR__.'/data.json');
    $jData = json_decode($sjData);

    foreach( $jData->users as $sUser => $sValue ){

        if( $sNewUserEmail == $sValue->email ){
            showErrorMessage("$sValue->email is already signed up", __LINE__);
        }
    }


        // CHECK IF FIELDS HAS BEEN FILLED OUT
    if ( empty($sNewUserName) ){showErrorMessage('Missing name', __LINE__);}
    if ( empty($sNewUserLastName) ){showErrorMessage('Missing last name', __LINE__);}
    if ( empty($sNewUserEmail) ){showErrorMessage('Missing email', __LINE__);}
    if ( empty($sNewUserPassword) ){showErrorMessage('Missing password', __LINE__);}

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


    if ( !file_exists($_FILES['userImage']['tmp_name']) ) {
        echo 'Missing image - applying a default profile picture';
    }  else {

        $sExtension = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
        $sExtension = strtolower($sExtension);
        $aAllowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    
        if( !in_array( $sExtension, $aAllowedExtensions ) ){
            showErrorMessage('only png, jpg, jpeg and gifs allowed', __LINE__);
        }
    
        // Check if the image size is too small
        if( $_FILES['userImage']['size'] < 2480 ){
            showErrorMessage('the image size is too small', __LINE__);
        }
    
        // Check if the image size is too big
        if( $_FILES['userImage']['size'] > 5242880 ){
           showErrorMessage('the image size is too big', __LINE__);
        }

    }



    $uniqueUserId = uniqid();
    $activationKey = uniqid();

    $jUser = new stdClass();
    $jUserLikes = new stdClass();

    $jUser->id = $uniqueUserId;
    $jUser->firstname = $sNewUserName;
    $jUser->lastname = $sNewUserLastName;
    $jUser->email = $sNewUserEmail;
    $jUser->password = $sNewUserPassword;
    $jUser->activationKey = $activationKey;
    $jUser->activated = 0;

    if( !$_FILES['userImage']['name'] ){
        $jUser->profilepicture = 'defaultNewUser.png';
    } else {
        $sUniqueUserProfilePictureId = uniqid();

        move_uploaded_file($sNewUserProfilePicture['tmp_name'], __DIR__.'/images/'.$sUniqueUserProfilePictureId.'.'.pathinfo($sNewUserProfilePicture['name'], PATHINFO_EXTENSION));

        $jUser->profilepicture = $sUniqueUserProfilePictureId.'.'.pathinfo($sNewUserProfilePicture['name'], PATHINFO_EXTENSION);
    }

    $jUser->liked = $jUserLikes;

    // $jUser->profilepicture = $sUniqueUserProfilePictureId.'.'.pathinfo($sNewUserProfilePicture['name'], PATHINFO_EXTENSION);

    $jData->users->$uniqueUserId = $jUser;

    $sjData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__.'/data.json', $sjData);
    header("Location: api-send-activation-key.php?type=user&key=$uniqueUserId&email=$sNewUserEmail&activationkey=$activationKey&name=$sNewUserName;");
    echo '{"status":1,"message":"new user has signed up","line":'.__LINE__.'}';

}

// ***************************** FUNCTIONS ************************************

function showErrorMessage($sErrorMessage, $sErrorMessageLineNumber){
    echo '{"status":0,"message":"'.$sErrorMessage.'","line":"'.$sErrorMessageLineNumber.'"}';
    exit;
}


