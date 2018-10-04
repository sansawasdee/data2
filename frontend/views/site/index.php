<!--<script>
    window.location='./index.php?r=counttb%2Findex';
</script> -->
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
//HighchartsAsset::register($this)->withScripts(['highcharts-more','modules/solid-gauge',]);
//$this->registerJsFile('@web/js/chart-donut.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'F43file';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>    
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
              crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
        <!-- leaflet font marker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css"
              />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.min.js"></script>
        <!-- end leaflet font maker-->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>

        <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>


        <style>
            .mapid {
                width: 100%;
                height: 90vh;
            }


            .legend {
                text-align: left;
                line-height: 18px;
                color: #555;
            }

            .legend i {
                width: 18px;
                height: 18px;
                float: left;
                margin-right: 8px;
                opacity: 0.7;
            }

            /* step 9 */

            .my-leaflet-tooltip {
                background: none;
                border: none;
                box-shadow: none;
            }

            .highcharts-yaxis-grid .highcharts-grid-line {
                display: none;
            }
        </style>
    </head>
    <body>
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                <?php
                                $result = $dataProvider->getModels();
                                //var_dump($result);
                                foreach ($result as $values) {
                                    echo $values['total'];
                                }
                                ?> 
                            </h3>

                            <p>ข้อมูลแฟ้ม Service</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <a href="data/frontend/web/index.php?r=counttb" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                <?php
                                $result2 = $dataProvider2->getModels();
                                //var_dump($result);
                                foreach ($result2 as $values) {
                                    echo $values['total'];
                                }
                                ?> 
                            </h3>

                            <p>ข้อมูลแฟ้ม Admission</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-wheelchair"></i>
                        </div>
                        <a href="?r=admission" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>
                                <?php
                                $result3 = $dataProvider3->getModels();
                                //var_dump($result);
                                foreach ($result3 as $values) {
                                    echo $values['total'];
                                }
                                ?> 
                            </h3>

                            <p>ข้อมูลแฟ้ม Person</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="?r=person" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Eh</h3>
                            <p>คุณภาพข้อมูล 43 แฟ้ม</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>
                        <a href="//61.19.32.29/eh" class="small-box-footer" target="_blank">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
                    </div>                    
                </div>                    
            </div>  
            <div class="row">
                <section class="col-lg-7 connectedSortable">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#revenue-chart" data-toggle="tab">แยกรายเดือน</a></li>
                            <li><a href="#sales-chart" data-toggle="tab">แยกรายอำเภอ</a></li>
                            <h5><li class="pull-left header"><i class="fa fa-inbox"></i> สถิติการส่งข้อมูลล่าช้า</h5></li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 400px;">
                                <script src="https://code.highcharts.com/highcharts.js"></script>
                                <script src="https://code.highcharts.com/modules/series-label.js"></script>
                                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                                <script src="https://code.highcharts.com/modules/export-data.js"></script>

                                <div id="container2"></div>
                            </div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 400px;">
                                <div id="container"></div>                                
                            </div>                         

                        </div>
                        <div class="small-box bg-aqua"><a href="?r=dontsend" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a></div>

                    </div> 
                </section>
                <section class="col-lg-5 connectedSortable">
                    <div class="box box-solid ">
                        <div class="box-header">

                            <i class="fa fa-globe"></i>   คัดกรองพัฒนาการเด็กตามกลุ่มอายุ ช่วงรณรงค์                           

                        </div>
                        <div class="box-body">
                            <div id="mapid" style="height: 384px; width: 100%;"></div>
                        </div>
                        <div class="small-box bg-green"><a href="?r=mapkpi%2Fdspm1" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a></div>
                    </div>
                </section>             
            </div>
            <!--KPI-->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h6 class="box-title">ตัวชี้วัด </h6>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>				
                    </div>
                </div>
                <div class="box-body">
                    <div class="row"> 
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-4"> 
                            <a href="https://cri.hdc.moph.go.th/hdc/reports/report_kpi.php?flag_kpi_level=1&flag_kpi_year=2018&source=pformated/format1.php&id=4ea15a97238c68583f6d644e47506339" target="_blank">
                                <div id="kpi1" style="width: 100%; height: 200px; float: left">
                                    <i class="fa fa-refresh fa-spin"></i>                							   
                                </div></a>

                        </div>
                        <div class="col-md-4"> 
                            <a href="https://cri.hdc.moph.go.th/hdc/reports/report_kpi.php?flag_kpi_level=1&flag_kpi_year=2018&source=pformated/format1.php&id=d36f6c38999d128132513933e36a848a" target="_blank">
                                <div id="kpi2" style="width: 100%; height: 200px; float: left">
                                    <i class="fa fa-refresh fa-spin"></i>							   
                                </div></a>			 
                        </div>
                        <div class="col-md-4"> 
                            <a href="https://cri.hdc.moph.go.th/hdc/reports/report.php?source=pformated/format1.php&cat_id=b2b59e64c4e6c92d4b1ec16a599d882b&id=137a726340e4dfde7bbbc5d8aeee3ac3" target="_blank">
                                <div id="kpi3" style="width: 100%; height: 200px; float: left">
                                    <i class="fa fa-refresh fa-spin"></i>							   
                                </div></a>			 
                        </div>			 
                    </div>	
                    <div class="row"> 
                        <div class="col-md-4"> 
                            <a href="https://cri.hdc.moph.go.th/hdc/reports/report.php?source=pformated/format1.php&cat_id=b2b59e64c4e6c92d4b1ec16a599d882b&id=df9a12ff1c86ab1b29b3e47118bcd535" target="_blank" >
                                <div id="kpi4" style="width: 100%; height: 200px; float: left">
                                    <i class="fa fa-refresh fa-spin"></i>							   
                                </div></a>			 
                        </div>
                        <div class="col-md-4"> 
                            <a href="https://cri.hdc.moph.go.th/hdc/reports/report.php?source=pformated/format1.php&cat_id=1ed90bc32310b503b7ca9b32af425ae5&id=1c1b8e24aff59258a806f122e264031e" target="_blank">
                                <div id="kpi5" style="width: 100%; height: 200px; float: left">
                                    <i class="fa fa-refresh fa-spin"></i>							   
                                </div></a>			 
                        </div>
                        <div class="col-md-4"> 
                            <a href="https://cri.hdc.moph.go.th/hdc/reports/report.php?source=epi/epi_complete.php&cat_id=4df360514655f79f13901ef1181ca1c7&id=28dd2c7955ce926456240b2ff0100bde" target="_blank">
                                <div id="kpi6" style="width: 100%; height: 200px; float: left">
                                    <i class="fa fa-refresh fa-spin"></i>							   
                                </div></a>			 
                        </div>				 
                    </div>
                </diV>

            </div>


            <!--QOF-->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h6 class="box-title">รายงาน QOF ภาพรวมจังหวัด </h6>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row"> 
                        <div class="clearfix visible-sm-block"></div>
                        <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60001" target="_blank">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">ประชากรอายุ35-74 ปี <br>ได้รับการคัดกรองDM</span>
                                        <span class="info-box-number">

                                            <?php
                                            $result12 = $dataProvider12->getModels();
                                            //var_dump($result);
                                            foreach ($result12 as $values) {
                                                echo $values['percent'];
                                                echo '%';
                                            }
                                            ?> </span>

                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60002" target="_blank">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                    <div class="info-box-content">

                                        <span class="info-box-text">ประชากรอายุ35-74 ปี <br>ได้รับการคัดกรองHT</span>
                                        <span class="info-box-number">
                                            <?php
                                            $result13 = $dataProvider13->getModels();
                                            //var_dump($result);
                                            foreach ($result13 as $values) {
                                                echo $values['percent'];
                                                echo '%';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60003" target="_blank">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">ANC ครั้งแรกภายใน <br>12 สัปดาห์</span>
                                        <span class="info-box-number">
                                            <?php
                                            $result14 = $dataProvider14->getModels();
                                            //var_dump($result);
                                            foreach ($result14 as $values) {
                                                echo $values['percent'];
                                                echo '%';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60004" target="_blank">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">ความครอบคลุม PAP</span>
                                        <span class="info-box-number">
                                            <?php
                                            $result15 = $dataProvider15->getModels();
                                            //var_dump($result);
                                            foreach ($result15 as $values) {
                                                echo $values['percent'];
                                                echo '%';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </a>
                    <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60005" target="_blank">
                        <div class="row"> 
                            <div class="clearfix visible-sm-block"></div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">การใช้ยา antibiotic <br>ในผู้ป่วย AGE</span>
                                        <span class="info-box-number">
                                            <?php
                                            $result16 = $dataProvider16->getModels();
                                            //var_dump($result);
                                            foreach ($result16 as $values) {
                                                echo $values['percent'];
                                                echo '%';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    </a>
                    <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60006" target="_blank">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">การใช้ยา antibiotic <br>ในผู้ป่วย URI</span>
                                    <span class="info-box-number"><?php
                                        $result17 = $dataProvider17->getModels();
                                        //var_dump($result);
                                        foreach ($result17 as $values) {
                                            echo $values['percent'];
                                            echo '%';
                                        }
                                        ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60007" target="_blank">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">ตรวจพัฒนาการเด็ก  <br>9 18 30 42 เดือน</span>
                                    <span class="info-box-number">
                                        <?php
                                        $result18 = $dataProvider18->getModels();
                                        //var_dump($result);
                                        foreach ($result18 as $values) {
                                            echo $values['percent'];
                                            echo '%';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60008" target="_blank">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">เด็ก 9 18 30 42 เดือน<br> พบลงสัยล่าช้า</span>
                                    <span class="info-box-number">
                                        <?php
                                        $result19 = $dataProvider19->getModels();
                                        //var_dump($result);
                                        foreach ($result19 as $values) {
                                            echo $values['percent'];
                                            echo '%';
                                        }
                                        ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="row"> 
                    <div class="clearfix visible-sm-block"></div>
                    <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60009" target="_blank">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">เด็กพัฒนาการล่าช้า<br>ได้รับการกระตุ้น<br>ภายใน 30 วัน</span>
                                    <span class="info-box-number">
                                        <?php
                                        $result20 = $dataProvider20->getModels();
                                        //var_dump($result);
                                        foreach ($result20 as $values) {
                                            echo $values['percent'];
                                            echo '%';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60010" target="_blank">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">ผู้สูงอายุได้รับการ<br>ประเมิน ADL</span>
                                    <span class="info-box-number">
                                        <?php
                                        $result21 = $dataProvider21->getModels();
                                        //var_dump($result);
                                        foreach ($result21 as $values) {
                                            echo $values['percent'];
                                            echo '%';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://61.19.32.29/eh/frontend/web/index.php?r=report%2Freport%2Frunreport4&r_table=60011" target="_blank">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">ผู้สูงอายุติดบ้านติดเตียง<br> ได้รับการเยี่ยมบ้าน</span>
                                    <span class="info-box-number">
                                        <?php
                                        $result22 = $dataProvider22->getModels();
                                        //var_dump($result);
                                        foreach ($result22 as $values) {
                                            echo $values['percent'];
                                            echo '%';
                                        }
                                        ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>  

        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h6 class="box-title"> ข้อมูลประมวลผลเสร็จ </h6>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-4"> 

                    <i class="	fa fa-clock-o"> </i>  HDC Cloud :


                    <?php
                    $result23 = $dataProvider23->getModels();
                    //var_dump($result);

                    foreach ($result23 as $values) {

                        // echo  'วันที่  ';
                        echo $values['date'];
                        echo '  เวลา  ';
                        echo $values['time'];
                        echo '  น. ';
                    }
                    ?>

                </div>

                <div class="col-md-4">         
                    <i class="	fa fa-clock-o"> </i>  HDCจังหวัด :          

                    <?php
                    $result24 = $dataProvider24->getModels();
                    //var_dump($result);
                    foreach ($result24 as $values) {
                        //echo  'วันที่  ';
                        echo $values['date'];
                        echo '  เวลา  ';
                        echo $values['time'];
                        echo '  น. ';
                    }
                    ?>            
                </div>

                <div class="col-md-4">             
                    <i class="	fa fa-clock-o"> </i>  EH :           

                    <?php
                    $result25 = $dataProvider25->getModels();
                    //var_dump($result);
                    foreach ($result25 as $values) {
                        //echo  'วันที่  ';
                        echo $values['date'];
                        echo '  เวลา  ';
                        echo $values['time'];
                        echo '  น. ';
                    }
                    ?>

                </div>

            </div>

        </div>          
    </section>



    <?php
    $data = $dataProvider5->getModels();
    $ampurname = [];
    $total = [];
    foreach ($data as $values) {
        $ampurname[] = $values['ampurname'];
        $total[] = (int) $values['total'];
    }
    $ampurname = json_encode($ampurname);
    $total = json_encode($total);


    //kpi1
    $data2 = $dataProvider6->getModels();
    $kpi = [];
    $percent = [];
    $i = 0;
    foreach ($data2 as $values) {
        $kpi[] = $values['kpi'];
        $percent[] = (int) $values['percent'];
    }
    $kpi = json_encode($kpi);
    $percent = json_encode($percent);

    //kpi2
    $data3 = $dataProvider7->getModels();
    $kpi2 = [];
    $percent2 = [];
    foreach ($data3 as $values) {
        $kpi2[] = $values['kpi'];
        $percent2[] = (int) $values['percent'];
    }
    $kpi2 = json_encode($kpi2);
    $percent2 = json_encode($percent2);

    //kpi3
    $data4 = $dataProvider8->getModels();
    $kpi3 = [];
    $percent3 = [];
    foreach ($data4 as $values) {
        $kpi3[] = $values['kpi'];
        $percent3[] = (int) $values['percent'];
    }
    $kpi3 = json_encode($kpi3);
    $percent3 = json_encode($percent3);

    //kpi4
    $data5 = $dataProvider9->getModels();
    $kpi4 = [];
    $percent4 = [];
    foreach ($data5 as $values) {
        $kpi4[] = $values['kpi'];
        $percent4[] = (int) $values['percent'];
    }
    $kpi4 = json_encode($kpi4);
    $percent4 = json_encode($percent4);

    //kpi5
    $data6 = $dataProvider10->getModels();
    $kpi5 = [];
    $percent5 = [];
    foreach ($data6 as $values) {
        $kpi5[] = $values['kpi'];
        $percent5[] = (int) $values['percent'];
    }
    $kpi5 = json_encode($kpi5);
    $percent5 = json_encode($percent5);

    //kpi5
    $data7 = $dataProvider11->getModels();
    $kpi6 = [];
    $percent6 = [];
    foreach ($data7 as $values) {
        $kpi6[] = $values['kpi'];
        $percent6[] = (int) $values['percent'];
    }
    $kpi6 = json_encode($kpi6);
    $percent6 = json_encode($percent6);


    //กราฟเส้นส่งช้ารายเดือน
    $data8 = $dataProvider4->getModels();
    $month_name = [];
    $total2 = [];
    foreach ($data8 as $values) {
        $month_name[] = $values['month_name'];
        $total2[] = (int) $values['total'];
    }
    $month_name = json_encode($month_name);
    $total2 = json_encode($total2);


    $js = <<<JS

  Highcharts.chart('container2', {
    chart: {
        type: 'line' ,
		style: {
            fontFamily: 'Prompt',
        }
    },
    title: {
        text: 'ปีงบประมาณ 2561'
    },
	credits: {
        enabled: false
    },
    
    xAxis: {
        categories: $month_name
    },
    yAxis: {
        title: {
            text: 'จำนวน(แห่ง)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'จำนวน',
        data: $total2
    
    }]
});
 
  Highcharts.chart('container', {
    chart: {
        type: 'bar',
        width: 550 ,
		style: {
            fontFamily: 'Prompt',
        }
    },
    title: {
        text: 'ปีงบประมาณ 2561'
    },
    
    xAxis: {
        categories: $ampurname,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '(ครั้ง)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' ครั้ง'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: false
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'จำนวน',
        data: $total
    
    }]
});
          
//กราฟตัวชี้วัด kpi
    
var gaugeOptions = {

  chart: {
    type: 'solidgauge',
	style: {
            fontFamily: 'Prompt',
        }
  },

  title: null,

  pane: {
    center: ['50%', '85%'],
    size: '120%',
    startAngle: -90,
    endAngle: 90,
    background: {
      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
      innerRadius: '60%',
      outerRadius: '100%',
      shape: 'arc'
    }
  },

  tooltip: {
    enabled: false
  },

  // the value axis
  yAxis: {
    stops: [
            [0.1, '#f20e0e'],  // red
			[0.2, '#f20e0e'],  // red
			[0.3, '#f20e0e'],  // red
            [0.5, '#DDDF0D'], // yellow
            [0.9, '#55BF3B']  // green
        ],
   //minColor: '#df5353',
   //maxColor: '#55BF3B',
    lineWidth: 0,
    minorTickInterval: null,
    tickAmount: 2,
    title: {
      y: -70
    },
    labels: {
      y: 16
    }
  },

  plotOptions: {
    solidgauge: {
      dataLabels: {
        y: 5,
        borderWidth: 0,
        useHTML: true
      }
    }
  }
};

// kpi1
var chartSpeed = Highcharts.chart('kpi1', Highcharts.merge(gaugeOptions, {
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: $kpi
    }
  },

  credits: {
    enabled: false
  },

  series: [{
    name: 'Speed',
    data: [$percent],
    dataLabels: {
      format: '<div style="text-align:center"><span style="font-size:25px;color:' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
           '<span style="font-size:12px;color:silver">%</span></div>'
    },
    tooltip: {
      valueSuffix: '%'
    }
  }]

}));
         
//kpi2
var chartSpeed = Highcharts.chart('kpi2', Highcharts.merge(gaugeOptions, {
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: $kpi2
    }
  },

  credits: {
    enabled: false
  },

  series: [{
    name: 'Speed',
    data: [$percent2],
    dataLabels: {
      format: '<div style="text-align:center"><span style="font-size:25px;color:' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
           '<span style="font-size:12px;color:silver">%</span></div>'
    },
    tooltip: {
      valueSuffix: ' %'
    }
  }]

}));

// kpi3
var chartSpeed = Highcharts.chart('kpi3', Highcharts.merge(gaugeOptions, {
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: $kpi3
    }
  },

  credits: {
    enabled: false
  },

  series: [{
    name: 'Speed',
    data: [$percent3],
    dataLabels: {
      format: '<div style="text-align:center"><span style="font-size:25px;color:' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
           '<span style="font-size:12px;color:silver">%</span></div>'
    },
    tooltip: {
      valueSuffix: '%'
    }
  }]

}));

