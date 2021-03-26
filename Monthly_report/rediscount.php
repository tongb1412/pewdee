<?php 
include('../class/config.php');
$branch_id = $_SESSION['branch_id'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main_monthly" class="tmain h-100">
	<div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานส่วนลด 100%</div>
	<?php
	if ($_SESSION['company_data'] == "1") {
	?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:16%; background-color:#FFCC99; border:<?= $tabcolor ?> 1px solid;">
			<div class="line" style="margin-top:5px; width:100%;">
				<div class="line-item title">วันที่ : </div>
				<div class="line-item">&nbsp;<input type="text" id="sdate" size="6" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
				<div class="line-item">
					<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
					<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
				</div>

				<div class="line-item title">ถึง : </div>
				<div class="line-item">&nbsp;<input type="text" id="edate" size="6" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
				<div class="line-item">
					<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
					<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
				</div>
				<div class="line-item title">เลือกสาขา : </div>
				<div class="line-item">
					<?php
					$sql = "select branchid,branchname from tb_branch ";
					$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
					?>
					<select name="select" id="branchid" style="width:100px;" onchange="doctor_list(this)">
						<option value="00">ทั้งหมด</option>
						<?php while ($rs = mysql_fetch_array($result)) {  ?>
							<option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="line-item title">แพทย์ : </div>
					<?
						$sql = "select staffid,pname,fname from tb_staff where typ='D' and branchid = '$branch_id' ORDER BY fname";
						$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
						?>

					<div class="line-item">&nbsp;&nbsp;
						<select name="select" id="repempid" style="width:90px;">
							<option value="">ทั้งหมด</option>
							<option value="00">ไม่ระบุแพทย์</option>
							<? while($rs=mysql_fetch_array($result)){  ?>
							<option value="<?= $rs['staffid'] ?>"> <?= $rs['pname'] . $rs['fname'] ?></option>
							<? } ?>
						</select>
					</div>
			</div>


			<div class="line" style="width:95%;float:left;margin-top:20px; margin-left:2%;">
				<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpayment('Monthly_report/rediscount_list.php','d_list')" value="แสดงรายงาน" />
				<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthpayment('Monthly_report/rep_discount.php?')" value="พิมพ์รายงาน" />
				<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value="Excel" />
			</div>
		</div>



	<?php
	} else {
	?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; border:<?= $tabcolor ?> 1px solid;">
			<div class="line" style="margin-top:5px; width:60%;">
				<div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">วันที่ : </div>
				<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="6" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
				<div style="width:3%; float:left; margin-top:10px;">
					<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
					<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
				</div>

				<div style="width:7%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">ถึง : </div>
				<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="6" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
				<div style="width:3%; float:left; margin-top:10px;">
					<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
					<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
				</div>
			
				<div style="width:14%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">แพทย์ : </div>
				<?
					$sql = "select staffid,pname,fname from tb_staff where typ='D' and branchid = '$branch_id'";
					$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
					?>

				<div style="width:25%; float:left; margin-top:10px; font-size:14px; ">&nbsp;&nbsp;
					<select name="select" id="repempid" style="width:90px;">
						<option value="">ทั้งหมด</option>
						<option value="00">ไม่ระบุแพทย์</option>
						<? while($rs=mysql_fetch_array($result)){  ?>
						<option value="<?= $rs['staffid'] ?>"> <?= $rs['pname'] . $rs['fname'] ?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div style="width:40%; float:left;margin-top:10px;">
				<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpayment('Monthly_report/rediscount_list.php','d_list')" value="แสดงรายงาน" />
				<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthpayment('Monthly_report/rep_discount.php?')" value="พิมพ์รายงาน" />
				<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value="Excel" />
			</div>
		</div>


	<?php
	}

	?>

	<div id="d_list" style="width:100%; height:395px; margin-top:5px; margin-left:10px; float:left;  border:<?= $tabcolor ?> 1px solid;">
		<? require("rediscount_list.php"); ?>
	</div>
</div>