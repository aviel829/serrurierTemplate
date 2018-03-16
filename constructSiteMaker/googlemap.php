<?php
$latitude = "0";
$longitude = "0";
$ville = "Paris";
$type = "Serrurier";
$tel = "01.85.470.480";

if (array_key_exists('GEOIP_LATITUDE', $_SERVER) && array_key_exists('GEOIP_LONGITUDE', $_SERVER)){
      $latitude = $_SERVER['GEOIP_LATITUDE'];
      $longitude = $_SERVER['GEOIP_LONGITUDE'];
      $ville = $_SERVER['GEOIP_CITY'].' - '.$_SERVER['GEOIP_COUNTRY_NAME'];
} 

if (file_exists ('fnc.php'))
  include 'fnc.php';
if (file_exists ('vars.php'))
  include 'vars.php';
if (array_key_exists('latitude', $GLOBALS))
  $latitude = $GLOBALS['latitude'];
if (array_key_exists('longitude', $GLOBALS))
  $longitude = $GLOBALS['longitude'];
if (array_key_exists('Ville', $GLOBALS))
  $ville = $GLOBALS['Ville'] . '-' . $GLOBALS['zip'];
if (array_key_exists('Type', $GLOBALS))
  $type = $GLOBALS['Type'];
if (array_key_exists('tel', $GLOBALS))
  $tel = $GLOBALS['tel'];

$toolTip =  $ville . " " . $type;
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $toolTip; ?></title>
    <meta name="robots" content="noindex,nofollow"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {height: 100%; margin: 0px; padding: 0px}
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
        var 
            map,
            marker,
            layer,
            latitude = "<?php echo $latitude; ?>",
            longitude = "<?php echo $longitude; ?>",
            myLatlng =  new google.maps.LatLng(latitude, longitude),
            newarkcoords = [{ Longitude: longitude, Latitude: latitude }]
        ;
        
        function initialize() {
          var mapOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          map = new google.maps.Map(document.getElementById('map-canvas'),
              mapOptions);

          marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: "<?php echo $toolTip; ?>"
          });
        var 
            NewarkHighlight,
            mNewarkCoords = []
        ;

        for (var i = 0; i < newarkcoords.length; i++) {
            mNewarkCoords[i] = new google.maps.LatLng(newarkcoords[i].Latitude, newarkcoords[i].Longitude);
        }
    
        NewarkHighlight = new google.maps.Polygon({
            paths: mNewarkCoords,
            strokeColor: "#6666FF",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#6666FF",
            fillOpacity: 0.35
        });
        NewarkHighlight.setMap(map);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>
