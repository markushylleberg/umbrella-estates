<?php

    if( !isset($_GET['search']) ){
        echo '[]';
        exit;
    }

    $sSearchFor = $_GET['search'];
    $zipCodes = ['1499 København K', '1799 København V', '2000 Frederiksberg', '2100 København Ø', '2200 København N', '2300 København S', '2400 København NV', '2450 København SV', '2500 Valby', '2650 Hvidovre', '2700 Brønshøj', '2770 Kastrup', '2791 Dragør'];

    $matches = [];

    foreach( $zipCodes as $zipCode ){

        if( strpos( $zipCode, $sSearchFor ) !== false ){
            
            array_push($matches, $zipCode);
        }

    }

    echo json_encode($matches);




    // if ( in_array( $sSearchFor, $aZipCodes ) ){
    //     echo 'match!';
    // } else {
    //     echo 'no match';
    // }


    // echo "The user is searching for {$sSearchFor}";

?>