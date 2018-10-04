<?php
/* @var $this yii\web\View */
$this->title = 'รายละเอียดข้อมูล';
//use yii\grid\GridView; 
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-danger">
<div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i>จำนวนข้อมูลที่จัดส่งขึ้น HDC Cloud</h3>
    </div>
<div class="panel-body">
 <?= GridView::widget([
        'dataProvider' => $dataProvider,    
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'summary' => '',
        'pjax' => true,
        'columns' => [
                      // ['class' => 'yii\grid\SerialColumn'],
					  ['class' => 'kartik\grid\SerialColumn'],
                      [                               
               		 'attribute' => 'id',
               		 'format' => 'raw',
               		 'label' => 'รหัสอำเภอ',
		'value' => function($data)  {
                   	 return Html::a($data['id'], ['upload/uploads'
                               , 'id' => $data['id']                           
                    ]);
                }
                    ],
           [
	      'attribute' => 'a',
                      'label' => 'อำเภอ'],
                    [
                      'attribute' => 'e' ,
                        'label' => 'จำนวนสถานบริการที่ส่ง',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                    [
                      'attribute' => 'c' ,
                        'label' => 'จำนวน zip file ที่ส่ง',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                     
              
                ],
            
    ]); ?>

  </div>
</div>
<div class="alert alert-danger">
 
</div>

