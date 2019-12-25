<?php

if($_POST){

    $sNewPropertyTitle = $_POST['title'];
    $sNewPropertyDescription = $_POST['description'];
    $sNewPropertyZipcode = $_POST['zipcode'];
    $sNewPropertyCity = $_POST['city'];
    $sNewPropertyAddress = $_POST['address'];
    $sNewPropertyPrice = $_POST['price'];
    $sNewPropertyBeds = $_POST['beds'];
    $sNewPropertyBaths = $_POST['baths'];
    $sNewPropertyMeters = $_POST['meters'];
    $sNewPropertyLatitude = $_POST['latitude'];
    $sNewPropertyLongitude = $_POST['longitude'];
    $sNewPropertyImage = $_FILES['image']['name'];

// Check if fields are empty
    if( empty($sNewPropertyTitle)){sendErrorMessage('Title is missing', __LINE__);exit;}
    if( empty($sNewPropertyDescription)){sendErrorMessage('Description is missing', __LINE__);exit;}
    if( empty($sNewPropertyZipcode)){sendErrorMessage('Zipcode is missing', __LINE__);exit;}
    if( empty($sNewPropertyCity)){sendErrorMessage('City is missing', __LINE__);exit;}
    if( empty($sNewPropertyAddress)){sendErrorMessage('Address is missing', __LINE__);exit;}
    if( empty($sNewPropertyPrice)){sendErrorMessage('Price is missing', __LINE__);exit;}
    if( empty($sNewPropertyBeds)){sendErrorMessage('Amount of bedrooms is missing', __LINE__);exit;}
    if( empty($sNewPropertyBaths)){sendErrorMessage('Amount of bathrooms is missing', __LINE__);exit;}
    if( empty($sNewPropertyMeters)){sendErrorMessage('Amount of square meters is missing', __LINE__);exit;}
    if( empty($sNewPropertyLatitude)){sendErrorMessage('Latitude is missing', __LINE__);exit;}
    if( empty($sNewPropertyLongitude)){sendErrorMessage('Longitude is missing', __LINE__);exit;}
    if( !isset($sNewPropertyImage)){sendErrorMessage('Image is missing', __LINE__);exit;}

// ******* Validate title ******
// -----> Min length
    if( strlen($sNewPropertyTitle) < 5 ){
        sendErrorMessage('Title must be at least 5 characters', __LINE__);
    }
// -----> Max length
    if( strlen($sNewPropertyTitle) > 25 ){
        sendErrorMessage('Title cannot be more than 25 characters', __LINE__);
    }

// ******* Validate description ******
// ----> Min length
    if( strlen($sNewPropertyDescription) < 15 ){
        sendErrorMessage('Description must be at least 15 characters', __LINE__);
    }

// ******* Validate zipcode ******
// ----> Is numeric
    if( !ctype_digit($sNewPropertyZipcode) ){
        sendErrorMessage('Zipcode must be digits', __LINE__);
    }
// ----> Length is correct
    if( strlen($sNewPropertyZipcode) != 4 ){
        sendErrorMessage('Zipcode must be four digits', __LINE__);
    }

// ******** Validate city *********
    if ( strlen($sNewPropertyCity) < 3 ){
        sendErrorMessage('City cannot be less than 3 characters', __LINE__);
    }

    if ( strlen($sNewPropertyCity) > 20 ){
        sendErrorMessage('City cannot be more than 20 characters', __LINE__);
    }

    // ******** Validate address *********
    if ( strlen($sNewPropertyAddress) < 3 ){
        sendErrorMessage('Address cannot be less than 3 characters', __LINE__);
    }

    if ( strlen($sNewPropertyAddress) > 35 ){
        sendErrorMessage('Address cannot be more than 35 characters', __LINE__);
    }

// ******* Validate price ******
// ----> Is numeric
    if( !ctype_digit($sNewPropertyPrice) ){
        sendErrorMessage('Price must be digits', __LINE__);
    }
// ----> Min length
    if( strlen($sNewPropertyPrice) < 3 ){
        sendErrorMessage('Price must be at least 3 digits', __LINE__);
    }
// -----> Max length
    if( strlen($sNewPropertyPrice) > 10 ){
        sendErrorMessage('Price cannot be more than 10 digits', __LINE__);
    }

// ******* Validate bedrooms ******
// ----> Is numeric
    if( !ctype_digit($sNewPropertyBeds) ){
        sendErrorMessage('Amount of bedrooms must be digits', __LINE__);
    }
// -----> Max length
    if( $sNewPropertyBeds > 20 ){
        sendErrorMessage('Amount of bedrooms cannot be more than 20', __LINE__);
    }

// ******* Validate bathrooms ******
// ----> Is numeric
    if( !ctype_digit($sNewPropertyBaths) ){
        sendErrorMessage('Amount of bathrooms must be digits', __LINE__);
    }
// -----> Max length
    if( $sNewPropertyBaths > 20 ){
        sendErrorMessage('Amount of bathrooms cannot be more than 20', __LINE__);
    }

// ******* Validate square meters ******
// ----> Is numeric
    if( !ctype_digit($sNewPropertyMeters) ){
        sendErrorMessage('Amount of square meters must be digits', __LINE__);
    }
// ----> Min length
    if( $sNewPropertyMeters < 10 ){
        sendErrorMessage('Amount of square meter must be at least 10', __LINE__);
    }
// -----> Max length
    if( $sNewPropertyMeters > 800 ){
        sendErrorMessage('Amount of square meter cannot be more than 800', __LINE__);
    }

// ******* Validate Longitude ******
// ----> Min length
if( strlen($sNewPropertyLongitude) != 9 ){
    sendErrorMessage('Longitude must be 8 digits with a point, 12.345678', __LINE__);
}

// if( !ctype_digit($sNewPropertyLongitude) ){
//     sendErrorMessage('Longitude must be digits', __LINE__);
// }

// ******* Validate Latitude ******
// ----> Min length
if( strlen($sNewPropertyLatitude) != 9 ){
    sendErrorMessage('Latitude must be 8 digits with a point, 12.345678', __LINE__);
}

// if( !ctype_digit($sNewPropertyLatitude) ){
//     sendErrorMessage('Latitude must be digits', __LINE__);
// }

// ******* Validate image ******
// ----> Allowed file extention
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

$jImageOneId = uniqid();

$sNewPropertyId = uniqid();

move_uploaded_file( $_FILES['image']['tmp_name'], __DIR__.'/images/'.$sNewPropertyId.$_FILES['image']['name']);


session_start();
$sAgentId = $_SESSION['id'];
$sImageUniqueId = uniqid();

$sNewPropertyTitle = $_POST['title'];
$sNewPropertyDescription = $_POST['description'];
$sNewPropertyZipcode = $_POST['zipcode'];
$sNewPropertyCity = $_POST['city'];
$sNewPropertyAddress = $_POST['address'];
$sNewPropertyPrice = $_POST['price'];
$sNewPropertyBeds = $_POST['beds'];
$sNewPropertyBaths = $_POST['baths'];
$sNewPropertyMeters = $_POST['meters'];

$sjData = file_get_contents(__DIR__.'/data.json');
$jData = json_decode($sjData);

$jProperty = new stdClass();
$time=time();

$jProperty->title = $sNewPropertyTitle;
$jProperty->description = $sNewPropertyDescription;
$jProperty->zip = $sNewPropertyZipcode;
$jProperty->city = $sNewPropertyCity;
$jProperty->address = $sNewPropertyAddress;
$jProperty->price = intVal($sNewPropertyPrice);
$jProperty->bedrooms = intVal($sNewPropertyBeds);
$jProperty->bathrooms = intVal($sNewPropertyBaths);
$jProperty->meters = intVal($sNewPropertyMeters);
$jProperty->viewed = 0;
$jProperty->liked = 0;
$jProperty->image = $sNewPropertyId.$_FILES['image']['name'];
$jProperty->uploaded = date("d-M-y", $time);

$sPropertyUniqueID = uniqid();

$jData->agents->$sAgentId->properties->$sPropertyUniqueID = $jProperty;

$sjData = json_encode( $jData, JSON_PRETTY_PRINT );
file_put_contents(__DIR__.'/data.json', $sjData);



// $sNewPropertyLatitude = $_POST['latitude'];
// $sNewPropertyLongitude = $_POST['longitude'];


$sjCoordinates = file_get_contents(__DIR__.'/data-properties-coordinates.json');
$jCoordinates = json_decode($sjCoordinates);


$jPropertyCoordinates = new stdClass();
$jPropertyCoordinates->id = $sPropertyUniqueID;
$jPropertyCoordinates->geometry = new stdClass();
$jPropertyCoordinates->geometry->coordinates = [floatval($sNewPropertyLatitude), floatval($sNewPropertyLongitude)];
$jPropertyCoordinates->geometry->type = "Point";
$jPropertyCoordinates->properties = new stdClass();
$jPropertyCoordinates->properties->iconSize = [40, 40];
$jPropertyCoordinates->properties->message = '';
$jPropertyCoordinates->type = "Feature";
$jPropertyCoordinates->image = '';

// $jCoordinates = $jPropertyCoordinates;

array_push($jCoordinates, $jPropertyCoordinates);

$sjCoordinates = json_encode($jCoordinates, JSON_PRETTY_PRINT);
file_put_contents(__DIR__.'/data-properties-coordinates.json', $sjCoordinates);




// echo '{"status":1,"message":"New property has been added","id":"'.$sPropertyUniqueID.'","line":'.__LINE__.'}';
header("HTTP/1.1 200 PROPERTY CREATED, Line: .__LINE__.");
// // header('Location: index.php');
}




// ****************************** Functions ******************************

function sendErrorMessage($sErrorMessage, $sErrorMessageLineNumber){
    // echo '{"status":0,"message":'.$sErrorMessage.',"line":'.$sErrorMessageLineNumber.'}';
    header("HTTP/1.1 512 PROPERTY NOT CREATED: Error: $sErrorMessage, Line: .$sErrorMessageLineNumber.");
    exit;
}
?>