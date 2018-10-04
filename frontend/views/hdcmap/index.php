<?php
$this->title = 'ตรวจสอบพิกัดของสถานพยาบาล';
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

/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
           ร้อยละการปรับปรุงพิกัดสถานพยาบาล  แยกรายอำเภอ</h3>
    </div>
 <div class="panel-body">
<?php echo Highcharts::widget([
    'options'=>[        
        'title'=>['text'=>'ร้อยละสถานบริการ'],
        'xAxis'=>[
            'categories'=>new SeriesDataHelper($dataProvider, ['ampurname']),
        ],
        'yAxis'=>[
            'title'=>['text'=>'จำนวนข้อมูล'],
			'max'=>100,
        ],
        'series'=>[
            [
                'type'=>'column',
                'name'=>'%',
                'data'=>new SeriesDataHelper($dataProvider, ['percent:int']),
                'dataLabels'=>[
                    'enabled'=>true,
                ]
            ],
           
            
        ]
    ]
]);?>
 </div>
</div>

<div class="panel panel-success">
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
               		 'attribute' => 'areacode',
               		 'format' => 'raw',
               		 'label' => 'รหัสอำเภอ',
		              'value' => function($data)  {
                   	 return Html::a($data['areacode'], ['hdcmap/maps'
                               , 'areacode' => $data['areacode']                           
                        ]);
                     }
                      ],
                   [
				'attribute' => 'ampurname',
                      'label' => 'อำเภอ'],
                    [
                      'attribute' => 'a' ,
                        'label' => 'จำนวนสถานบริการ',
                     'format'=>['decimal', 0],
	                 'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                    [
                      'attribute' => 'b' ,
                        'label' => 'จำนวนสถานบริการที่ปรับปรุงพิกัด',
                     'format'=>['decimal', 0],
	                 'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
					  [
                      'attribute' => 'percent' ,
                        'label' => 'ร้อยละ',
                     'format'=>['decimal', 2],
	                  'headerOptions' => ['class' => 'text-center'],
                      'contentOptions' => ['class' => 'text-right'],
                      ],
                ],
            
    ]); ?>

  </div>
</div>
<div class="alert alert-danger">
  ตรวจสอบการปรับปรุงพิกัดบน HDC Cloud
</div>


