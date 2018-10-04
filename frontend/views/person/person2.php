<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
$this->title = 'person แยกรายสถานบริการ';
$this->params['breadcrumbs'][] = ['label' => 'person แยกรายอำเภอ', 'url' => ['person/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title> 
		<script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
	</head>
<body>
<div id="container" style="min-width: 310px; height: 600px; margin: 0 auto"></div>
<?php
$data = $dataProvider->getModels();
        // print_r($data);
        $hosname = [];
        $type1 = [];
		$type2 = [];
		$type3 = [];
		$type4 = [];
        foreach ($data as $values) {
            $hosname[] = $values['hosname'];
            $type1[] = (int) $values['type1'];
			$type2[] = (int) $values['type2'];
			$type3[] = (int) $values['type3'];
			$type4[] = (int) $values['type4'];
        }
        $hosname = json_encode($hosname);
        $type1 = json_encode($type1);
		$type2 = json_encode($type2);
		$type3 = json_encode($type3);
		$type4 = json_encode($type4);
$js = <<<JS
Highcharts.chart('container', {
    chart: {
        type: 'bar',
        style: {
            fontFamily: 'Prompt',
            
        }
		
    },
    title: {
        text: 'จำนวนประชากรแยกตาม type area'
    },
    credits: {
        enabled: false
    },
    xAxis: {
        categories: $hosname
    },
    yAxis: {
        min: 0,
        title: {
            text: 'จำนวนคน'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'type1',
        data: $type1
    }, {
        name: 'type2',
        data: $type2
    }, {
        name: 'type3',
        data: $type3
    }, {
        name: 'type4',
        data: $type4
    }]
});
JS;
        $this->registerJs($js);
?>

<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
	'summary' => '',
    'showPageSummary' => true,
    'resizableColumns' => true,
    'responsive' => true,
    'pjax' => true,
    'panel' => [
        //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนข้อมูลแฟ้ม admission แยกรายเดือน</h3>',
        'type' => 'success',
    //  'type' => GridView::TYPE_PRIMARY
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'HOSPCODE',
             'label' => 'รหัสสถานบริการ',
			 'pageSummary' => 'รวมอำเภอ',			            
        ],
        [
            'attribute' => 'hosname',
            'label' => 'สถานบริการ'
		],
        [
            'attribute' => 'type1',
            'label' => 'type1',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
			'pageSummary' => true,
			'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 'type2',
            'label' => 'type2',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
			'pageSummary' => true,
			'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 'type3',
            'label' => 'type3',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
			'pageSummary' => true,
			'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 'type4',
            'label' => 'type4',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
			'pageSummary' => true,
			'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 'total',
            'label' => 'รวม',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
			'pageSummary' => true,
			'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        
    ],
]);
?>



<div class="alert alert-danger">
    ตรวจสอบการส่งโดยใช้แฟ้ม person ตัดความซ้ำซ้อน
</div>
</body>
</html>
