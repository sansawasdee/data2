<?php
$this->title = 'การปรับปรุงรายละเอียดหน่วยงาน';

use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

//$this->params['breadcrumbs'][] = ['label' => 'จำนวนข้อมูลแนกรายอำเภอ', 'url' => ['counttb/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
<div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
            การปรับปรุงรายละเอียดหน่วยงาน</h3>
    </div>
 <div class="panel-body">
<?php echo Highcharts::widget([
    'options'=>[        
        'title'=>['text'=>'ปีงบประมาณ 2561'],
        'xAxis'=>[
            'categories'=>new SeriesDataHelper($dataProvider, ['ampurname']),
        ],
        'yAxis'=>[
            'title'=>['text'=>'%'],
			'max'=>100,
        ],
		'plotOptions' => [
                    'series' => [
                        'zoneAxis' => 'y',
                        'zones' => [
                            [
                                'value' => 50,
                                'color' => '#ee1111'
                            ],
                            [
                                'value' => 99.99,
                                'color' => '#ffc40d'
                            ],
                            [
                                'color' => '#1e7145'
                            ],
                        ],
                        'stacking' => 'normal'
                    ]
        ],
        'series'=>[
            [
                'type'=>'column',
                'name'=>'ร้อยละการปรับปรุงรายละเอียดหน่วยงาน',
                'data'=>new SeriesDataHelper($dataProvider, ['p:int']),
                'dataLabels'=>[
                    'enabled'=>true,
                ]
            ],
           
            
        ]
    ]
]);?>
 </div>
</div>

<?= GridView::widget([
        'dataProvider' => $dataProvider,    
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
		'summary' => '',
		//'showPageSummary' => true,
         'resizableColumns' => true,
        'responsive' => true,
		'responsiveWrap'=>FALSE,
		'pjax' => true,
		'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i>  แยกรายอำเภอ </h3>',
       // 'type' => 'success',
        'type' => GridView::TYPE_PRIMARY
    ],
        'columns' => [
                     ['class' => 'kartik\grid\SerialColumn'],
                     [                               
               		 'attribute' => 'areacode',
               		 'format' => 'raw',
               		 'label' => 'รหัสอำเภอ',
		            'value' => function($data)  {
                   	 return Html::a($data['areacode'], ['profile/profile'
                              , 'areacode' => $data['areacode']                           
                        ]);
                     }
                     ], 
                    [
				      'attribute' => 'ampurname',
                      'label' => 'อำเภอ',
					  
					],
                    [
                     'attribute' => 'a' ,
                     'label' => 'จำนวนสถานบริการ',
                     'format'=>['decimal', 0],
	                 'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                    [
                     'attribute' => 'b' ,
                     'label' => 'จำนวนสถานบริการที่ปรับรายละเอียด',
                     'format'=>['decimal', 0],
	                 'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
					  [
                      'attribute' => 'p' ,
                        'label' => 'ร้อยละ',
                     'format'=>['decimal', 2],
	                  'headerOptions' => ['class' => 'text-center'],
                      'contentOptions' => ['class' => 'text-right'],
                      ],
                ],
            
    ]); ?>

<div class="alert alert-danger">
  ตรวจสอบจาก HDC on Cloud
</div>
