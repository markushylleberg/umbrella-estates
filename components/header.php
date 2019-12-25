<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $sPageTitle; ?></title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/float-label-css/v1.0.2/dist/float-label.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato|Poppins|Roboto&display=swap" rel="stylesheet">
</head>
<body>


<?php 
include_once('api-get-profile-data.php');
if(isset($_SESSION['id']) ) {

    if(preg_match('/agent/', $_SESSION['id']) ){
        echo '  <nav class="agent-navigation">
                    <div>
                        <img class="logo" src="images/logo/umbrella-estates-red.png">
                    </div>

                    <div class="agent-right-nav">
                        <a href="./">View all</a>
                        <a href="profile-agent.php">My profile</a>
                        <a href="agent-properties.php">My properties</a>
                        <a href="api-sign-out.php">Sign out</a>
                        <a href="upload.php"><button class="nav-btn">Add property</button></a>
                        <a href="profile-agent.php">
                        <div class="agent-profile-nav">
                            <div>
                                <p>Hi '.$jData->agents->$sProfileId->firstname.'!</p>
                            </div>

                            <img src="images/'.$jData->agents->$sProfileId->profilepicture.'">
                        </div>
                        </a>
                    </div>

                </nav>';
        // echo 'agent has logged in';
    } else {
        echo '  <nav class="user-navigation">
                    <div>
                        <img class="logo" src="images/logo/umbrella-estates-red.png">
                    </div>

                    <div class="user-right-nav">
                        <a href="./">View all</a>
                        <a href="profile-user.php">My profile</a>
                        <a href="api-sign-out.php">Sign out</a>
                        <a href="profile-user.php">
                        <div class="user-profile-nav">
                        <div>
                            <p>'.$jData->users->$sProfileId->firstname.' '.$jData->users->$sProfileId->lastname.'</p>
                        </div>

                        <img src="images/'.$jData->users->$sProfileId->profilepicture.'">
                        </div>
                        </a>
                    </div>
                </nav>';
        // echo 'user has logged in';
    }
} else {
    echo '<nav class="user-navigation">
            <div>
                <img class="logo" src="images/logo/umbrella-estates-red.png">
            </div>

            <div class="guest-right-nav">
                <a href="./">View all</a>
                <a href="sign-in.php">Sign in</a>
                <a href="sign-up-user.php">Sign up</a>
            </div>
    </nav>';
}



    ?>



<!-- <nav>
    <h3>T-Project</h3>
            <a href="index.php">View all</a>
            <a href="sign-in.php">Sign in</a>
            <a href="sign-up-user.php">Sign up</a>
            <a href="upload.php">Upload</a>
            <a href="profile-agent.php">My profile</a>
            <a href="api-sign-out.php">Sign out</a>
</nav>
 -->

