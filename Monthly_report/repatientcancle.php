<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
	<div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานคนไข้ยกเลิก</div>
	<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99;  border:<?= $tabcolor ?> 1px solid;">
		<div class="line" style="margin-top:5px; width:60%;">
			<!--     <div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">ระหว่างวันที่ : </div>
      <div style="width:30%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="10" maxlength="10" onkeyup="forDate(this)"   /></div>
	  <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">ถึง : </div>
      <div style="width:30%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="10" maxlength="10" onkeyup="forDate(this)"   /></div> -->

			<div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">ระหว่างวันที่ : </div>
			<div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="9.5" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
			<div style="width:3%; float:left; margin-top:10px;">
				<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
				<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
			</div>

			<div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">ถึง : </div>
			<div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="9.5" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
			<div style="width:3%; float:left; margin-top:10px;">
				<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
				<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
			</div>

		</div>

		<?php 
			if ($_SESSION['branch_id'] == "" || $_SESSION['branch_id'] == "07") {
				?>
				<div style="width:10%; float:left; margin-top:16px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">เลือกสาขา : </div>
			
				<div style="width:20%; float:left; margin-top:16px;  ">&nbsp;&nbsp;
				<?php
					$sql = "select branchid,branchname from tb_branch ";
				$result = mysql_query($sql) or die("Error Query [".$sql."]"); ?>
				<select name="select" id="branchid" style="width:117px;height: 21px;">
					<option value="00">ทั้งหมด</option>
					<?php while ($rs=mysql_fetch_array($result)) {  ?>
					<option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
					<?php } ?>
				</select>
				</div>
		<?php
			}else { 
				echo " <input type='hidden' id='branchid' value ='' />";
			}
		?>
		<div style="width:40%; float:left;margin-top:10px;">
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpatient('Monthly_report/repatientcancle_list.php','pa_list')" value=" แสดงรายงาน " />
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonth('Monthly_report/re_patientcancle.php?')" value=" พิมพ์รายงาน " />
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value=" Excel " />
		</div>
	</div>



	<div id="pa_list" style="width:98%; height:395px; margin-top:5px; margin-left:10px; float:left;  border:<?= $tabcolor ?> 1px solid;">
		<?  require("repatientcancle_list.php");	 ?>


	</div>
</div>