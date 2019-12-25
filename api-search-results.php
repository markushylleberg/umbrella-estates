<?php

$zipcode = $_GET['zip'];

// echo $zipcode;

// echo '{"status":1,"message":"results has been found"}';

$sjData = file_get_contents('data.json');
$jData = json_decode($sjData);

$matches = [];

foreach($jData->agents as $sAgent => $sValue){
    foreach($sValue->properties as $sPropertyKey => $sPropertyValue){
    // echo $sPropertyValue->zip;

    if ( $sPropertyValue->zip === $zipcode ){
        // echo $sPropertyKey;
        $match = 'property-'.$sPropertyKey;

        array_push($matches, $match);
    }

    }
}

echo json_encode($matches);

// if ( $_POST ){

//     echo 'x';


//     // $sjData = file_get_contents('data.json');
//     // $jData = json_decode($sjData);
//     //     foreach($jData->agents as $sAgent => $sValue){
//     //         foreach($sValue->properties as $sPropertyKey => $sPropertyValue){
//     //             // echo $sSelectedZip;
//     //             echo $sPropertyKey;
//     //             // echo $sSelectedZip;
//     //             // echo $sPropertyKey->zipcode;
//     //         }
//     //     }








// }

// $sSelectedZip = $_GET['zip'];

// echo $sSelectedZip;

//             echo '<div class="property" id="property-'.$sPropertyKey.'">
//                         <div class="property-agent">
//                             <h6>'.$sValue->firstname.'</h6>
//                             <img class="property-agent-image" src="images/'.$sValue->profilepicture.'">
//                         </div>
//                     <img class="property-image" src="images/'.$sPropertyValue->image.'">

//                     <div class="property-headline">
//                     <h3>'.$sPropertyValue->title.'</h3>
//                     </div>

//                         <div class="property-subtitles">
//                             <p>Beds</p>
//                             <p>Baths</p>
//                             <p>Price</p>
//                         </div>
//                         <div class="property-information">
//                             <p>'.$sPropertyValue->bedrooms.'</p>
//                             <p>'.$sPropertyValue->bathrooms.'</p>
//                             <p>'.$sPropertyValue->price.'</p>
//                         </div>
//                   </div>';

//             // echo $sPropertyValue->title.':TITLE <br><br>';
//             // echo $sPropertyValue->image.':IMAGE OF PROPERTY <br><br>';
//             // echo $sValue->firstname.':FIRSTNAME OF AGENT <br><br>';
//             // echo $sValue->profilepicture.':IMAGE OF AGENT <br><br>';
//             // echo $sPropertyKey.':PROPERTY KEY <br><br>';
//         }
//     }