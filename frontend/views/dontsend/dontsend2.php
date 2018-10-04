<?php
use yii\helpers\Html;
use yii\db\Query;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;


$this->title = 'สถิติการส่งข้อมูลล่าช้ารายสถานบริการ';
$this->params['breadcrumbs'][] = ['label' => 'สถิติการส่งข้อมูลล่าช้า', 'url' => ['dontsend/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => ['before' => ''],
    'summary' => '',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'hoscode',
            'label' => 'รหัสสถานบริการ'
        ],
        [
            'attribute' => 'hosname',
            'label' => 'ชื่อสถานบริการ'
        ],
        [
            'attribute' => 'ampurname',
            'label' => 'อำเภอ'
        ],
        [
            'attribute' => 'month_send',
            'label' => 'เดือนที่ส่งช้า'
        ]
    ],
    
]);