// kpi4
var chartSpeed = Highcharts.chart('kpi4', Highcharts.merge(gaugeOptions, {
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: $kpi4
    }
  },

  credits: {
    enabled: false
  },

  series: [{
    name: 'Speed',
    data: [$percent4],
    dataLabels: {
      format: '<div style="text-align:center"><span style="font-size:25px;color:' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
           '<span style="font-size:12px;color:silver">%</span></div>'
    },
    tooltip: {
      valueSuffix: '%'
    }
  }]

}));

// kpi5
var chartSpeed = Highcharts.chart('kpi5', Highcharts.merge(gaugeOptions, {
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: $kpi5
    }
  },

  credits: {
    enabled: false
  },

  series: [{
    name: 'Speed',
    data: [$percent5],
    dataLabels: {
      format: '<div style="text-align:center"><span style="font-size:25px;color:' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
           '<span style="font-size:12px;color:silver">%</span></div>'
    },
    tooltip: {
      valueSuffix: '%'
    }
  }]

}));

// kpi6
var chartSpeed = Highcharts.chart('kpi6', Highcharts.merge(gaugeOptions, {
  yAxis: {
    min: 0,
    max: 100,
    title: {
      text: $kpi6
    }
  },

  credits: {
    enabled: false
  },

  series: [{
    name: 'Speed',
    data: [$percent6],
    dataLabels: {
      format: '<div style="text-align:center"><span style="font-size:25px;color:' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
           '<span style="font-size:12px;color:silver">%</span></div>'
    },
    tooltip: {
      valueSuffix: '%'
    }
  }]

}));

