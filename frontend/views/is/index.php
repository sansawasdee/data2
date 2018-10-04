<?php
use yii\helpers\Html;
$this->title = 'IS ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-group">
    <a href="#" class="list-group-item active"> ระบบรายงาน    </a>
	<a href="?r=is/summary" class="list-group-item"> 
        <span class="fa fa-calendar-plus-o" aria-hidden="true"></span> 
        สรุปการส่งข้อมูล IS รายสถานบริการ</a>
    <a href="?r=is/c19" class="list-group-item"> 
        <span class="fa fa-calendar-plus-o" aria-hidden="true"></span> 
        จำนวนของการบาดเจ็บและตายของผู้ป่วยนอก จำแนกตาม 19 สาเหตุ </a>
	<a href="?r=is/c19ptin" class="list-group-item"> 
        <span class="fa fa-calendar-plus-o" aria-hidden="true"></span> 
        จำนวนของการบาดเจ็บและตายของผู้ป่วยใน จำแนกตาม 19 สาเหตุ </a>
	<a href="?r=is/cause1" class="list-group-item"> 
        <span class="fa fa-calendar-plus-o" aria-hidden="true"></span> 
        จำนวนผู้บาดเจ็บและตายจากอุบัติเหตุการขนส่ง จำแนกตามพาหนะและประเภทของผู้บาดเจ็บ </a>
	
    
</div>
<div>
<h4>
<span class="label label-warning">หมายเหตุ:</span>
<span class="label label-success"> ข้อมูลจากฐานข้อมูล IS สำนักระบาด </span> </h4>
</div>
