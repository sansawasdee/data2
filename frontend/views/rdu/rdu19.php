<?php
/* @var $this yii\web\View */
$this->title = 'URI แยกรายอำเภอ';

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
				'credits'=>['enabled'=> false],
                'xAxis' => [
                    'categories' => new SeriesDataHelper($dataProvider, ['ampurname']),
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
<?php
$sql_pers = "SELECT ROUND(SUM(b)*100/SUM(a),2) as pers
FROM rdu19";

$p = \Yii::$app->db->createCommand($sql_pers);
$percent = $p->queryScalar();
?>    


<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    'summary' => '',
    'showPageSummary' => true,
    'resizableColumns' => true,
    'responsive' => true,
    //'hover' => true,
   // 'floatHeader' => true,
    'pjax' => true,
    'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> แยกรายอำเภอ แยกรายเดือน</h3>',
        'type' => 'success',
        //'type' => GridView::TYPE_PRIMARY
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'ampurcodefull',
            'format' => 'raw',
            'pageSummary' => 'รวมจังหวัด',
            'label' => 'รหัสอำเภอ',
            'value' => function($data) {
                return Html::a($data['ampurcodefull'], ['rdu/rdu19s'
                            , 'ampurcodefull' => $data['ampurcodefull']
                ]);
            }
        ],
        [
            'attribute' => 'ampurname',
            'label' => 'อำเภอ'],
        
        [
            'attribute' => 'a',
            'label' => 'จำนวนที่วินิจฉัย',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'b',
            'label' => 'จำนวนที่ได้รับยาปฏิชีวนะ',
            'format' => ['decimal', 0],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => true,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'c',
            'label' => 'ร้อยละที่ใช้ยาปฏิชีวนะ',
            'format' => ['decimal', 2],
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'pageSummary' => $percent,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
    ],
]);
?>
</div>