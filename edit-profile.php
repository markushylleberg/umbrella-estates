<?php 
$sPageTitle = 'My profile';
$sActiveName = 'profile';
require_once(__DIR__.'/components/header.php');
require_once(__DIR__.'/api-get-profile-data.php');

if ( !$_SESSION ){
    header('Location: sign-up-user.php');
    exit;
}

// if(!preg_match('/agent/', $_SESSION['id']) ){
//     header('Location:index.php');
// }

?>


<div class="edit-profile-container top-element-of-page">

    <!-- <a href="profile-agent.php">Go back</a> -->

    <?php
        if(!preg_match('/agent/', $_SESSION['id']) ){
            echo '
            
            <form id="profileEditForm" method="POST" enctype="multipart/form-data">
            <a href="profile-user.php"><img src="images/icons/back-arrow.png"></a>
            <h3>Edit profile</h3>
            
            <label class="has-float-label">
            <input type="text" placeholder="Your first name" name="firstname" value="'.$jData->users->$sProfileId->firstname.'">
            <span>First name</span>
            </label>
    
            <label class="has-float-label">
            <input type="text" placeholder="Your last name" name="lastname" value="'.$jData->users->$sProfileId->lastname.'">
            <span>Last name</span>
            </label>
    
            <p>Profile picture</p>
            <input type="file" name="image">
    
            <button id="saveProfileButton" class="light-btn left">SAVE</button>
    
        </form>';
        } 
        if(preg_match('/agent/', $_SESSION['id']) ){
            echo '
            
            <form id="profileEditForm" method="POST" class="mar" enctype="multipart/form-data">
            <a href="profile-agent.php"><img src="images/icons/back-arrow.png"></a>
            <h3>Edit profile</h3>

            <label class="has-float-label">
            <input type="text" placeholder="First name" name="firstname" value="'.$jData->agents->$sProfileId->firstname.'">
            <span>First name</span>
            </label>
    
            <label class="has-float-label">
            <input type="text" placeholder="Last name" name="lastname" value="'.$jData->agents->$sProfileId->lastname.'">
            <span>Last name</span>
            </label>

            <label class="has-float-label">
            <input type="text" placeholder="Address" name="address" value="'.$jData->agents->$sProfileId->address.'">
            <span>Address</span>
            </label>

            <label class="has-float-label">
            <input type="text" placeholder="City" name="city" value="'.$jData->agents->$sProfileId->city.'">
            <span>City</span>
            </label>

            <label class="has-float-label">
            <input type="text" placeholder="Country" name="country" value="'.$jData->agents->$sProfileId->country.'">
            <span>Country</span>
            </label>
    
            <p>Profile picture</p>
            <input type="file" name="image">
    
            <button id="saveProfileButton" class="light-btn left">SAVE</button>
            <a href="api-delete-profile.php"><button class="light-btn red">Delete profile</button></a>
    
        </form>';
        }
        // echo $_SESSION['id'];
    ?>




</div>













<?php include_once(__DIR__.'/components/footer.php'); ?>