// The RPM gauge
var chartRpm = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
  yAxis: {
    min: 0,
    max: 5,
    title: {
      text: 'RPM'
    }
  },

  series: [{
    name: 'RPM',
    data: [1],
    dataLabels: {
      format: '<div style="text-align:center"><span style="font-size:25px;color:' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
           '<span style="font-size:12px;color:silver">* 1000 / min</span></div>'
    },
    tooltip: {
      valueSuffix: ' revolutions/min'
    }
  }]

}));

// Bring life to the dials
setInterval(function () {
  // Speed
  var point,
    newVal,
    inc;

  if (chartSpeed) {
    point = chartSpeed.series[0].points[0];
    inc = Math.round((Math.random() - 0.5) * 100);
    newVal = point.y + inc;

    if (newVal < 0 || newVal > 200) {
      newVal = point.y - inc;
    }

    point.update(newVal);
  }

  // RPM
  if (chartRpm) {
    point = chartRpm.series[0].points[0];
    inc = Math.random() - 0.5;
    newVal = point.y + inc;

    if (newVal < 0 || newVal > 5) {
      newVal = point.y - inc;
    }

    point.update(newVal);
  }
}, 2000);         
      
JS;
    $this->registerJs($js);
    ?>

    <script>
        var mymap = L.map('mapid').setView([13.850301, 100.529272], 7);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ' &copy; <a href="http://openstreetmap.org">' +
                    ' OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(mymap);


        var areaLayer1;
        var listDataLayer1;
        var geojsonLayer1;
        var areaLayer2;
        var listDataLayer2;
        var geojsonLayer2;
        var areaLayer3;
        var listDataLayer3;
        var geojsonLayer3;
        var areaLayer4;
        var listDataLayer4;
        var geojsonLayer4;
        var listDataLayer5;
        var listMarkerLayer1 = new Array();
        var listMarkerLayer2 = new Array();
        var listMarkerLayer3 = new Array();
        var listMarkerLayer4 = new Array();
        var backButton;
        $.ajax({
            type: "get",
            url: "http://opendata.service.moph.go.th/gis/v1/geojson/3/57",
            async: false,
            success: function (response) {
                console.log(response);
                areaLayer1 = response;
            }
        });
        $.ajax({
            type: "get",
            url: "http://61.19.32.29/api/web/dspm",
            async: false,
            success: function (response) {
                console.log(response);
                listDataLayer1 = response;
            }
        });
        function getDataLayer1(id) {
            var result;
            listDataLayer1.forEach(function (data) {
                if (id == data.id) {
                    result = data.data;
                }
            });
            return result;
        }

        function getDataLayer2(id) {
            var result;
            listDataLayer2.forEach(function (data) {
                if (id == data.id) {
                    result = data.data;
                }
            });
            return result;
        }

        function getDataLayer3(id) {
            var result;
            listDataLayer3.forEach(function (data) {
                if (id == data.id) {
                    result = data.data;
                }
            });
            return result;
        }

        function getDataLayer4(id) {
            var result;
            listDataLayer4.forEach(function (data) {
                if (id == data.id) {
                    result = data.data;
                }
            });
            return result;
        }

        function getColor(d) {
            return d >= 95 ? 'green' :
                    d >= 60 ? 'orange ' :
                    d >= 40 ? 'yellow' :
                    'red';
        }

        function getDataHopital(hoscode) {
            var result;
            listDataLayer5.forEach(function (data) {
                if (hoscode == data.hoscode) {
                    result = data.data;
                }
            });
            return result;
        }

        function getMarker(feature) {
            return L.AwesomeMarkers.icon({
                markerColor: getColor(getDataHopital(feature.properties.hoscode)),
                icon: 'hospital-o',
                prefix: 'fa',
            });
        }

        function styleLayer1(feature) {
            var id = feature.properties.id;
            return {
                fillColor: getColor(getDataLayer1(id)),
                fillOpacity: 0.5,
                color: '#00FF00',
                opacity: 0.8,
                weight: 1,
                dashArray: 3
            }
        }

        function styleLayer2(feature) {
            var id = feature.properties.id;
            return {
                fillColor: getColor(getDataLayer2(id)),
                fillOpacity: 0.5,
                color: '#00FF00',
                opacity: 0.8,
                weight: 1,
                dashArray: 3
            }
        }

        function styleLayer3(feature) {
            var id = feature.properties.id;
            return {
                fillColor: getColor(getDataLayer3(id)),
                fillOpacity: 0.5,
                color: '#00FF00',
                opacity: 0.8,
                weight: 1,
                dashArray: 3
            }
        }

        function styleLayer4(feature) {
            var id = feature.properties.id;
            return {
                fillColor: getColor(getDataLayer4(id)),
                fillOpacity: 0.5,
                color: '#00FF00',
                opacity: 0.8,
                weight: 1,
                dashArray: 3
            }
        }

        function highlightFeature(e) {
            var layer = e.target;
            var properties = layer.feature.properties;
            if (mymap.hasLayer(geojsonLayer4)) {
                properties.data = getDataLayer4(properties.id);
            } else if (mymap.hasLayer(geojsonLayer3)) {
                properties.data = getDataLayer3(properties.id);
            } else if (mymap.hasLayer(geojsonLayer2)) {
                properties.data = getDataLayer2(properties.id);
            } else {
                properties.data = getDataLayer1(properties.id);
            }

            info.update(properties);
            layer.setStyle({
                fillOpacity: 0.8,
                weight: 3
            });
        }

        function resetHighlight(e) {
            if (mymap.hasLayer(geojsonLayer4)) {
                geojsonLayer4.resetStyle(e.target);
            } else if (mymap.hasLayer(geojsonLayer3)) {
                geojsonLayer3.resetStyle(e.target);
            } else if (mymap.hasLayer(geojsonLayer2)) {
                geojsonLayer2.resetStyle(e.target);
            } else {
                geojsonLayer1.resetStyle(e.target);
            }
            info.update();
        }

        function clickLayer1(e) {
            listMarkerLayer1.forEach(function (marker) {
                mymap.removeLayer(marker);
            });
            backButton.addTo(mymap);
            var id = e.target.feature.properties.id;
            $.ajax({
                type: "get",
                url: "http://opendata.service.moph.go.th/gis/v1/geojson/5/" + id,
                async: false,
                success: function (response) {
                    console.log(response);
                    areaLayer2 = response;
                }
            });
            $.ajax({
                type: "get",
                url: "http://61.19.32.29/api/web/dspmt",
                async: false,
                success: function (response) {
                    console.log(response);
                    listDataLayer2 = response;
                }
            });
            geojsonLayer2 = L.geoJSON(areaLayer2, {
                style: styleLayer2,
                onEachFeature: onEachFeatureLayer2
            }).addTo(mymap);
            mymap.fitBounds(geojsonLayer2.getBounds());
            mymap.removeLayer(geojsonLayer1);
            var provcode = id.substr(0, 2);
            var distcode = id.substr(2, 2);
            var hospitalLayer4;
            $.ajax({
                type: "get",
                url: `http://opendata.service.moph.go.th/gis/v1/getgis/provcode/${provcode}/distcode/${distcode}`,
                async: false,
                success: function (response) {
                    console.log(response);
                    hospitalLayer4 = response;
                }
            });
            $.ajax({
                type: "get",
                url: "http://61.19.32.29/api/web/dspms",
                async: false,
                success: function (response) {
                    console.log(response);
                    listDataLayer5 = response;
                }
            });
            function onEachFeature(feature, layer) {
                layer.bindPopup(feature.properties.hosname);
            }

            hopitalPointLayer = L.geoJSON(hospitalLayer4, {
                pointToLayer: function (feature, latlng) {
                    return L.marker(latlng, {
                        icon: getMarker(feature)

                    });
                },
                onEachFeature: onEachFeature
            }).addTo(mymap);
        }



        function clickLayer2(e) {
            listMarkerLayer2.forEach(function (marker) {
                mymap.removeLayer(marker);
            });
            // #1
            var id = e.target.feature.properties.id;
            $.ajax({
                type: "get",
                url: "http://opendata.service.moph.go.th/gis/v1/geojson/5/" + id, // #2
                async: false,
                success: function (response) {
                    console.log(response);
                    areaLayer3 = response; // #4
                }
            });
            // #5
            $.ajax({
                type: "get",
                url: "http://61.19.32.29/api/web/dspmt", // #6
                async: false,
                success: function (response) {
                    console.log(response);
                    listDataLayer3 = response; // #7
                }
            });
            // #8



            geojsonLayer3 = L.geoJSON(areaLayer3, {
                style: styleLayer3,
                onEachFeature: onEachFeatureLayer3
            }).addTo(mymap);
            mymap.fitBounds(geojsonLayer3.getBounds()); //#9
            mymap.removeLayer(geojsonLayer2);
            mymap.removeLayer(hopitalPointLayer);
        }

        function clickLayer3(e) {
            listMarkerLayer3.forEach(function (marker) {
                mymap.removeLayer(marker);
            });
            var id = e.target.feature.properties.id;
            $.ajax({
                type: "get",
                url: "http://opendata.service.moph.go.th/gis/v1/geojson/5/" + id, // #2
                async: false,
                success: function (response) {
                    console.log(response);
                    areaLayer4 = response;
                }
            });
            $.ajax({
                type: "get",
                url: "http://61.19.32.29/api/web/dspmt", // #6
                async: false,
                success: function (response) {
                    console.log(response);
                    listDataLayer4 = response; // #7
                }
            });
            geojsonLayer4 = L.geoJSON(areaLayer4, {
                style: styleLayer4,
                onEachFeature: onEachFeatureLayer4
            }).addTo(mymap);
            mymap.removeLayer(geojsonLayer3);
            mymap.fitBounds(geojsonLayer4.getBounds());
        }



        function onEachFeatureLayer1(feature, layer) {
            var center = layer.getBounds().getCenter(); // #1
            var marker = L.circle(center, {// #2
                radius: 0,
                weight: 0
            })
                    .bindTooltip("<b>" + feature.properties.name + "</b>", {// #3
                        permanent: true, // #4 
                        direction: 'center', // #5
                        className: 'my-leaflet-tooltip' // #6
                    })
                    .addTo(mymap); // #7
            listMarkerLayer1.push(marker); // #8

            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: clickLayer1
            });
        }

        function onEachFeatureLayer2(feature, layer) {
            var center = layer.getBounds().getCenter(); // #1
            var marker = L.circle(center, {// #2
                radius: 0,
                weight: 0
            })
                    .bindTooltip("<b>" + feature.properties.name + "</b>", {// #3
                        permanent: true, // #4 
                        direction: 'center', // #5
                        className: 'my-leaflet-tooltip' // #6
                    })
                    .addTo(mymap); // #7
            listMarkerLayer2.push(marker); // #8

            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: clickLayer2
            });
        }

        function onEachFeatureLayer3(feature, layer) {
            var center = layer.getBounds().getCenter(); // #1
            var marker = L.circle(center, {// #2
                radius: 0,
                weight: 0
            })
                    .bindTooltip("<b>" + feature.properties.name + "</b>", {// #3
                        permanent: true, // #4 
                        direction: 'center', // #5
                        className: 'my-leaflet-tooltip' // #6
                    })
                    .addTo(mymap); // #7
            listMarkerLayer3.push(marker); // #8
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: clickLayer3
            });
        }

        function onEachFeatureLayer4(feature, layer) {
            var center = layer.getBounds().getCenter(); // #1
            var marker = L.circle(center, {// #2
                radius: 0,
                weight: 0
            })
                    .bindTooltip("<b>" + feature.properties.name + "</b>", {// #3
                        permanent: true, // #4 
                        direction: 'center', // #5
                        className: 'my-leaflet-tooltip' // #6
                    })
                    .addTo(mymap); // #7
            listMarkerLayer4.push(marker); // #8

            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight
            });
        }

        function addMarkerLayer(listMarkerLayer) {
            listMarkerLayer.forEach(function (marker) {
                mymap.addLayer(marker);
            });
        }

        function removeMarkerLayer(listMarkerLayer) {
            listMarkerLayer.forEach(function (marker) {
                mymap.removeLayer(marker);
            });
        }

        geojsonLayer1 = L.geoJSON(areaLayer1, {
            style: styleLayer1,
            onEachFeature: onEachFeatureLayer1
        }).addTo(mymap);
        mymap.fitBounds(geojsonLayer1.getBounds());
        backButton = L.easyButton('fa-arrow-left', function (btn, map) {
            if (mymap.hasLayer(geojsonLayer4)) {
                listMarkerLayer4.forEach(function (marker) {
                    mymap.removeLayer(marker);
                });
                listMarkerLayer3.forEach(function (marker) {
                    mymap.addLayer(marker);
                });
                mymap.removeLayer(geojsonLayer4);
                mymap.addLayer(geojsonLayer3);
                mymap.fitBounds(geojsonLayer3.getBounds());
            } else if (mymap.hasLayer(geojsonLayer3)) {
                listMarkerLayer2.forEach(function (marker) {
                    mymap.addLayer(marker);
                });
                listMarkerLayer3.forEach(function (marker) {
                    mymap.removeLayer(marker);
                });
                mymap.removeLayer(geojsonLayer3);
                mymap.addLayer(geojsonLayer2);
                mymap.addLayer(hopitalPointLayer);
                mymap.fitBounds(geojsonLayer2.getBounds());
            } else {
                listMarkerLayer1.forEach(function (marker) {
                    mymap.addLayer(marker);
                });
                listMarkerLayer2.forEach(function (marker) {
                    mymap.removeLayer(marker);
                });
                backButton.removeFrom(mymap);
                mymap.removeLayer(geojsonLayer2);
                mymap.removeLayer(hopitalPointLayer);
                mymap.addLayer(geojsonLayer1);
                mymap.fitBounds(geojsonLayer1.getBounds());
            }
        });
        var legend = L.control({
            position: 'bottomright'
        });
        legend.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info legend');
            div.innerHTML = '<i style="background:' + getColor(0) + '"></i>0-40<br>' +
                    '<i style="background:' + getColor(40) + '"></i>40-60<br>' +
                    '<i style="background:' + getColor(60) + '"></i>60-94<br>' +
                    '<i style="background:' + getColor(95) + '"></i>95-100<br>';
            return div;
        };
        legend.addTo(mymap);
        var info = L.control();
        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        }

        info.update = function (props) {
            this._div.innerHTML = '<h6>MOPH KPI' + (props ?
                    '<b>' + props.name + '</b><br />' + props.data :
                    'เลื่อนเมาส์(Mouse Over)ไปบนแผนที่');
        }

        info.addTo(mymap);
    </script>

</body>
</html>