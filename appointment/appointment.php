<?
$url = 'list_1.php'; $dis = ''; $dis1 = 'none';
if($_GET['pmode']=='Y'){
	$url = 'new_form.php';
	$dis = 'none'; $dis1 = '';
}
?>

<div style="width:99%; margin:auto; height:25px;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
	<img src="images/icon/group.png" align="absmiddle" />&nbsp;ตารางนัด
	</div>
	<div style="width:80%; text-align:right; float:left; line-height:20px;">
	<input type="button" value="  รายการนัดทั้งหมด  " onclick="loadmodule('home','appointment/appointment.php','')" style="height:25px; font-size:13px; line-height:25px;" />	
    <input type="button" value="  เพิ่มรายการใหม่  " onclick="cleartabreg(6,4,7,'appointment/new_form.php','content','')" style="height:25px; font-size:13px; line-height:25px;" />	
	</div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
<div class="littleDD" >
	<div id="tab1" class="tab" style="width:150px; background-color:#FFFFFF; display:<?=$dis?>;">
	<a href="javascript: loadpage('content',1,4,'appointment/list_1.php')">รายการนัดทั้งหมด</a>
	</div>
	<div id="tab2" class="tab" style="width:150px; display:<?=$dis?>;">
	<a href="javascript: loadpage('content',2,4,'appointment/list_2.php')">รายการจองทั้งหมด</a>
	</div>
	<div id="tab3" class="tab" style="width:150px; display:none;">
	<a href="javascript: loadpage('content',3,4,'appointment/list_3.php')">ตารางนัดแบบที่ 2</a>
	</div>	
	<div id="tab4" class="tab" style="width:100px; display:none;">
	<a href="javascript: loadpage('content',4,4,'')">เพิ่ม</a>
	</div>
	
	<div id="tab5" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
	ข้อมูลทั่วไป
	</div>
	<div id="tab6" class="tab" style="width:150px; background-color:#FFFFFF; display:<?=$dis1?>; line-height:30px;">
	เพิ่มรายการใหม่
	</div>
	<div id="tab7" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
	ข้อมูล
	</div>	
</div>

<div id="content" style=" width:100%; margin-top:5px; text-align:center; height:auto;">

<? include($url); ?>

</div>


</div>