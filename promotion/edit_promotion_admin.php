<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');
$PID = $_POST['pid'];
$sql = "select * from promotion where proid='$PID'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row = mysql_fetch_array($patient_result);

$dat = $row['datestart'];
$dat1 = $row['datestop'];

// $dat = substr($row['datestart'],8,2).'-'.substr($row['datestart'],5,2).'-'.substr($row['datestart'],0,4);
// $dat1 = substr($row['datestop'],8,2).'-'.substr($row['datestop'],5,2).'-'.substr($row['datestop'],0,4);

$branch_name = get_branch_name($row['branchid'],$_SESSION['company_code']);
?>

<div class="line">&nbsp;</div>
<input type="hidden" id="typ" value="edit" />

<div class="line">
	<div style="width:25%; float:left; text-align:right;">รหัสโปรโมชั่น :&nbsp;</div>
	<div style="width:25%; float:left;">
		<input name="text2" type="text" id="proid" size="30" value="<?= $PID ?>" />
	</div>
</div>

<div class="line">
	<div style="width:25%; float:left; text-align:right;">ชื่อโปรโมชั่น:&nbsp;</div>
	<div style="width:25%; float:left;">
		<input name="text2" type="text" id="proname" size="40" value="<?= $row['proname'] ?>" />
	</div>
</div>

<div class="line">

	<div style="width:25%; float:left; text-align:right;">วันที่เริ่ม :&nbsp;</div>
	<div style="width:20%; float:left;">
		<input type="text" id="dat" size="11" class="datepicker" readonly="readonly" value="<?= $dat ?>" />
	</div>
	<div style="width:3%; float:left;">
		<!-- <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','dat','cl1')" style="margin-top:5px; cursor:pointer;" /> -->
		<!-- <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
	</div>

	<div style="width:15%; float:left; text-align:right; margin-left:5%">วันที่หมด :&nbsp;</div>
	<div style="width:20%; float:left;">
		<input type="text" id="dat1" size="11" class="datepicker-end" readonly="readonly" value="<?= $dat1 ?>" />
	</div>
	<div style="width:3%; float:left;">
		<!-- <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','dat1','cl')" style="margin-top:5px; cursor:pointer;" /> -->
		<!-- <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
	</div>


</div>

<div class="line">
	<?php
	if ($_SESSION['company_data'] == "1") {
	?>
		<div style="width:25%; float:left; text-align:right;">เลือกสาขา :&nbsp;</div>
		<div style="width:18%; float:left;">
		<input type="text" id="dat1" size="15" readonly="readonly" value="<?= $branch_name ?>" />
		</div>
	<?php
	}
	?>
</div>


<div class="line" style="height:230px;">
	<div style="width:25%; float:left; text-align:right;">รายละเอียด:&nbsp;</div>
	<div style="width:20%; float:left;">
		<textarea name="textarea" cols="42" rows="15" id="mem"><?= $row['mem'] ?></textarea>
	</div>
</div>

<div class="line" style="margin-top:1.5%">
	<div style="width:25%; float:left; text-align:right;">เบอร์โทร :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="tel" size="15" value="<?= $row['protel'] ?>" /></div>
</div>

<div style="width:78%; text-align:right; float:left; margin-top:4%">
	<?php
	if ($row['branchid'] == $_SESSION['branch_id'] || $_SESSION['company_data'] == "1") {
	?>
		<input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;" onclick="addpromotion('promotion/promotion_add.php','home')" value="      บันทึก      " />
	<?php
	}
	?>
	<input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;" onclick="ajaxLoad('post','promotion/promotion_admin.php','','settingpage')" value=" รายการใหม่ " />
</div>