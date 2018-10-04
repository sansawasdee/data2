<?php
/* @var $this yii\web\View */
$this->title = 'รายละเอียดสถานบริการ' ;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบพิกัดของสถานพยาบาล', 'url' => ['hdcmap/index']];
$this->params['breadcrumbs'][] = $this->title;

$coord = new LatLng(['lat'=>19.904460,'lng'=>99.833120]);
$map = new Map([
    'center'=>$coord,
    'zoom'=>9,
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
                    <td>Lat</td>
                    <td>'.$c->lat.'</td>
                </tr>
                <tr>
                    <td>Lon</td>
                    <td>'.$c->lng.'</td>
                </tr>
                <tr>
                    <td>วันที่ปรับปรุ่ง</td>
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
        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> การแสดงแผนที่ สถานบริการ</h3>
    </div>
    <div class="panel-body">
        <?php
        echo $map->display();
        ?>
    </div>
</div>

?>
<div class="panel panel-info">
<div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนสถานบริการแยกรายอำเภอ</h3>
    </div>
<div class="panel-body">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
   
        'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                     [
              
                'attribute' => 'hoscode',
                'label' => 'รหัส',
	
                    ],
                    [
	                  'attribute' => 'hosname',
                      'label' => 'หน่วยบริการ'],
                    [
                      'attribute' => 'ampurname' ,
                        'label' => 'อำเภอ',
                    ],
					[
                      'attribute' => 'd_update' ,
                        'label' => 'วันที่ปรับปรงพิกัด',
                    ],
					[
                      'attribute' => 'resul' ,
                        'label' => 'ผลดำเนินการ',
                    ],
					 
                    
            
        ],
    ]); 
?>
</div>
</div>
<div class="alert alert-danger">
  ตรวจสอบการปรับปรุงพิกัดบน HDC Cloud
</div>