<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="id"  value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
		<div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานรายได้ทั้งหมด</div>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; overflow:auto; border:<?=$tabcolor?> 1px solid;">
			<div class="line" style="margin-top:5px">
			   
				<div style="width:20%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่  :  </div>
				<div style="width:30%; float:left; margin-top:10px; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;<?= date('d/m/Y',time());?> </div>
				<div style="width:30%; float:left;"> <input type="button" value="  พิมพ์รายงาน  " style="font-size:14px; font-weight:bold; height:28px;" onclick="" /></div>
			</div>
			
				
		</div>
		
		<div   style="width:95%; margin-top:5px; margin-left:20px; text-align:left; height:80%; overflow:auto; border:<?=$tabcolor?> 1px solid;">
<!--		<div class="txt_serch">
			<input class="input_serch" type="text" id="txts" size="41" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('daily_report/repatient_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','stock/druge_list.php','txt=','p_list')" />
		</div>-->
			<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; overflow:auto; font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
				<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
				<div style="width:40%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค่ายา</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค่่าหัตถการ/แล็บ</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ทรีทเมนท์/เลเซอร์</div>

			</div>
			
			<div id="d_list" style=" width:98%; margin-top:5px; text-align:center; height:300px; overflow:auto;">
				<?  require("repayment_list.php");	 ?>
			</div>
			

		
		</div>

		
		
</div>