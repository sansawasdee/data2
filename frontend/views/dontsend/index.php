<?php

use yii\helpers\Html;
use yii\db\Query;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use miloschuman\highcharts\HighchartsAsset;

HighchartsAsset::register($this)->withScripts(['modules/exporting', 'modules/drilldown']);

$this->title = 'สถิติการส่งข้อมูลล่าช้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>        
    </head>
    <body>
        
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'panel' => ['before' => ''],
            'summary' => '',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //  'ampurname',
                //  'total',
                [
                    'attribute' => 'ampurname',
                    'format' => 'raw',
                    'label' => 'อำเภอ',
                    'value' => function($data) {
                        return Html::a($data['ampurname'], ['dontsend/dontsend2'
                                    , 'ampurname' => $data['ampurname']
                        ]);
                    }
                ],
                [
                    'attribute' => 'total',
                    'label' => 'จำนวน'
                ],
            ],
        ]);
        ?>

    </body>
</html>