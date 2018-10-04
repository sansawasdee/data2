<?php
/* @var $this yii\web\View */
$this->title = 'URI แยกรายสถานบริการ';

//use yii\grid\GridView; 
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน RDU', 'url' => ['rdu/index']];
$this->params['breadcrumbs'][] = ['label' => 'URI แยกรายอำเภอ', 'url' => ['rdu/rdu19']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"> ร้อยละการใช้ยาปฏิชีวนะในโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันในผู้ป่วยนอก</i>
        </h3>
    </div>
    <div class="panel-body">

        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => ''],
                'xAxis' => [
                    'categories' => new SeriesDataHelper($dataProvider, ['hosname']),
                    'crosshair' => true,
                ],
                'tooltip' => [
                    'headerFormat' => '<b>{point.x}</b><br/>',
                    'pointFormat' => '{series.name}: {point.y}'
                ],
                'legend' => [
                    'align' => 'center',
                    'x' => 40,
                    'verticalAlign' => 'bottom',
                    'y' => 0,
                    'floating' => false,
                    //'backgroundColor' => new JsExpression("(Highcharts.theme && Highcharts.theme.background2) || 'white'"),
                    'borderColor' => '#CCC',
                    'borderWidth' => 1,
                    'borderRadius' => 10,
                    'shadow' => false
                ],
                'yAxis' => [
                    'min' => 0,
                    'title' => ['text' => 'ร้อยละการใช้ยาปฏิชีวนะ'],
                    'max' => 100,
                    'stackLabels' => [
                        'enabled' => true,
                        'style' => [
                            'fontWeight' => 'bold',
                        // 'color' => new JsExpression("(Highcharts.theme && Highcharts.theme.textColor) || 'gray'")
                        ]
                    ]
                ],
                'plotOptions' => [
                    'series' => [
                        'zoneAxis' => 'y',
                        'zones' => [
                            [
                                'value' => 0,
                                'color' => '#00FF00'
                            ],
                            [
                                'value' => 21,
                                'color' => '#00FF00'
                            ],
                            [
                                'color' => '#FF0000'
                            ],
                        ],
                        'stacking' => 'normal'
                    ]
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'ร้อยละการใช้ยาปฏิชีวนะ',
                        //'data' => new SeriesDataHelper($dataProvider, ['c:int']),
                        'data' => new SeriesDataHelper($dataProvider, ['c:int']),
                    //'colorByPoint' => true,
                    // 'dataLabels' => [
                    //      'enabled' => true,
                    // ]
                    ],
                ]
            ]
        ]);
        ?>

    </div>
</div>



<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    'summary' => '',
    'pjax' => true,
    'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> แยกรายสถานบริการ แยกรายเดือน</h3>',
        'type' => 'success',
        'type' => GridView::TYPE_PRIMARY
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'HOSPCODE',
            'label' => 'รหัส',
        ],
        [
            'attribute' => 'hosname',
            'label' => 'สถานบริการ'],
        [
            'attribute' => 'a',
            'label' => 'DXรวม',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'b',
            'label' => 'ABOรวม',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'c',
            'label' => '%รวม',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a10',
            'label' => 'dxต.ต',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r10',
            'label' => 'ABOต.ต',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p10',
            'label' => '%ต.ต',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a11',
            'label' => 'dxพ.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r11',
            'label' => 'ABOพ.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p11',
            'label' => '%พ.ย',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a12',
            'label' => 'dxธ.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r12',
            'label' => 'ABOธ.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p12',
            'label' => '%ธ.ค',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a01',
            'label' => 'dxม.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r01',
            'label' => 'ABOม.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p01',
            'label' => '%ม.ค',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a02',
            'label' => 'dxก.พ',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r02',
            'label' => 'ABOก.พ',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p02',
            'label' => '%ก.พ',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a03',
            'label' => 'dxมี.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r03',
            'label' => 'ABOมี.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p03',
            'label' => '%มี.ค',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a04',
            'label' => 'dxเม.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r04',
            'label' => 'ABOเม.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p04',
            'label' => '%เม.ย',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a05',
            'label' => 'dxพ.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r05',
            'label' => 'ABOพ.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p05',
            'label' => '%พ.ค',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a06',
            'label' => 'dxมิ.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r06',
            'label' => 'ABOมิ.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p06',
            'label' => '%มิ.ย',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a07',
            'label' => 'dxก.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r07',
            'label' => 'ABOก.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p07',
            'label' => '%ก.ค',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a08',
            'label' => 'dxส.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r08',
            'label' => 'ABOส.ค',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p08',
            'label' => '%ส.ค',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'a09',
            'label' => 'dxก.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'r09',
            'label' => 'ABOก.ย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'p09',
            'label' => '%ก.ย',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
        ],
    ],
]);
?>
</div>