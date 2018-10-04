<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\F43Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายชื่อสถานบริการที่ปรับโครงสร้าง 43 แฟ้มเป็น version 2.3 ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="f43-index">

  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i>  รายชื่อสถานบริการที่ปรับโครงสร้าง 43 แฟ้มเป็น version 2.3 </h3>',
        'type'=>'success',
             
       'type' => GridView::TYPE_PRIMARY
       ], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'HOSPCODE',
            'hosname',
            //'ampurname',
			[
                'attribute'=>'ampurname',
                'filter'=>array(
				"เมืองเชียงราย"=>"เมืองเชียงราย" ,
				"เวียงชัย"=>"เวัยงชัย" ,
				"เชียงของ"=>"เชียงของ" ,
				"เทิง"=>"เทิง" ,
				"พาน"=>"พาน",
				"ป่าแดด"=>"ป่าแดด",
				"แม่จัน"=>"แม่จัน",
				"เชียงแสน"=>"เชียงแสน",
				"แม่สาย"=>"แม่สาย",
				"แม่สรวย"=>"แม่สรวย",
				"เวียงป่าเป้า"=>"เวียงป่าเป้า",
				"พญาเม็งราย"=>"พญาเม็งราย",
				"เวียงแก่น"=>"เวียงแก่น",
				"ขุนตาล"=>"ขุนตาล",
				"แม่ฟ้าหลวง"=>"แม่ฟ้าหลวง",
				"แม่ลาว"=>"แม่ลาว",
				"เวียงเชียงรุ้ง"=>"เวียงเชียงรุ้ง",
				"ดอยหลวง"=>"ดอยหลวง"
				
				)
            ],

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
