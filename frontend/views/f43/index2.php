<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\F43Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ร้อยละสถานบริการที่ปรับโครงสร้าง 43 แฟ้มเป็น version 2.3 ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">
<div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
            ร้อยละสถานบริการที่ปรับโครงสร้าง 43 แฟ้มเป็น version 2.3 แยกรายอำเภอ</h3>
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
                'name'=>'ร้อยละสถานบริการที่ปรับโครงสร้าง 43 แฟ้มเป็นversion2.3',
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
        'type' => 'success',
       // 'type' => GridView::TYPE_PRIMARY
    ],
        'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                     [                               
               		 'attribute' => 'areacode',
               		 'format' => 'raw',
               		 'label' => 'รหัสอำเภอ',
		              'value' => function($data)  {
                   	 return Html::a($data['areacode'], ['f43/v23'
                               , 'areacode' => $data['areacode']                           
                        ]);
                     }
                      ], 
                    [
				      'attribute' => 'ampurname',
                      'label' => 'อำเภอ',
					  
					],
                    [
                     'attribute' => 'total' ,
                     'label' => 'จำนวนสถานบริการ',
                     'format'=>['decimal', 0],
	                 'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                    [
                     'attribute' => 'v23' ,
                     'label' => 'จำนวนสถานบริการที่ปรับ V 2.3',
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

<div class="alert alert-danger">
  ตรวจสอบจาก HDC แฟ้ม service
</div>
