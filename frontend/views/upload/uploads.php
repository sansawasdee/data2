<?php
/* @var $this yii\web\View */
$this->title = 'จำนวนข้อมูลแยกรายสถานบริการบริการ';
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->params['breadcrumbs'][] = ['label' => 'จำนวนข้อมูลแยกอำเภอ', 'url' => ['upload/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'summary' => '',
        'pjax' => true,
        'columns' => [
                   // ['class' => 'yii\grid\SerialColumn'],
				    ['class' => 'kartik\grid\SerialColumn'],
                     [
                 'attribute' => 'hospcode',
                   'label' => 'รหัสหน่วยบริการ',
                     ],
                [
	      'attribute' => 'hosname',
                      'label' => 'หน่วยบริการ'],
                    [
                      'attribute' => 'file_name' ,
                        'label' => 'File Name',
                      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                    [
                      'attribute' => 'file_size' ,
                        'label' => 'ขนาด file',
                     'format'=>['decimal', 3],
	      'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                      [
                      'attribute' => 'upload_date_ssj' ,
                        'label' => 'ส่งเข้าจังหวัด วันที่',
                       'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                      ],
                   
            
        ],
    ]); ?>
<div class="alert alert-danger">
 
</div>

