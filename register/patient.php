<?php


include('../class/config.php');


?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div style="width:99%; height:auto;  text-align:left; padding-left:5px;">
	<div class="txt_serch" >
	<!-- <input class="input_serch" type="text" id="txts" size="41" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('register/patient_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','register/patient_list.php','txt=','p_list')" /> -->
	<input class="input_serch" type="text" id="txts" size="41" value="" placeholder="ค้นหา" /><input type="button" class="btn_serch" onclick="serchtxtPatient('register/patient_list.php','p_list','')" />
	</div>
	<div style="position: absolute;left: 35%;top: 15.1%;">
		<?php
			if($_SESSION['company_data'] == "1"){
				if ($_SESSION['branch_id'] != "") {
					$branch_id = $_SESSION['branch_id'];
					$sql = "";
					if ($branch_id == "00" || $branch_id == "07") {
						$sql = "select * from tb_branch order by branchid";
					} else {
						$sql = "select * from tb_branch where branchid = '$branch_id' order by branchid";
					}
					$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
					$Num_Rows = mysql_num_rows($result);
				?>
					<span>
						สาขา
						&nbsp;
					</span>
					<select name="sel_branchid_patient" id="sel_branchid_patient" onchange="serchsel('register/patient_list.php','p_list',this)">
						<?php
						if ($Num_Rows > 0) {
							$flag = 0;
							if ($branch_id == "00" || $branch_id == "07") {
						?>
								<option value="00">ทั้งหมด</option>
								<?php
							} 
							while ($rs = mysql_fetch_array($result)) {
								if($branch_id == $rs['branchid']){
									?>
									<option value="<?php echo $rs['branchid'] ?>" selected><?php echo $rs['branchname'];?></option>
									<?php
								}
								else{
									?>
									<option value="<?php echo $rs['branchid'] ?>"><?php echo $rs['branchname'];?></option>
								<?php
								}
							}
						}
						?>
					</select>
				<?php
					// mysql_close($dblink);
					// ajaxLoad('get','stock/druge_list.php','txt=','p_list');
				} 
			}
		?>

	</div>
</div>

<div style="width:99%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
    <div style="width:20%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Card No.</div>
	<div style="width:15%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัสคนไข้</div>
	<div style="width:30%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ - สกุล</div>
	<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เบอร์โทร</div>
	<div style="width:15%;text-align:left; float:left;">&nbsp;</div>
</div>

<div id="p_list" style=" width:100%; margin-top:5px; text-align:center; height:auto;">
	<?  require("patient_list.php"); ?>

</div>