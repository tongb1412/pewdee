<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<!-- <div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;"> -->
<div id="t_main_monthly" class="tmain h-100">
	<div class="littleDD" style="font-size:14px; font-weight:bold;">ค่าใช้จ่าย</div>
	<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:28%; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
		<div class="line" style="margin-top:5px">

			<div style="width:20%; float:left; text-align:right; line-height:20px;">วันที่ : </div>
			<div style="width:75%; float:left; " id='date'>&nbsp;<?= date('d/m/Y H:i', time()); ?> </div>
		</div>
		<div class="line" style="height: 10px;" >&nbsp;</div>
		<div class="line">
			<div style="width:20%; float:left; text-align:right; line-height:20px;">รายการค่าใช้จ่าย : </div>
			<div style="float:left;">&nbsp;<input type="text" id="name" size="30" value="">&nbsp; </div>
			<div style="width:10%; float:left; text-align:right; line-height:20px;">จำนวน : </div>
			<div style="float:left;">&nbsp;<input type="text" id="unit" size="10" value="0">&nbsp; </div>

		</div>
		<div class="line">

			<div style="width:20%; float:left; text-align:right; line-height:20px;">ราคาต่อหน่วย : </div>
			<div style="width:20%; float:left;">&nbsp;<input type="text" id="price" size="10" value="0">&nbsp; </div>
			<div style="width:20%; float:left; text-align:right; line-height:20px; margin-left: 4.1%">ราคารวม : </div>
			<div style="width:15%; float:left;">&nbsp;<input type="text" id="total" size="10" value="0">&nbsp; </div>
		</div>
		<div class="line" style="height:15px;">&nbsp;</div>
		<div class="line">
			<div style="width:70%; float:left; text-align:right;">&nbsp;</div>
			<div style="width:30%; float:left;">
				<input type="button" value="  เพิ่มรายการ  " style="font-size:12px; font-weight:bold; height:28px;" onclick="addcosts('setting/costs_add.php','d_list')" />
				<input type="button" value="  รายการใหม่  " style="font-size:12px; font-weight:bold; height:28px;" onclick="ajaxLoad('post','setting/costs.php','','t_main')" />
			</div>
		</div>
	</div>

	<div style="width:95%; margin-top:5px; margin-left:20px; text-align:left; height:60%; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
		<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
			<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
			<div style="width:50%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
			<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
			<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคาต่อหน่วย</div>
			<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคารวม</div>

		</div>

		<div id="d_list" style=" width:98%; margin-top:5px; text-align:center; height:auto;">
			<?  require("costs_list.php");	 ?>
		</div>



	</div>



</div>