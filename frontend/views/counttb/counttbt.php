<?php
/* @var $this yii\web\View */
$this->title = 'จำนวนข้อมุลแยกรายสถานบริการบริการ รายแฟ้ม';

use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->params['breadcrumbs'][] = ['label' => 'จำนวนข้อมูลแนกรายอำเภอ', 'url' => ['counttb/index']];
$this->params['breadcrumbs'][] = $this->title;


?>

 <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'pjax' => true,
		  'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนแฟ้มแยกรายแฟ้ม แยกรายเดือน</h3>',
        'type' => 'success',    
         ],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                     [
                 
                'attribute' => 'hospcode',
                  'label' => 'รหัส',
	
                    ],
                   [
	      'attribute' => 'hosname',
                      'label' => 'หน่วยบริการ'],
                    [
	      'attribute' => 'tb',
                      'label' => 'แฟ้ม'],

                    [
                      'attribute' => 'result10' ,
                        'label' => 'ต.ค.59',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                    [
                      'attribute' => 'result11' ,
                        'label' => 'พ.ย.59',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                      [
                      'attribute' => 'result12' ,
                        'label' => 'ธ.ค.59',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                       [
                      'attribute' => 'result01' ,
                        'label' => 'ม.ค.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                      [
                      'attribute' => 'result02' ,
                        'label' => 'ก.พ.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                     [
                      'attribute' => 'result03' ,
                        'label' => 'มี.ค.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                      [
                      'attribute' => 'result04' ,
                        'label' => 'เม.ย.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                      [
                      'attribute' => 'result05' ,
                        'label' => 'พ.ค.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                      [
                      'attribute' => 'result06' ,
                        'label' => 'มิ.ย.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                      [
                      'attribute' => 'result07' ,
                        'label' => 'ก.ค.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                       [
                      'attribute' => 'result08' ,
                        'label' => 'ส.ค.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                         [
                      'attribute' => 'result09' ,
                        'label' => 'ก.ย.60',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                     [
                      'attribute' => 'total' ,
                        'label' => 'รวม',
                     'format'=>['decimal', 0],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],





        

        ],
    ]); ?>

 