<?php 
$sPageTitle = 'Edit property';
$sActiveName = 'edit-property';

require_once(__DIR__.'/components/header.php');
require_once(__DIR__.'/api-get-profile-data.php');

if(!preg_match('/agent/', $_SESSION['id']) ){
    header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="top-element-of-page"></div>
    <div class="single-property-container" id="<?php echo $_GET['id'] ?>">
            
<form method="POST" id="updatePropertyId" enctype="multipart/form-data">
            <a href="agent-properties.php"><img src="images/icons/back-arrow.png"></a>
            <h3>You are editing property: <?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->title ?></h3>
            
<label class="has-float-label">
<input type="text" name="title" placeholder="Title of the property" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->title ?>">
<span>Title</span>
</label>

<label class="has-float-label">
<input type="text" name="description" placeholder="Description of the property" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->description ?>">
<span>Description</span>
</label>

<label class="has-float-label">
<input type="text" name="zipcode" placeholder="Zipcode" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->zip ?>">
<span>Zip</span>
</label>

<label class="has-float-label">
<input type="text" name="city" placeholder="City" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->city ?>">
<span>City</span>
</label>

<label class="has-float-label">
<input type="text" name="address" placeholder="Address" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->address ?>">
<span>Address</span>
</label>

<label class="has-float-label">
<input type="text" name="price" placeholder="Price" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->price ?>">
<span>Price</span>
</label>

<label class="has-float-label">
<input type="text" name="bedrooms" placeholder="Bedrooms" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->bedrooms ?>">
<span>Bedrooms</span>
</label>

<label class="has-float-label">
<input type="text" name="bathrooms" placeholder="Bathrooms" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->bathrooms ?>">
<span>Bathrooms</span>
</label>

<label class="has-float-label">
<input type="text" name="meters" placeholder="Meters" value="<?php echo $jData->agents->$sProfileId->properties->{$_GET['id']}->meters ?>">
<span>Square meters</span>
</label>

<h6>Image</h6>
<input type="file" id="newPropertyImage" name="image">

<button id="saveProperty" class="light-btn left">SAVE</button>

</form>


</div>


<?php 
include_once(__DIR__.'/components/footer.php');