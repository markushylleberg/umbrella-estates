<?php 
$sPageTitle = 'My properties';
$sActiveName = 'my-properties';

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

    <div class="top-element-of-page">

        <h1 class="pad">My properties: <b><?php echo count(get_object_vars($jData->agents->$sProfileId->properties))?></b> </h1>
        <p class="pad">All my uploaded properties</p>
        <div class="agent-properties-list mar">
        
            <?php 
                foreach($jData->agents->$sProfileId->properties as $jProperty => $sPropertyId){
                    
                    echo '<div class="property-list" id="'.$jProperty.'">
                            <img src="images/'.$sPropertyId->image.'">
                            <h3>'.$sPropertyId->title.'</h3>
                                <div>
                                    <p>'.$sPropertyId->address.'</p>
                                    <p>'.$sPropertyId->zip.'</p>
                                    <p>'.$sPropertyId->city.'</p>
                                </div>
                            <p class="center">Liked: <b>'.$sPropertyId->liked.'</b></p>
                            <a href="edit-property.php?id='.$jProperty.'"><button class="light-btn">Edit</button></a>
                            <a href="api-delete-property.php?id='.$jProperty.'"><button class="light-btn red">Delete</button></a>
                        </div>';


                }
            ?>
        
        
        </div>
    
    
    </div>

<?php include_once(__DIR__.'/components/footer.php'); ?>