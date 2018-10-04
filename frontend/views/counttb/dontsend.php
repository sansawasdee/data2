<?php
/* @var $this yii\web\View */
$this->title = 'สถานบริการค้างส่งเดือนล่าสุด';

use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">
           <i class="glyphicon glyphicon-remove-sign"></i>
           สถานบริการค้างส่งข้อมูล 43 แฟ้ม
            </h3>
    </div>
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'hoscode',
                    'label' => 'รหัสสถานบริการ',
                ],
                [
                    'attribute' => 'hosname',
                    'label' => 'ชื่อสถานบริการ'],
                [
                    'attribute' => 'ampurname',
                    'label' => 'อำเภอ'],
            ],
        ]);
        ?>
    </div>
</div>
<div class="alert alert-danger">
    ตรวจสอบการส่งโดยใช้แฟ้ม service เท่านั้น
</div>

