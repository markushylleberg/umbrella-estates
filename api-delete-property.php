<?php

    $sThisPropertyId = $_GET['id'];

    session_start();

    $sThisAgentId = $_SESSION['id'];

    // echo $sThisPropertyId;
    // echo $sThisAgentId;

    $sjData = file_get_contents('data.json');
    $jData = json_decode($sjData);

        unset($jData->agents->$sThisAgentId->properties->$sThisPropertyId);

    $sjData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $sjData);



    $sjCoordinates = file_get_contents(__DIR__.'/data-properties-coordinates.json');
    $jCoordinates = json_decode($sjCoordinates);

    // echo json_encode($jCoordinates);

        foreach($jCoordinates as $sKey => $jPropertyCoordinates){

                if( $jPropertyCoordinates->id == $sThisPropertyId ){

                // unset($jCoordinates[$sKey]);
                    array_splice($jCoordinates, $sKey, 1);

                }
        }


    $sjCoordinates = json_encode($jCoordinates, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__.'/data-properties-coordinates.json', $sjCoordinates);


     header('Location: agent-properties.php');