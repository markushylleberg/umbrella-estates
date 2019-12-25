<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="app.css">

  <script src='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css' rel='stylesheet' />
  

  <title>Document</title>
</head>
<body>

  <nav>
    ZILLOW
  </nav>

  <div id="map_properties">

    <div id='map'></div>

    <div id="properties">

      <?php
      $sjProperties = file_get_contents('properties.json');
      $jProperties = json_decode($sjProperties);
      foreach($jProperties as $jProperty){
        echo "
          <div id='Right{$jProperty->id}' class='property' >
            <img src='{$jProperty->image}'>
          </div>
        ";
      }

      ?>





    </div>

  </div>




<script>

        mapboxgl.accessToken = 'pk.eyJ1IjoiaHlsbGViZXJnIiwiYSI6ImNrMGM1ZWp5eDB5Z2wzZ3Bpc2dzcDE5dGIifQ.ht50xSoC4abBhOA2GNMs5Q';
        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9'
        });

</script>

    



  <script src="app.js"></script>

</body>
</html>