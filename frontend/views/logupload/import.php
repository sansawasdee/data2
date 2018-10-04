<?php
/* @var $this yii\web\View */

$this->title = 'รายละเอียด zip file';
//use yii\grid\GridView; 
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

$this->params['breadcrumbs'][] = ['label' => 'ประวัติการ Upload ย้อนหลัง 1 เดือน', 'url' => ['logupload/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h4>ชื่อไฟล์ :  <?= Html::encode($file_name) ?></h4>
<?= GridView::widget([
        'dataProvider' => $dataProvider,    
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i>  รายละเอียดการนำเข้า </h3>',
        'type'=>'success',
             
       'type' => GridView::TYPE_PRIMARY
       ], 
           
        'pjax' => true,
        'columns' => [
                       ['class' => 'kartik\grid\SerialColumn'],
                       [
	                   'attribute' => 'txt',
                           'label' => 'ชื่อแฟ้ม'],
					[
	                   'attribute' => 'successcount',
                           'label' => 'ส่งข้อมูลสำเร็จ'],
				    [
	                   'attribute' => 'errorcount',
                           'label' => 'ข้อมูล Error'],
					[
	                   'attribute' => 'recorddatetime',
                           'label' => 'นำเข้าข้อมูลวันที่'],
                        
            ],
            
    ]); ?>