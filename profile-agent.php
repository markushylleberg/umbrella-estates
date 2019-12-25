<?php 
$sPageTitle = 'My profile';
$sActiveName = 'profile';
require_once(__DIR__.'/components/header.php');
require_once(__DIR__.'/api-get-profile-data.php');

if(!preg_match('/agent/', $_SESSION['id']) ){
    header('Location:index.php');
}

?>

<div class="profileContainer top-element-of-page">

<h1>Welcome <?php echo $jData->agents->$sProfileId->firstname ?></h1>
<div class="upperProfileContainer">

<div>
    <img src="<?php echo 'images/'.$jData->agents->$sProfileId->profilepicture ?>">
</div>




    <div class="profileImageContainer">
        <p><b>Name: </b><?php echo $jData->agents->$sProfileId->firstname.' '.$jData->agents->$sProfileId->lastname ?></p>
        <p><b>Email: </b><?php echo $jData->agents->$sProfileId->email ?></p>
        <p><b>Address: </b><?php echo $jData->agents->$sProfileId->address ?></p>
        <p><b>City: </b><?php echo $jData->agents->$sProfileId->city ?></p>
        <p><b>Country: </b><?php echo $jData->agents->$sProfileId->country ?></p>
</div>
        <div>
        <a href="edit-profile.php"><button class="light-btn">Edit profile</button></a>
        </div>
    </div>
</div>

        <h1 class="agent-properties-headline">My properties (<?php echo count(get_object_vars($jData->agents->$sProfileId->properties))?>)</h1>
    <div class="agent-properties-container">
        <a href="agent-properties.php"><button class="light-btn">View your properties</button></a>
        <p>Your oldest uploaded properties</p>

        <div id="agentLatestPropertyContainer">
        <?php 
            $i = 0;
            foreach($jData->agents->$sProfileId->properties as $sProperty => $sValue){
                echo '<div class="agent-latest-property">
                      <img src="images/'.$sValue->image.'">
                        <div class="agent-latest-info">
                            <h4>'.$sValue->title.'</h4>
                            <p>'.$sValue->description.'</p>
                            <p>'.$sValue->uploaded.'</p>
                        </div>
                    </div>';
                if (++$i == 3){
                    break;
                }
            }

        ?>
    </div>

    </div>

        <!-- <div class="agent-latest-property">
            <img src="images/5d7cce93aaa3flaughing.png">
                <div class="agent-latest-info">
                    <h4>TITLE</h4>
                    <p>DescriptioDescriptionDescriptionDescriptionDescriptionn</p>
                    <p>Uploaded Upload date</p>
                </div>
        </div> -->

</div>


<?php include_once(__DIR__.'/components/footer.php'); 


?>