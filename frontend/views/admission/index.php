<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->title = 'จำนวนข้อมูลแฟ้ม admission';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
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
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
            ำนวนข้อมูลแฟ้ม admission แยกรายโรงพยาบาล</h3>
    </div>
    <div id="container"></div>
</div>
<?php
$data = $dataProvider->getModels();
        // print_r($data);
        $hosname = [];
        $total = [];
        foreach ($data as $values) {
            $hosname[] = $values['hosname'];
            $total[] = (int) $values['total'];
        }
        $hosname = json_encode($hosname);
        $total = json_encode($total);
$js = <<<JS
Highcharts.chart('container', {
    chart: {
        type: 'bar',
        style: {
            fontFamily: 'Prompt',
            
        }
        
    },
    title: {
        text: 'ปีงบประมาณ 2561'
    },
    
    xAxis: {
        categories: $hosname,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '(ครั้ง)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' ครั้ง'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: false
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'จำนวน',
        data: $total,
		colorByPoint: true,
    
    }]
});
JS;
        $this->registerJs($js);
?>

 
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    'responsiveWrap' => FALSE,
    'summary' => '',
    'showPageSummary' => true,
    'pjax' => true,
    'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนข้อมูลแฟ้ม admission แยกรายเดือน</h3>',
        'type' => 'success',
    //  'type' => GridView::TYPE_PRIMARY
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            
            'attribute' => 'hospcode',
             'label' => 'รหัสโรงพยาบาล',
            
        ],
        [
            
            'attribute' => 'hosname',
            'label' => 'ชื่อโรงพยาบาล',
            'pageSummary' => 'รวม',
		],
        [
            'attribute' => 'result10',
            'label' => 'ต.ค.60',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result11',
            'label' => 'พ.ย.60',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result12',
            'label' => 'ธ.ค.60',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result01',
            'label' => 'ม.ค.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result02',
            'label' => 'ก.พ.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result03',
            'label' => 'มี.ค.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result04',
            'label' => 'เม.ย.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result05',
            'label' => 'พ.ค.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result06',
            'label' => 'มิ.ย.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result07',
            'label' => 'ก.ค.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result08',
            'label' => 'ส.ค.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'result09',
            'label' => 'ก.ย.61',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
        [
            'attribute' => 'total',
            'label' => 'รวม',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
        ],
    ],
]);
?>



<div class="alert alert-danger">
    ตรวจสอบการส่งโดยใช้แฟ้ม admission
</div>
</body>
</html>