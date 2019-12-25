<?php 
$sPageTitle = 'View all';
$sActiveName = 'view-all';

require_once(__DIR__.'/components/header.php');
?>

<div class="search-container top-element-of-page">

    <div>
            <div id="modal">
            <div class="upper-modal">
                <button id="modalCloseBtn"><img src="images/icons/letter-x.png"></button>
            </div>

            <div class="middle-modal">
                <div>
                    <h1></h1>
                    <p id="modalAddress"></p>
                    <p id="modalCity"></p>
                    <p class="modal-description" id="modalDescription"></p>
                        <div class="modal-icons">
                            <div>
                                <img class="modal-icon" src="images/icons/bed.png">
                                <p id="modalBeds"></p>
                            </div>
                            <div>
                                <img class="modal-icon" src="images/icons/bathtub.png">
                                <p id="modalBaths"></p>
                            </div>
                            <div>
                                <img class="modal-icon" src="images/icons/measurement.png">
                                <p id="modalMeters"></p>
                            </div>
                        </div>

                        <div class="current-likes-modal">
                            <div>
                                <img class="modal-heart" src="images/icons/like.png">
                            </div>  
                            <p class="modal-liked" id="modalLiked"></p>
                        </div>

                </div>
                <div>
                    <img id="modalImage" src="">
                </div>
            </div>

            </div>


            <form id="frmSearch">
                <input id="txtSearch" name="search" type="text" placeholder="Search by zipcode...">
                <button type="button" onclick="searchResultByButton()"><img src="images/icons/search.png"></button>
            </form>

            <div id="results"></div>

    </div>


    <div class="current-search-container">
        <div id="currentSearch"></div>
    </div>

</div>

<div id="map_properties">

    <div id="map"></div>

    <div id="properties">



    <?php
        $sjData = file_get_contents('data.json');
        $jData = json_decode($sjData);


        if ( $_SESSION ){
            $sProfileId = $_SESSION['id'];
        }



        // foreach($jData->users->$sProfileId->liked as $alreadyLiked => $sLikeValue ){

        //     if ( $sPropertyKey == $alreadyLiked ){
        //         echo '<a href="api-like-property.php?id='.$sPropertyKey.'&agent='.$sAgent.'">DISLIKE</a>';
        //     }

        // }



            foreach($jData->agents as $sAgent => $sValue){
                foreach($sValue->properties as $sPropertyKey => $sPropertyValue){         
            
                    
                    echo '<div class="property" onclick="openModal()" id="property-'.$sPropertyKey.'">
                    <div class="property-agent" id="'.$sValue->id.'">  
                    <h6>'.$sValue->firstname.'</h6>
                    <img class="property-agent-image" src="images/'.$sValue->profilepicture.'">
                </div>';

                    if ( $_SESSION ){
                        if(!preg_match('/agent/', $_SESSION['id']) ){

                            foreach( $jData->users->$sProfileId->liked as $sAlreadyLiked => $sLikeValue){

                                if ( $sAlreadyLiked == $sPropertyKey ){
                                    echo '<div class="liked-property"><a href="api-dislike-property.php?id='.$sPropertyKey.'&agent='.$sAgent.'"><img class="like-img" src="images/icons/like.png"></a></div>';

                                }
                            }


                    echo '<div class="not-liked-property"><a href="api-like-property.php?id='.$sPropertyKey.'&agent='.$sAgent.'"><img class="dislike-img" src="images/icons/dislike.png"></a></div>'; 
                    // echo '<div class="not-liked-property"><a href="api-like-property.php?id='.$sPropertyKey.'&agent='.$sAgent.'">Like</a></div>'; 
                }
            }

                    echo ' 

                            <img class="property-image" src="images/'.$sPropertyValue->image.'">
                            <div class="property-headline">
                            <div class="propety-like-container">
                            <img src="images/icons/like.png">
                            <p>'.$sPropertyValue->liked.'</p>
                            </div>
                            <h3>'.$sPropertyValue->title.'</h3>
                            </div>

                                <div class="property-subtitles">
                                    <p>Beds</p>
                                    <p>Baths</p>
                                    <p>Price</p>
                                </div>
                                <div class="property-information">
                                    <p>'.$sPropertyValue->bedrooms.'</p>
                                    <p>'.$sPropertyValue->bathrooms.'</p>
                                    <p>'.$sPropertyValue->price.' kr.</p>
                                </div>
                          </div>
                          ';

                    // echo $sPropertyValue->title.':TITLE <br><br>';
                    // echo $sPropertyValue->image.':IMAGE OF PROPERTY <br><br>';
                    // echo $sValue->firstname.':FIRSTNAME OF AGENT <br><br>';
                    // echo $sValue->profilepicture.':IMAGE OF AGENT <br><br>';
                    // echo $sPropertyKey.':PROPERTY KEY <br><br>';
        }
    }

    // foreach($jData->users->$sProfileId->liked as $alreadyLiked => $sLikeValue ){
    //     $sAlreadyLikedProperty = $alreadyLiked;

    //     if( $sPropertyKey === $alreadyLiked ){
    //         echo $sPropertyKey;
    //     }
    // }

    ?>
    
    
    </div>
