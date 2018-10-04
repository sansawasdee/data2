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

$this->title = 'แยกรายสถานบริการ ';
$this->params['breadcrumbs'][] = ['label' => 'การปรับปรุงรายละเอียดหน่วยงาน', 'url' => ['profile/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    'summary' => '',
    'showPageSummary' => true,
    'resizableColumns' => true,
	'responsiveWrap'=>FALSE,
    'responsive' => true,
    //'hover' => true,
   // 'floatHeader' => true,
    'pjax' => true,
    'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> แยกรายสถานบริการ</h3>',
       // 'type' => 'success',
        'type' => GridView::TYPE_PRIMARY
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        
        [
            'attribute' => 'hoscode',
            'label' => 'รหัสสถานบริการ',
			'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
		],
		[
            'attribute' => 'hosname',
            'label' => 'สถานบริการ',
			'headerOptions' => ['class' => 'text-center'],
          //  'contentOptions' => ['class' => 'text-center'],
		],
		[
            'attribute' => 'OrganizationName_en',
            'label' => 'OrganizationName_en',
			'headerOptions' => ['class' => 'text-center'],
         //   'contentOptions' => ['class' => 'text-center'],
		],
		[
            'attribute' => 'address_en',
            'label' => 'address_en',
			'headerOptions' => ['class' => 'text-center'],
       //     'contentOptions' => ['class' => 'text-center'],
		],
		[
            'attribute' => 'contactperson',
            'label' => 'contactperson',
			'headerOptions' => ['class' => 'text-center'],
       //     'contentOptions' => ['class' => 'text-center'],
		],
		[
            'attribute' => 'r',
            'label' => 'ปรับปรุง',
			'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
		],
            
        
    ],
]);
?>