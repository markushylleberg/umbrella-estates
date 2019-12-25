<?php

session_start();
$userId = $_SESSION['id'];

if ( $_POST ){

    $sUserNewFirstName = $_POST['firstname'];
    $sUserNewLastName = $_POST['lastname'];
    $sUserNewAddress = $_POST['address'];
    $sUserNewCity = $_POST['city'];
    $sUserNewCountry = $_POST['country'];
    $sUserNewImage = $_FILES['image']['name'];


    if ( empty($sUserNewFirstName) ){sendErrorMessage('Missing name', __LINE__);}
    if ( empty($sUserNewLastName) ){sendErrorMessage('Missing last name', __LINE__);}


    if(strlen($sUserNewFirstName) < 2 ){
        sendErrorMessage('first name must be at least 2 characters', __LINE__);
    }

    if(strlen($sUserNewFirstName) > 25 ){
        sendErrorMessage('first name cannot be more than 25 characters', __LINE__);
    }

    if(strlen($sUserNewLastName) < 2 ){
        sendErrorMessage('last name must be at least 2 characters', __LINE__);
    }

    if(strlen($sUserNewLastName) > 25 ){
        sendErrorMessage('last name cannot be more than 25 characters', __LINE__);
    }

    if( !empty($sUserNewImage) ){

    $sExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $sExtension = strtolower($sExtension);
    $aAllowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    
    if( !in_array( $sExtension, $aAllowedExtensions ) ){
        sendErrorMessage('Only png, jpg, jpeg and gifs allowed', __LINE__);
    }
    // ----> Allowed min size
    if( $_FILES['image']['size'] < 2480 ){
        sendErrorMessage('The image size is too small', __LINE__);
    }
    // ----> Allowed max size
    if( $_FILES['image']['size'] > 5242880 ){
        sendErrorMessage('The image size is too big', __LINE__);
    }

}
    
    $sUserNewImageId = uniqid();
    
    move_uploaded_file( $_FILES['image']['tmp_name'], __DIR__.'/images/'.$sUserNewImageId.$_FILES['image']['name']);



    $sjData = file_get_contents(__DIR__.'/data.json');
    $jData = json_decode($sjData);

    $sExistingId = $_SESSION['id'];
// ***************************************** IF USER ********************************************
    if(!preg_match('/agent/', $_SESSION['id']) ){

        $sExistingProfilePicture = $jData->users->$userId->profilepicture;
    
            $jUserData->id = $sExistingId;
            $jUserData->firstname = $sUserNewFirstName;
            $jUserData->lastname = $sUserNewLastName;
            $jUserData->email = $jData->users->$userId->email;
            $jUserData->password = $jData->users->$userId->password;
            $jUserData->activationKey = $jData->users->$userId->activationKey;
            $jUserData->activated = $jData->users->$userId->activated;

            if( !empty($sUserNewImage) ){
                $jUserData->profilepicture = $sUserNewImageId.$_FILES['image']['name'];
            } else {
            $jUserData->profilepicture = $sExistingProfilePicture;
            }

            $jUserData->liked = $jData->users->$userId->liked;
        
            $jData->users->$userId = $jUserData;
        
        header("HTTP/1.1 200 USER SUCCESFULLY UPDATED $userId");

// ***************************************** IF AGENT ********************************************
    } else {

        // ******** Validate city *********
    if ( strlen($sUserNewCity) < 3 ){
        sendErrorMessage('City cannot be less than 3 characters', __LINE__);
    }

    if ( strlen($sUserNewCity) > 20 ){
        sendErrorMessage('City cannot be more than 20 characters', __LINE__);
    }

    // ******** Validate address *********
    if ( strlen($sUserNewAddress) < 3 ){
        sendErrorMessage('Address cannot be less than 3 characters', __LINE__);
    }

    if ( strlen($sUserNewAddress) > 20 ){
        sendErrorMessage('Address cannot be more than 30 characters', __LINE__);
    }

    // ******** Validate country *********
    if ( strlen($sUserNewCountry) < 3 ){
        sendErrorMessage('Country cannot be less than 3 characters', __LINE__);
    }
    
    if ( strlen($sUserNewCountry) > 20 ){
        sendErrorMessage('Country cannot be more than 30 characters', __LINE__);
    }


        $sExistingProfilePicture = $jData->agents->$userId->profilepicture;

        $jUserData->id = $sExistingId;
        $jUserData->firstname = $sUserNewFirstName;
        $jUserData->lastname = $sUserNewLastName;
        $jUserData->email = $jData->agents->$userId->email;
        $jUserData->password = $jData->agents->$userId->password;
        $jUserData->address = $sUserNewAddress;
        $jUserData->city = $sUserNewCity;
        $jUserData->country = $sUserNewCountry;
        $jUserData->activationKey = $jData->agents->$userId->activationKey;
        $jUserData->activated = $jData->agents->$userId->activated;

        if( !empty($sUserNewImage) ){
            $jUserData->profilepicture = $sUserNewImageId.$_FILES['image']['name'];
        } else {
        $jUserData->profilepicture = $sExistingProfilePicture;
        }

        $jUserData->properties = $jData->agents->$userId->properties;

        $jData->agents->$userId = $jUserData;
        
        header("HTTP/1.1 200 AGENT SUCCESFULLY UPDATED $userId");

    }

    $sjData = json_encode( $jData, JSON_PRETTY_PRINT );
    file_put_contents(__DIR__.'/data.json', $sjData);

}

// ****************************** Functions ******************************

function sendErrorMessage($sErrorMessage, $sErrorMessageLineNumber){
    // echo '{"status":0,"message":'.$sErrorMessage.',"line":'.$sErrorMessageLineNumber.'}';
    header("HTTP/1.1 512 NOT UPDATED: Error: $sErrorMessage, Line: .$sErrorMessageLineNumber.");
    exit;
}