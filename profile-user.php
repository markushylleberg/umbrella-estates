<?php 
$sPageTitle = 'My profile';
$sActiveName = 'profile';
require_once(__DIR__.'/components/header.php');
require_once(__DIR__.'/api-get-profile-data.php');

if( !$_SESSION ){
    header('Location:index.php');
}


if(preg_match('/agent/', $_SESSION['id']) ){
    header('Location:index.php');
}

?>

<div class="profileContainer top-element-of-page">

    <h1 class="user-welcome">Hi <?php echo $jData->users->$sProfileId->firstname ?>!</h1>
    <div class="upperProfileContainer-user">
        
        <img src="<?php echo 'images/'.$jData->users->$sProfileId->profilepicture ?>">
        
        <div class="profileImageContainer">
            
            <p><?php echo $jData->users->$sProfileId->firstname.' '.$jData->users->$sProfileId->lastname ?></p>
            <p><?php echo $jData->users->$sProfileId->email ?></p>
            <a href="edit-profile.php"><button class="light-btn center">Edit profile</button></a>
    </div>
    <div>
    </div>
</div>
</div>
<div class="favorites-headline">
    <div>
         <img class="icon-heart" src="images/icons/like.png">
    </div>
<h1 class="user-liked-headline">My favorite properties</h1>
</div>
<div id="user-liked-properties">


    <!-- <div class="user-favorite">
        <img src="images/5d7cce93aaa3flaughing.png">
        <div class="user-favorite-info">
            <h4>Title of favorite</h4>
            <p class="user-favorite-description">Description</p>
            <p>Address</p>
            <p>Zipcode</p>
            <p>City</p>
        </div>
    </div> -->

        <?php


        foreach($jData->agents as $sAgent => $sValue){
            // echo $sValue->firstname.'<br>';
            foreach($sValue->properties as $sProperty => $sPValue){
            // echo $sProperty.'<br>';
                foreach($jData->users->$sProfileId->liked as $likedProperty => $sNoValue){
                    // echo $likedProperty.'<br>';
                    if ($sProperty == $likedProperty){
                        // echo $sProperty.'<br>';
                        // echo $sPValue->title.'<br>';
                        // echo $sPValue->description.'<br>';
                        // echo '<br>';

                        echo '<div class="user-favorite">
                                <img src="images/'.$sPValue->image.'">
                                    <div class="user-favorite-info">
                                        <h4>'.$sPValue->title.'</h4>
                                        <p class="user-favorite-description">'.$sPValue->description.'</p>
                                        <p>'.$sPValue->address.'</p>
                                        <p>'.$sPValue->zip.'</p>
                                        <p>'.$sPValue->city.'</p>
                                    </div>
                            </div>';




                    }
                }
            }
        }

        
        ?>







</div>


<?php include_once(__DIR__.'/components/footer.php'); 


?>