</div>



<script>

    // let allProperties = document.querySelectorAll('.property');

// if ( $_SESSION ){
//     if(!preg_match('/agent/', $_SESSION['id']) ){
        

//        echo 'for(let i = 0; i < allProperties.length; i++){
    
//             if( allProperties[i].children[1]. == "Dislike" ){
//                 allProperties[i].children[2].style.display = "none";
//             }
//         }';

//     }
// }




      <?php $sjPropertiesCoordinates = file_get_contents('data-properties-coordinates.json');
      $jPropertiesCoordinates = json_decode($sjPropertiesCoordinates); ?>
      const sjPropertiesCoordinates = '<?php echo json_encode($jPropertiesCoordinates); ?>'
      ajPropertiesCoordinates = JSON.parse(sjPropertiesCoordinates) // convert text into an object
    //   console.log(ajPropertiesCoordinates)

      mapboxgl.accessToken = 'pk.eyJ1IjoiaHlsbGViZXJnIiwiYSI6ImNrMGM1ZWp5eDB5Z2wzZ3Bpc2dzcDE5dGIifQ.ht50xSoC4abBhOA2GNMs5Q';
      var map = new mapboxgl.Map({
      container: 'map',
      center: [12.555050, 55.674001], // starting position
      zoom: 11, // starting zoom
      style: 'mapbox://styles/hylleberg/ck0mfc6mp01me1cmlggrzreub'
      
      });
      map.addControl(new mapboxgl.NavigationControl());

    // JSON works with for in loops
    // Arrays work with forEach and also with for of
    for( let jPropertyCoordinates of ajPropertiesCoordinates ){ // json object with json objects in it
    // for(let i = 0; i < ajPropertiesCoordinates.length; i++){
        // console.log(jPropertyCoordinates)
        // console.log(ajPropertiesCoordinates[0]);
      var el = document.createElement('a');
      el.href = '#property-'+jPropertyCoordinates.id
      el.className = 'marker'
      el.style.backgroundImage = 'url(marker.png)';
      el.style.width = "40px"
      el.style.height = "40px"
      el.id = jPropertyCoordinates.id
      el.addEventListener('click', function() {
        // console.log(`Highlight property with ID ${this.id} `);
        removeActiveClassFromProperty()
        document.getElementById(this.id).classList.add('highlighted') // left
        document.getElementById('property-'+this.id).classList.add('highlighted') // right
      });
    // add marker to map
    new mapboxgl.Marker(el).setLngLat(jPropertyCoordinates.geometry.coordinates).addTo(map);      
  } // end loop

    document.querySelector('canvas').addEventListener('click', function(){
        removeActiveClassFromProperty()
    })


    // $('.active').removeClass('.active')
    function removeActiveClassFromProperty(){
      let properties = document.querySelectorAll('.highlighted')
      properties.forEach( function( oPropertyDiv ) {
        oPropertyDiv.classList.remove('highlighted')
      } )
    }  



</script>



<?php include_once(__DIR__.'/components/footer.php'); ?>