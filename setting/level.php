<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="velid" value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
	<div class="littleDD" style="font-size:14px; font-weight:bold;">ระดับคนไข้</div>
	<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:28%; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
		<div class="line" style="margin-top:5px">

			<div style="width:20%; float:left; text-align:right; line-height:20px;">ระดับคนไข้ : </div>
			<div style="width:75%; float:left;">&nbsp;<input type="text" id="velname" size="50"> </div>
		</div>
		<div class="line " style="height:10px" ;>&nbsp;</div>
		<div class="line">
			<div style="width:20%; float:left; text-align:right; line-height:20px;">ส่วนลดยา : </div>
			<div style="width:15%; float:left;">&nbsp;<input type="text" id="disdrug" size="8" value="0">&nbsp;% </div>
			<div style="width:19%; float:left; text-align:right; line-height:20px;">ส่วนลดแล็บ/หัตถการ : </div>
			<div style="width:15%; float:left;">&nbsp;<input type="text" id="dislab" size="8" value="0">&nbsp;% </div>
			<div style="width:14%; float:left; text-align:right; line-height:20px;">ส่วนลดเลเซอร์ : </div>
			<div style="width:15%; float:left;">&nbsp;<input type="text" id="dislaser" size="8" value="0">&nbsp;% </div>
		</div>
		<div class="line">
			<div style="width:20%; float:left; text-align:right; line-height:20px;">ส่วนลดทรีทเม้นท์ : </div>
			<div style="width:15%; float:left;">&nbsp;<input type="text" id="distr" size="8" value="0">&nbsp;% </div>
			<div style="width:19%; float:left; text-align:right; line-height:20px;">ส่วนลดคอร์ท : </div>
			<div style="width:15%; float:left;">&nbsp;<input type="text" id="disco" size="8" value="0">&nbsp;% </div>
			<div style="width:14%; float:left; text-align:right; line-height:20px;">ส่วนลดแพ็คเกจ : </div>
			<div style="width:15%; float:left;">&nbsp;<input type="text" id="dispg" size="8" value="0">&nbsp;% </div>
		</div>
		<div class="line" style="height:15px;">&nbsp;</div>
		<div class="line">
			<div style="width:70%; float:left; text-align:right;">&nbsp;</div>
			<div style="width:30%; float:left;">
				<input type="button" value="  เพิ่มรายการ  " style="font-size:12px; font-weight:bold; height:28px;" onclick="addlevel('setting/level_add.php','d_list')" />
				<input type="button" value="  รายการใหม่  " style="font-size:12px; font-weight:bold; height:28px;" onclick="ajaxLoad('post','setting/level.php','','settingpage')" />
			</div>
		</div>
	</div>

	<div style="width:95%; margin-top:5px; margin-left:20px; text-align:left; height:60%; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
		<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
			<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ระดับคนไข้</div>
			<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลดยา</div>
			<div style="width:17%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลดแล็บ/หัตถการ</div>
			<div style="width:13%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลดเลเซอร์</div>
			<div style="width:13%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลดทรีทเม้นท์</div>
			<div style="width:13%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลดคอร์ท</div>
			<div style="width:13%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลดแพ็คเกจ</div>
		</div>

		<div id="d_list" style=" width:98%; margin-top:5px; text-align:center; height:auto;">
			<?  require("level_list.php");	 ?>
		</div>



	</div>



</div>