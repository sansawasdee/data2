<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use miloschuman\highcharts\HighchartsAsset;
use yii\data\ArrayDataProvider ;
use frontend\models\Ischospital ;

$this->title = 'รายงาน อุบัติเหตุการขนส่ง';
$this->params['breadcrumbs'][] = ['label' => 'IS', 'url' => ['is/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
ActiveForm::begin([
    'method' => 'GET'
]);
?>
<div class="row">
    <div class="col-sm-3">

        <?php
        echo DatePicker::widget([
            'name' => 'date1',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'value' => $date1,
            'options' => ['placeholder' => 'วันที่เกิดเหตุตั้งแต่'],
            'language' => 'th',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
				'todayHighlight' => true,
            ]
        ]);
        ?>
    </div>
    <div class="col-sm-3">

        <?php
        echo DatePicker::widget([
            'name' => 'date2',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'value' => $date2,
            'options' => ['placeholder' => 'ถึงวันที่'],
            'language' => 'th',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
				'todayHighlight' => true,
            ]
        ]);
        ?>
    </div>
	<div class="col-sm-3">
	<?php
	$items = ArrayHelper::map(Ischospital::find()->orderBy(['hoscode' => SORT_DESC])->all(), 'hoscode', 'hosname');
	echo Html::dropDownList(
	'hoscode', $hoscode, $items, [
	'prompt' => 'เลือกโรงพยาบาล',
	'style' => 'height:32px !important', 
	]
	); 
	?>
	</div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-success" ><i class="glyphicon glyphicon-ok"></i> ตกลง </button>
    </div>
</div>


<?php
ActiveForm::end();
?>

<div>
<h4><span class="label label-warning">
        <?php
        if (empty($date1) and empty($date2)) {
            echo 'กรุณาระบุช่วงวันที่ ที่ต้องการ ';
        } elseif ($date1 > $date2) {
            echo 'กรุณาระบุช่วงวันที่ ให้ถูกต้อง ';
        } else {
            echo 'วันที่เกิดเหตุตั้งแต่   ', $date1, '   ถึงวันที่   ', $date2;
        }
        ?>
    </span>  </h4>  

</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<div class="row">
<div class="col-sm-6"> 
<div id="container" style="min-width: 310px; height: 350px; max-width: 600px; margin: 0 auto"></div>


 </div>
 <div class="col-sm-6">
 <div id="container2" style="min-width: 310px; height: 350px; max-width: 600px; margin: 0 auto"></div>
 
 </div>
 </div> 
 

<?php
$data = $dataProvider2->getModels();
$y=[];
foreach ($data as $values){
	$y[] = array("name" => $values['name'], "y" => (int)$values['y']);
	
}
  $y = json_encode($y); 
 
  
 $data3 = $dataProvider3->getModels();
        $age = [];
        $total = [];
        foreach ($data3 as $values) {
            $age[] = $values['age'];
            $total[] = (int) $values['total'];
        }
 $age = json_encode($age);
 $total = json_encode($total);
		
		//echo $age ;
	
 
  
  
$js = <<<JS

Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
		style: {
            fontFamily: 'Prompt',
        }
    },
    title: {
        text: 'กราฟแสดงผู้บาดเจ็บและตายจากอุบัติเหตุการขนส่ง จำแนกตามเพศ '
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
	credits: {
        enabled: false
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
			showInLegend: true ,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'จำนวน',
        colorByPoint: true,		
        data: $y
    }]
});

Highcharts.chart('container2', {
    chart: {
        type: 'column' ,
		style: {
            fontFamily: 'Prompt',
        }
    },
    title: {
        text: 'กราฟแสดงผู้บาดเจ็บและตายจากอุบัติเหตุการขนส่ง จำแนกตามอายุ'
    },
    //subtitle: {
   //     text: 'Source: WorldClimate.com'
  //  },
	credits: {
        enabled: false
    },
    xAxis: {
        categories: $age,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'จำนวน (ราย)'
        }
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
            borderWidth: 0
        }
    },
    series: [{
        name: 'ช่วงอายุ',
        data: $total

    
    }]
});


JS;
        $this->registerJs($js);
?>
<div>
<?php

echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
    'summary' => '',
    'showPageSummary' => true,
    'resizableColumns' => true,
    'responsive' => true,
    'pjax' => true,
    'panel' => [
	
       'before' => 'จำนวนผู้บาดเจ็บและตายจากอุบัติเหตุการขนส่ง จำแนกตามพาหนะและประเภทของผู้บาดเจ็บ ',
	   
		
       // 'type' => 'success',
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn',
         'headerOptions' => [
            'class' => 'text-center',
            'style' => 'background-color:#ccf8fe']
        ],
        [
            'attribute' => 'injt_name',
            'label' => 'พาหนะ',
            'pageSummary' => 'รวม',
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe']
        ],
        [
            'attribute' => 'total',
            'label' => 'รวม(ราย)',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 'driver',
            'label' => 'ผู้ขับขี่',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 'passenger',
            'label' => 'ผู้โดยสาร',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
        ],
		[
            'attribute' => 'N',
            'label' => 'ไม่ระบุ',
            'format' => ['decimal', 0],
            'headerOptions' => [
                'class' => 'text-center',
                'style' => 'background-color:#ccf8fe'],
            'pageSummary' => true,
            'contentOptions' => ['class' => 'text-center'],
            'hAlign' => 'right',
            'vAlign' => 'middle',
        ],
    ]
]);
?>
</div>

<div>
<h4>
<span class="label label-warning">ประมวลผลวันที่:</span>
<span class="label label-success"> 
<?php
  $result = $dataProvider4->getModels();
   foreach ($result as $values) {
      echo $values['finish'];
	  echo '  น.';
                                }
  ?> </span> </h4>
</div>
