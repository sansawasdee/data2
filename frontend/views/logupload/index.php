<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogUploadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประวัติการ Upload ย้อนหลัง 1 เดือน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logupload-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ประวัติการ Upload ย้อนหลัง 1 เดือน </h3>',
        'type'=>'success',
             
      // 'type' => GridView::TYPE_PRIMARY
       ], 
        'columns' => [
		    
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
			'hospcode',
            'hosname',
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
            //'ampurname',
            'upload_date',
            //'file_name',
			[                               
               		 'attribute' => 'file_name',
               		 'format' => 'raw',
               		 'label' => 'file_name',
		'value' => function($data)  {
                   	 return Html::a($data['file_name'], ['logupload/import'
                               , 'file_name' => $data['file_name']                           
                    ]);
                }
                    ],
            'file_size',
                   ],
    ]); ?>
</div>
