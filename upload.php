<?php 
$sPageTitle = 'Upload';
$sActiveName = 'upload';

require_once(__DIR__.'/components/header.php');

if(!preg_match('/agent/', $_SESSION['id']) ){
    header('Location:index.php');
}

?>




<div class="upload-container top-element-of-page">

<div class="newlyUploadedProperties">



</div>
    <div class="mar pad">
    <form method="POST" id="newPropertyForm" enctype="multipart/form-data" onsubmit="return false;">
    <h2>Upload new property</h2>

    <label class="has-float-label">
    <input type="text" id="newPropertyTitle" name="title" placeholder="Title">
    <span>Title</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyDescription" name="description" placeholder="Description">
    <span>Description</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyZip" name="zipcode" placeholder="ZIP Code">
    <span>Zip</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyCity" name="city" placeholder="City">
    <span>City</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyAddress" name="address" placeholder="Address">
    <span>Address</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyPrice" name="price" placeholder="Price">
    <span>Price</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyBeds" name="beds" placeholder="Amount of bedrooms">
    <span>Bedrooms</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyBaths" name="baths" placeholder="Amount of bathrooms">
    <span>Bathrooms</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyMeters" name="meters" placeholder="Amount of square meters">
    <span>Square meters</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyLatitude" name="latitude" placeholder="Coordinates: latitude">
    <span>Latitude</span>
    </label>

    <label class="has-float-label">
    <input type="text" id="newPropertyLongitude" name="longitude" placeholder="Coordinates: longitude">
    <span>Longitude</span>
    </label>

    <label class="has-float-label">
    <input type="file" id="newPropertyImage" name="image">

    <button id="btnUploadProperty" class="left light-btn">UPLOAD</button>

    </form>
    </div>
</div>


<?php

// if($_POST){

//     require_once('api-upload-property.php');

// $sAgentId = $_SESSION['id'];
// $sImageUniqueId = uniqid();

// $sNewPropertyTitle = $_POST['title'];
// $sNewPropertyDescription = $_POST['description'];
// $sNewPropertyZip = $_POST['zipcode'];
// $sNewPropertyCity = $_POST['city'];
// $sNewPropertyAddress = $_POST['address'];
// $sNewPropertyPrice = $_POST['price'];
// $sNewPropertyBeds = $_POST['beds'];
// $sNewPropertyBaths = $_POST['baths'];
// $sNewPropertyMeters = $_POST['meters'];
// $sNewPropertyImage = $_FILES['image'];


// $sImageUniqueId = uniqid();

// // DONE) move the image to the /images/ folder
// move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/images/images-properties/'.$sImageUniqueId.'.'.pathinfo($sNewPropertyImage['name'], PATHINFO_EXTENSION));

// // echo $sNewPropertyImage;

// // move_uploaded_file($_FILES['image']['tmp_name'], '/images/'.$sNewPropertyImage);

// $sjData = file_get_contents(__DIR__.'/data.json');
// $jData = json_decode($sjData);

// $jProperty = new stdClass();
// $jProperty->title = $sNewPropertyTitle;
// $jProperty->description = $sNewPropertyDescription;
// $jProperty->zip = $sNewPropertyZip;
// $jProperty->city = $sNewPropertyCity;
// $jProperty->address = $sNewPropertyAddress;
// $jProperty->price = intVal($sNewPropertyPrice);
// $jProperty->bedrooms = intVal($sNewPropertyBeds);
// $jProperty->bathrooms = intVal($sNewPropertyBaths);
// $jProperty->meters = intVal($sNewPropertyMeters);
// $jProperty->viewed = 0;
// $jProperty->liked = 0;
// $jProperty->image = $sImageUniqueId.'.'.pathinfo($sNewPropertyImage['name'], PATHINFO_EXTENSION);

// $sPropertyUniqueID = uniqid();

// $jData->agents->$sAgentId->properties->$sPropertyUniqueID = $jProperty;

// $sjData = json_encode( $jData, JSON_PRETTY_PRINT );
// file_put_contents(__DIR__.'/data.json', $sjData);

// // header('Location: index.php');
//  }

// ?>






<?php include_once(__DIR__.'/components/footer.php'); ?>