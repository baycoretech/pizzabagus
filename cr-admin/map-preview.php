<?php
    $class_map         = new Map($pdo);
    $function_view_map = $class_map->view_map();
    $function_view_map_marker = $class_map->view_map_marker();

    $function_apimap   = $class_settings->view_settings_apimap();
?>
<div class="map-content">
    <div class="btn-group map-btn pull-right">
      <button type="button" class="btn btn-sm btn-inverse" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => 'map')) ?>'" id="map-theme-text">
        <?php
          if($function_apimap->cr_settingValue == '' || empty($function_apimap->cr_settingValue)) {
        ?>
          <i class="fa fa-exclamation-triangle"></i> Google Map API is empty!
        <?php
          }
          else {
        ?>
        Close Preview
        <?php
          }
        ?>
      </button>
    </div>
</div>
<div class="map">
    <div id="google-map" class="height-full width-full"></div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $function_apimap->cr_settingValue ?>"></script>
<script type="text/javascript">
    function initialize() {
      latLng = new google.maps.LatLng(<?php echo $function_view_map->cr_mapLatLong ?>)
      var mapOptions = {
        center: latLng,
        zoom: 12,
        disableDefaultUI:true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map(document.getElementById("google-map"), mapOptions);

      <?php 
        if($function_view_map->cr_mapDesc == NULL || empty($function_view_map->cr_mapDesc)) {
            echo '';
        }
        else { 
      ?>
      var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<div id="bodyContent">'+
      '<p>' +
      '<?php echo str_replace(array("\r","\n"),"",$function_view_map->cr_mapDesc) ?>'+
      '</p>'+
      '</div>'+
      '</div>';

      var infowindow = new google.maps.InfoWindow({
          content: contentString
      });

      <?php
        }
      ?>    

      var image = '<?php echo MURL.$function_view_map->cr_mapmarkerImage ?>';
      var marker = new google.maps.Marker({
          position: latLng,
          title:"My Location",
          visible: true,
          icon: image
      });
      marker.setMap(map);

      <?php 
        if($function_view_map->cr_mapDesc == NULL || empty($function_view_map->cr_mapDesc)) {
            echo "";
        }
        else {
      ?>
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });
      <?php
        }
      ?> 
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>