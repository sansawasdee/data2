<?php
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Html;

$this->title = 'สรุปการส่งข้อมูล IS รายสถานบริการ';
$this->params['breadcrumbs'][] = ['label' => 'IS', 'url' => ['is/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
<?php
echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    'summary' => '',
    'showPageSummary' => true,
    'resizableColumns' => true,
    'responsive' => true,
	'hover'=>true,
    'pjax' => true,
	'panel' => [
	    //'heading'=>'<h3 class="panel-title"><i class="fa fa-calendar-plus-o"></i> </h3>',
        'before' => '',		
       // 'type' => 'success',
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn',
         'headerOptions' => [
            'class' => 'text-center',
            'style' => 'background-color:#ccf8fe'
        ],
        ],
        [
            'attribute' => 'HOSP',
            'label' => 'รหัส',
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            
        ],
		[
            'attribute' => 'hosname',
            'label' => 'สถานพยาบาล',
            'pageSummary' => 'รวมจังหวัด',
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
        ],
        [
            'attribute' => 'total',
            'label' => 'รวม(ราย)',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 's10',
            'label' => 'ต.ค.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
          //  'contentOptions' => ['class' => 'text-center'],
		     'contentOptions' => function ($data) {
                if ($data['s10'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             },
             
    
            'hAlign' => 'right',
           'vAlign' => 'middle',
        ],
		[
            'attribute' => 's11',
            'label' => 'พ.ย.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s11'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's12',
            'label' => 'ธ.ค.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s12'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's01',
            'label' => 'ม.ค.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s01'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's02',
            'label' => 'ก.พ.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s02'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's03',
            'label' => 'มี.ค.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s03'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
			[
            'attribute' => 's04',
            'label' => 'เม.ย.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s04'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's05',
            'label' => 'พ.ค.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s05'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's06',
            'label' => 'มิ.ย.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s06'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's07',
            'label' => 'ก.ค.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s07'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
		[
            'attribute' => 's08',
            'label' => 'ส.ค.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s08'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
				[
            'attribute' => 's09',
            'label' => 'ก.ย.',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'
            ],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
			'contentOptions' => function ($data) {
                if ($data['s09'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
    ]
]);
?>
</div>
<div>
<h4>
<span class="label label-warning">ประมวลผลวันที่:</span>
<span class="label label-success"> 
<?php
  $result = $dataProvider2->getModels();
   foreach ($result as $values) {
      echo $values['finish'];
	  echo '  น.';
                                }
  ?> </span> </h4>
</div>