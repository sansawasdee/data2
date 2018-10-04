<?php
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
$coord = new LatLng(['lat'=>19.943444,'lng'=>99.824487]);
$map = new Map([
    'center'=>$coord,
    'zoom'=>10,
    'width'=>'100%',
    'height'=>'600',
]);
foreach($contacts as $c){
  $coords = new LatLng(['lat'=>$c->lat,'lng'=>$c->lng]);  
  $marker = new Marker(['position'=>$coords]);
  $marker->attachInfoWindow(
    new InfoWindow([
        'content'=>'
     
            <h4>'.$c->hcode.' '.$c->hosname.'</h4>
              <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>lat</td>
                    <td>'.$c->lat.'</td>
                </tr>
               
                <tr>
                    <td>lng</td>
                    <td>'.$c->lng.'</td>
                </tr>
                <tr>
                    <td>วัน Update</td>
                    <td>'.$c->timestamp.'</td>
                </tr>
              </table>

        '
    ])
  );
  
  $map->addOverlay($marker);
}
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> การแสดงแผนที่ Google Map จากฐานข้อมูล</h3>
    </div>
    <div class="panel-body">
        <?php
        echo $map->display();
        ?>
    </div>
</div>