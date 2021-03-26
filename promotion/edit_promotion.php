<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('../class/config.php');
$PID = $_POST['pid'];



$sql = "select * from promotion where proid='$PID'";
$patient_result = mysql_query($sql) or die("Error Query [" . $sql . "]");
$row = mysql_fetch_array($patient_result);

$dat = substr($row['datestart'], 8, 2) . '-' . substr($row['datestart'], 5, 2) . '-' . substr($row['datestart'], 0, 4);
$dat1 = substr($row['datestop'], 8, 2) . '-' . substr($row['datestop'], 5, 2) . '-' . substr($row['datestop'], 0, 4);


?>

<div class="line">&nbsp;</div>
<input type="hidden" id="typ" value="edit" />

<div style="width:25%; float:left; text-align:right;">รหัสโปรโมชั่น :&nbsp;</div>
<div style="width:25%; float:left;">
	<input name="text2" type="text" id="proid" size="30" value="<?= $PID ?>" />
</div>

<div class="line" style="margin-top:4px">
	<div style="width:25%; float:left; text-align:right; ">ชื่อโปรโมชั่น:&nbsp;</div>
	<div style="width:25%; float:left;">
		<input name="text2" type="text" id="proname" size="53" value="<?= $row['proname'] ?>" />
	</div>
</div>

<div class="line">

	<div style="width:25%; float:left; text-align:right;">วันที่เริ่ม :&nbsp;</div>
	<div style="width:18%; float:left;">
		<input type="text" id="dat" size="15" readonly="readonly" value="<?= $dat ?>" />
	</div>
	<div style="width:3%; float:left;">
		<!--	<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','dat')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
	</div>

	<div style="width:10%; float:left; text-align:right; margin-left:2%">วันที่หมด :&nbsp;</div>
	<div style="width:18%; float:left;">
		<input type="text" id="dat1" size="15" readonly="readonly" value="<?= $dat1 ?>" />
	</div>
	<div style="width:3%; float:left;">
		<!-- <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','dat1')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div> -->
	</div>

</div>

<div class="line">
	<?php
	if ($_SESSION['company_data'] == "1") {
	?>
		<div style="width:25%; float:left; text-align:right;">เลือกสาขา :&nbsp;</div>
		<div style="width:18%; float:left;">
			<?php
			include('../class/config.php');
			$sql = "select * from tb_branch ";
			$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
			?>
			<select name="select" id="branchid" style="width:117px;" onchange="serchtxt('promotion/promotion_list.php','d_tall','')">
				<option value="00">ทั้งหมด</option>
				<?php while ($rs = mysql_fetch_array($result)) {
					if ($rs['branchid'] == $row['branchid']) {
				?>
						<option value="<?= $rs['branchid'] ?>" selected> <?= $rs['branchname'] ?></option>
					<?php
					} else {
					?>
						<option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
					<?php
					}
					?>

				<?php } ?>
			</select>
		</div>
	<?php
	}
	?>
</div>


<div class="line" style="height:270px;">
	<div style="width:25%; float:left; text-align:right;">รายละเอียด:&nbsp;</div>
	<div style="width:20%; float:left;">
		<textarea name="textarea" cols="50" rows="15" id="mem"><?= $row['mem'] ?></textarea>
	</div>
</div>

<div class="line">


</div>

<div class="line">
	<div style="width:25%; float:left; text-align:right;">เบอร์โทร :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="tel" size="15" value="<?= $row['protel'] ?>" /></div>

</div>


<!--		<div style="width:78%; text-align:right; float:left;">
				<input type="button" value="      บันทึก       "  onclick="addpromotion('promotion/promotion_add.php','home')" style="height:25px; font-size:13px; line-height:25px;" />
	<!--					<input type="button" value=" รายการใหม่ " onclick="loadmodule('home','promotion/promotion.php')" value=" รายการใหม่')" style="height:25px; font-size:13px; line-height:25px;"/>
			</div> -->