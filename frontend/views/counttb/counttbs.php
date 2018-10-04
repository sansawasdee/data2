<?php
/* @var $this yii\web\View */
$this->title = 'จำนวนข้อมูลแยกรายสถานบริการบริการ';

use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->params['breadcrumbs'][] = ['label' => 'จำนวนข้อมูลแนกรายอำเภอ', 'url' => ['counttb/index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="panel panel-success">
<div class="panel-heading"> </div>
<div class="panel-body">
<div id="container"> </div>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<?php
	$data = $dataProvider->getModels();
        $้hospcode = [];
        $total = [];
        foreach ($data as $values) {
            $hospcode[] = $values['hospcode'];
            $total[] = (int) $values['total'];
        }
		$hospcode = json_encode($hospcode);
		$total = json_encode($total);
		
$js = <<<JS
   
   Highcharts.chart('container', {
    chart: {
        type: 'column' ,
		fontSize: '14px',
		style: {
            fontFamily: 'Prompt',
        }
    },
    title: {
        text: 'กราฟแสดงจำนวนข้อมูลแฟ้ม service จำแนกตามสถานบริการ'
    },
    
	credits: {
        enabled: false
    },
    xAxis: {
        categories: $hospcode,
        crosshair: true
    },
    yAxis: {
        min: 100,
		
        title: {
            text: 'จำนวน (ราย)'
        }
    },
	legend: {
        enabled: false
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">จำนวน: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} ราย</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
			
        }
    },
    series: [{
        name: 'สถานบริการ',
        data: $total

    
    }],
	
});

JS;
        $this->registerJs($js);
	

?>	

  </div>
</div>
<div >
 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'responsiveWrap' => FALSE,
	      'summary' => '',
	      'showPageSummary' => true,
        'resizableColumns' => true,
      	'responsive' => true,
        'pjax' => true,
        'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนแฟ้ม service แยกรายสถานบริการ แยกรายเดือน</h3>',
       'type' => 'success',
    //  'type' => GridView::TYPE_PRIMARY
         ],
        'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    [              
                     'attribute' => 'hospcode',
                     'format' => 'raw',
                      'label' => 'รหัส',
      	             'value' => function($data)  {
                      return Html::a($data['hospcode'], ['counttb/counttbt'
                                , 'hospcode' => $data['hospcode']
                               
                         ]);
                      }
                    ],
                    [
	                   'attribute' => 'hosname',
                      'label' => 'หน่วยบริการ',
                      'pageSummary' => 'รวม',
                    ],
                    [
                      'attribute' => 'result10' ,
                      'label' => 'ต.ค.60',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',                     
                      ],
                    [
                      'attribute' => 'result11' ,
                        'label' => 'พ.ย.60',
                     'format'=>['decimal', 0],
	                     'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                      [
                      'attribute' => 'result12' ,
                        'label' => 'ธ.ค.60',
                     'format'=>['decimal', 0],
	                    'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                       [
                      'attribute' => 'result01' ,
                        'label' => 'ม.ค.61',
                     'format'=>['decimal', 0],
	                    'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                      [
                      'attribute' => 'result02' ,
                        'label' => 'ก.พ.61',
                     'format'=>['decimal', 0],
	                    'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                     [
                      'attribute' => 'result03' ,
                        'label' => 'มี.ค.61',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                      [
                      'attribute' => 'result04' ,
                        'label' => 'เม.ย.61',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                      [
                      'attribute' => 'result05' ,
                        'label' => 'พ.ค.61',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                      [
                      'attribute' => 'result06' ,
                        'label' => 'มิ.ย.61',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                      [
                      'attribute' => 'result07' ,
                        'label' => 'ก.ค.61',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                       [
                      'attribute' => 'result08' ,
                        'label' => 'ส.ค.61',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                         [
                      'attribute' => 'result09' ,
                        'label' => 'ก.ย.61',
                     'format'=>['decimal', 0],
	                   'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
                     [
                      'attribute' => 'total' ,
                        'label' => 'รวม',
                     'format'=>['decimal', 0],
	                    'headerOptions' => ['class' => 'text-center'],
                     'contentOptions' => ['class' => 'text-center'],
                     'pageSummary' => true,
			               'hAlign' => 'right',
                     'vAlign' => 'middle',  
                      ],
            
        ],
    ]); ?>
</div>
<div class="alert alert-danger">
  ตรวจสอบการส่งโดยใช้แฟ้ม service เท่านั้น
</div>

 