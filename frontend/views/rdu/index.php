<?php
/* @var $this yii\web\View */
$this->title = 'รายงาน RDU';

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

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-erase">  ร้อยละการใช้ยาปฏิชีวนะในผู้ป่วยนอกปีงบประมาณ 2561 จังหวัดเชียงราย</i>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <?php
                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => ''],
						'credits'=>['enabled'=> false],
                        'xAxis' => [
                            'categories' => new SeriesDataHelper($dataProvider, ['g']),
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
                            'title' => ['text' => 'จำนวนข้อมูล'],
                            'max' => 100,
                            'stackLabels' => [
                                'enabled' => true,
                                'style' => [
                                    'fontWeight' => 'bold',
                                // 'color' => new JsExpression("(Highcharts.theme && Highcharts.theme.textColor) || 'gray'")
                                ]
                            ]
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'ร้อยละการใช้ยาปฏิชีวนะ',
                                //'data' => new SeriesDataHelper($dataProvider, ['c:int']),
                                'data' => new SeriesDataHelper($dataProvider, ['c:int']),
                                'colorByPoint' => true,
                                'dataLabels' => [
                                    'enabled' => true,
                                ],
								'zoneAxis' => 'y',
								'zones' => [
                            [
                                'value' => 0,
                                'color' => '#55BF3B'
                            ],
                            [
                                'value' => 21,
                                'color' => '#55BF3B'
                            ],
                            [
                                'color' => '#f20e0e'
                            ],
                        ],
                        'stacking' => 'normal'
                  
                            ],
                        ]
						
                    ]
					
                ]);
                ?>
            </div>
            <div class="col-sm-6 col-md-6">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
                    'summary' => '',
                    'pjax' => true,
                    'panel' => [
                        'heading' => '',
                        'type' => 'success',
                        'type' => GridView::TYPE_PRIMARY
                    ],
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'g',
                            'format' => 'raw',
                            'label' => 'กลุ่มโรค',
                        ],
                        [
                            'attribute' => 'a',
                            'label' => 'จำนวนทั้งหมดที่วินิจฉัย',
                            'format' => ['decimal', 0],
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'b',
                            'label' => 'จำนวนที่ได้รับยาปฏิชีวนะ',
                            'format' => ['decimal', 0],
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
						[
                            'attribute' => 'price',
                            'label' => 'มูลค่ายาปฏิชีวนะ',
                            'format' => ['decimal', 0],
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'c',
                            'label' => 'ร้อยละ',
                            'format' => ['decimal', 2],
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                    ],
                ]);
                ?>
                
                    ** แหล่งข้อมูลจาก HDC จังหวัด
                

            </div> 
        </div>
    </div>
</div>
<div class="list-group">
    <a href="#" class="list-group-item active"> ระบบรายงาน    </a>
    <a href="index.php?r=rdu/rdu19" class="list-group-item"> 
        <span class="glyphicon glyphicon-list" aria-hidden="true"></span> 
        ร้อยละการใช้ยาปฏิชีวนะในโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันในผู้ป่วยนอก</a>
    <a href="index.php?r=rdu/rdu20" class="list-group-item"> 
        <span class="glyphicon glyphicon-list" aria-hidden="true"></span> 
        ร้อยละการใช้ยาปฏิชีวนะในโรคอุจาระร่วงเฉียบพลันในผู้ป่วยนอก
    </a>

</div>

