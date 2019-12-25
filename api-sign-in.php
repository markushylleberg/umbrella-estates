<?php 

if ( $_SESSION ){
    // header('Location: https://markushylleberg.com/umbrella-estates/');
}

$sjData = file_get_contents(__DIR__.'/data.json');
$jData = json_decode($sjData);



if( $_POST ){

$sEmail = $_POST['email'];
$sPassword = $_POST['password'];

// <<<<ERROR>>>>> How can we combine these two foreach's??? <<<<ERROR>>>>> 

    foreach($jData->users as $jUser){
        $sMemberActive = $jUser->activated;
        $sMemberEmail = $jUser->email;
        $sMemberPassword = $jUser->password;

        if( $sEmail == $sMemberEmail && $sPassword == $sMemberPassword){
            $_SESSION['id'] = $jUser->id;
            // echo 'succes login';
            // header('Location: https://markushylleberg.com/umbrella-estates/');
            exit;
        }
    
    }

    foreach($jData->agents as $jAgents){
        $sMemberActive = $jAgents->activated;
        $sAgentEmail = $jAgents->email;
        $sAgentPassword = $jAgents->password;

        if( $sEmail == $sAgentEmail && $sPassword == $sAgentPassword ){
            $_SESSION['id'] = $jAgents->id;
            // echo 'succes login';
            // header("Location: https://markushylleberg.com/umbrella-estates/");
            exit;
        }
    
    }

    echo 'Incorrect password or email entered. Please try again';

}