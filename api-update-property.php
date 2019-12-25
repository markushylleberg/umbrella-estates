<?php

    if ( $_POST ){

        $sNewPropertyTitle = $_POST['title'];
        $sNewPropertyDescription = $_POST['description'];
        $sNewPropertyZipcode = $_POST['zipcode'];
        $sNewPropertyCity = $_POST['city'];
        $sNewPropertyAddress = $_POST['address'];
        $sNewPropertyPrice = $_POST['price'];
        $sNewPropertyBeds = $_POST['bedrooms'];
        $sNewPropertyBaths = $_POST['bathrooms'];
        $sNewPropertyMeters = $_POST['meters'];
        // $sNewPropertyLatitude = $_POST['latitude'];
        // $sNewPropertyLongitude = $_POST['longitude'];
        $sNewPropertyImage = $_FILES['image']['name'];


    // Check if fields are empty
    if( empty($sNewPropertyTitle)){showErrorMessage('Title is missing', __LINE__);}
    if( empty($sNewPropertyDescription)){showErrorMessage('Description is missing', __LINE__);}
    if( empty($sNewPropertyZipcode)){showErrorMessage('Zipcode is missing', __LINE__);}
    if( empty($sNewPropertyCity)){showErrorMessage('City is missing', __LINE__);}
    if( empty($sNewPropertyAddress)){showErrorMessage('Address is missing', __LINE__);}
    if( empty($sNewPropertyPrice)){showErrorMessage('Price is missing', __LINE__);}
    if( empty($sNewPropertyBeds)){showErrorMessage('Amount of bedrooms is missing', __LINE__);}
    if( empty($sNewPropertyBaths)){showErrorMessage('Amount of bathrooms is missing', __LINE__);}
    if( empty($sNewPropertyMeters)){showErrorMessage('Amount of square meters is missing', __LINE__);}
    // if( empty($sNewPropertyLatitude)){sendErrorMessage('Latitude is missing', __LINE__);exit;}
    // if( empty($sNewPropertyLongitude)){sendErrorMessage('Longitude is missing', __LINE__);exit;}

// ******* Validate title ******
// -----> Min length
if( strlen($sNewPropertyTitle) < 5 ){
    showErrorMessage('Title must be at least 5 characters', __LINE__);
}
// -----> Max length
if( strlen($sNewPropertyTitle) > 25 ){
    showErrorMessage('Title cannot be more than 25 characters', __LINE__);
}

// ******* Validate description ******
// ----> Min length
if( strlen($sNewPropertyDescription) < 15 ){
    showErrorMessage('Description must be at least 15 characters', __LINE__);
}

// ******* Validate zipcode ******
// ----> Is numeric
if( !ctype_digit($sNewPropertyZipcode) ){
    showErrorMessage('Zipcode must be digits', __LINE__);
}
// ----> Length is correct
if( strlen($sNewPropertyZipcode) != 4 ){
    showErrorMessage('Zipcode must be four digits', __LINE__);
}

// ******* Validate price ******
// ----> Is numeric
if( !ctype_digit($sNewPropertyPrice) ){
    showErrorMessage('Price must be digits', __LINE__);
}
// ----> Min length
if( strlen($sNewPropertyPrice) < 3 ){
    showErrorMessage('Price must be at least 3 digits', __LINE__);
}
// -----> Max length
if( strlen($sNewPropertyPrice) > 10 ){
    showErrorMessage('Price cannot be more than 10 digits', __LINE__);
}

// ******* Validate bedrooms ******
// ----> Is numeric
if( !ctype_digit($sNewPropertyBeds) ){
    showErrorMessage('Amount of bedrooms must be digits', __LINE__);
}
// -----> Max length
if( $sNewPropertyBeds > 20 ){
    showErrorMessage('Amount of bedrooms cannot be more than 20', __LINE__);
}

// ******* Validate bathrooms ******
// ----> Is numeric
if( !ctype_digit($sNewPropertyBaths) ){
    showErrorMessage('Amount of bathrooms must be digits', __LINE__);
}
// -----> Max length
if( $sNewPropertyBaths > 20 ){
    showErrorMessage('Amount of bathrooms cannot be more than 20', __LINE__);
}

// ******* Validate square meters ******
// ----> Is numeric
if( !ctype_digit($sNewPropertyMeters) ){
    showErrorMessage('Amount of square meters must be digits', __LINE__);
}
// ----> Min length
if( $sNewPropertyMeters < 10 ){
    showErrorMessage('Amount of square meter must be at least 10', __LINE__);
}
// -----> Max length
if( $sNewPropertyMeters > 800 ){
    showErrorMessage('Amount of square meter cannot be more than 800', __LINE__);
}

// ******* Validate Longitude ******
// // ----> Min length
// if( strlen($sNewPropertyLongitude) != 9 ){
// sendErrorMessage('Longitude must be 8 digits with a point, 12.345678', __LINE__);
// }

// if( !ctype_digit($sNewPropertyLongitude) ){
//     sendErrorMessage('Longitude must be digits', __LINE__);
// }

// ******* Validate Latitude ******
// // ----> Min length
// if( strlen($sNewPropertyLatitude) != 9 ){
// sendErrorMessage('Latitude must be 8 digits with a point, 12.345678', __LINE__);
// }

// if( !ctype_digit($sNewPropertyLatitude) ){
//     sendErrorMessage('Latitude must be digits', __LINE__);
// }

if( !empty($sNewPropertyImage) ){

    // ******* Validate image ******
// // ----> Allowed file extention
$sExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$sExtension = strtolower($sExtension);
$aAllowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

if( !in_array( $sExtension, $aAllowedExtensions ) ){
    showErrorMessage('Only png, jpg, jpeg and gifs allowed', __LINE__);
}
// ----> Allowed min size
if( $_FILES['image']['size'] < 2480 ){
    showErrorMessage('The image size is too small', __LINE__);
}
// ----> Allowed max size
if( $_FILES['image']['size'] > 5242880 ){
    showErrorMessage('The image size is too big', __LINE__);
}

$sNewPropertyId = uniqid();

move_uploaded_file( $_FILES['image']['tmp_name'], __DIR__.'/images/'.$sNewPropertyId.$_FILES['image']['name']);

}

session_start();
$sAgentId = $_SESSION['id'];
$propertyId = $_GET['id'];

$sjData = file_get_contents(__DIR__.'/data.json');
$jData = json_decode($sjData);

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
    $jProperty->liked = $jData->agents->$sAgentId->properties->$propertyId->liked;

    if( !empty($sNewPropertyImage) ){
        $jProperty->image = $sNewPropertyId.$_FILES['image']['name'];
    } else {
        $jProperty->image = $jData->agents->$sAgentId->properties->$propertyId->image;
    }

    $jProperty->uploaded = $jData->agents->$sAgentId->properties->$propertyId->uploaded;

    $jData->agents->$sAgentId->properties->$propertyId = $jProperty;

$sjData = json_encode( $jData, JSON_PRETTY_PRINT );
file_put_contents(__DIR__.'/data.json', $sjData);



header("HTTP/1.1 200 PROPERTY SUCCESFULLY UPDATED $propertyId");


    }



    // **************************************************

    function showErrorMessage($sErrorMessage, $sErrorMessageLineNumber){
        header("HTTP/1.1 512 PROPERTY NOT UPDATED: Error: $sErrorMessage, Line: .$sErrorMessageLineNumber.");
        exit;
    }