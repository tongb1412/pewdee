<?php
include('../class/config.php');


if(!empty($_SESSION['company_data'])){
	$company_data = $_SESSION['company_data'];
	$style = "full";
} else {
	$style = "small";
}

$branch_id = "";
if(!empty($_SESSION['branch_id'])){
	$branch_id = $_SESSION['branch_id'];
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main" class="tmain h-100" >
	<div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานรายได้ทั้งหมด</div>
	<?php
	if($_SESSION['company_data'] == "1") {
		?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:16%; background-color:#FFCC99;  border:<?= $tabcolor ?> 1px solid;">
			<div class="line" style="margin-top:5px; width:95%;">
				<div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">วันที่ : </div>
				<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input class="datepicker" type="text" id="sdate" size="10" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
				<div style="width:3%; float:left; margin-top:10px;">
					<!-- <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" /> -->
					<!-- <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
					<img src="calendar/calendar.jpg" width="15" onclick="clickCalendar('sdate')" style="margin-top:5px; cursor:pointer;" />
				</div>
				<div style="width:8%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">ถึง : </div>
				<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input class="datepicker" type="text" id="edate" size="10" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
				<div style="width:3%; float:left; margin-top:10px;">
					<!-- <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer; " /> -->
					<!-- <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
					<img src="calendar/calendar.jpg" width="15" onclick="clickCalendar('edate')" style="margin-top:5px; cursor:pointer;" />
				</div>
				<?php
				if ($_SESSION['company_data'] == "1") {
				?>
					<div style="width:15%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">เลือกสาขา : </div>
					<div style="width:20%; float:left; margin-top:1%; font-size:14px; ">&nbsp;&nbsp;
						<?php
						$sql = "select branchid,branchname from tb_branch ";
						$result = mysql_query($sql) or die("Error Query [" . $sql . "]"); ?>
						<select name="select" id="branchid" style="width:117px;" onchange="doctor_list(this)">
							<option value="00">ทั้งหมด</option>
							<?php while ($rs = mysql_fetch_array($result)) {  ?>
								<option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
							<?php } ?>
						</select>
					</div>
				<?php
				} else {
					echo " <input type=\"hidden\" id=\"branchid\" value=\"" . $_SESSION['branch_id'] . "\">";
				}
				?>
			</div>
			<div class="line" style="margin-top:5px; width:95%;">
				<div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; " >แพทย์ : </div>
				<?
					if($_SESSION['company_data'] != "1"){
						$sql = "select staffid,pname,fname from tb_staff where typ='D' and branchid = '$branch_id' ORDER BY fname";
					} else {
						$sql = "select staffid,pname,fname from tb_staff where typ='D' ORDER BY fname";
					}
						$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
					?>
				<div style="width:25%; float:left; margin-top:10px; font-size:14px; ">&nbsp;&nbsp;
					<select name="select" id="repempid" style="width:143px;" >
						<option value="">ทั้งหมด</option>
						<option value="00">ไม่ระบุแพทย์</option>
						<? while($rs = mysql_fetch_array($result)){  ?>
							<option value="<?= $rs['staffid'] ?>"> <?= $rs['pname'] . $rs['fname'] ?></option>
						<? } ?>
					</select>
				</div>
				<div style="float:left; margin-top:10px; font-size:14px;">
					<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpayment('Monthly_report/repayment_list.php','d_list')" value="แสดงรายงาน" />
					<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthpayment('Monthly_report/rep_paymenttotal.php?')" value="พิมพ์รายงาน" />
					<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value="Excel" />
				</div>
			</div>
		</div>
	<?php
	} else {
		?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99;  border:<?= $tabcolor ?> 1px solid;">
		<div class="line" style="margin-top:5px;width:60%;">
			<div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">วันที่ : </div>
			<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input class="datepicker" type="text" id="sdate" size="5" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
			<div style="width:3%; float:left; margin-top:10px;">
				<!-- <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" /> -->
				<!-- <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
				<img src="calendar/calendar.jpg" width="15" onclick="clickCalendar('sdate')" style="margin-top:5px; cursor:pointer;" />
			</div>
			<div style="width:8%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">ถึง : </div>
			<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input class="datepicker" type="text" id="edate" size="5" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
			<div style="width:3%; float:left; margin-top:10px;">
				<!-- <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer; " /> -->
				<!-- <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
				<img src="calendar/calendar.jpg" width="15" onclick="clickCalendar('edate')" style="margin-top:5px; cursor:pointer;" />
			</div>
			<div style="width:12%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">แพทย์ : </div>
			<?
				$sql = "select staffid,pname,fname from tb_staff where typ='D' ";
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
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpayment('Monthly_report/repayment_list.php','d_list')" value="แสดงรายงาน" />
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthpayment('Monthly_report/rep_paymenttotal.php?')" value="พิมพ์รายงาน" />
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value="Excel" />
		</div>
	</div>
	<?php
	}
	?>


	<div id="d_list" style="width:98%; height:395px; margin-top:5px; margin-left:10px; float:left;  border:<?= $tabcolor ?> 1px solid;">
		<? require("repayment_list.php"); ?>
	</div>
</div>