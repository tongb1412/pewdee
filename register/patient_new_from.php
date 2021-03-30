<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
	.item1 {
		grid-column-start: 2;
		grid-column-end: 2;
	}
</style>

<?
$sql = "select * from tb_autonumber where typ='HN'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = explode('-',$rs['number']);
$n = strlen($x[1]);
$hn = $x[0].'-' ;
$txt = explode('-',$rs['last']);
$num = intval($txt[1]) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$hn .= $t; 

?>

<div style="width:12%; height:auto; margin-left:5px; float:left; text-align:right;">
	<div id="imgZone" style="width:95%; height:100px; float:right; text-align:center; ">
		<IFRAME name="up_iframe" id="up_iframe" src="" align="middle" width="100" height="100" frameborder="0" style="text-align:center; padding:0px; overflow:hidden; border:1px solid #CCCCCC; ">
		</IFRAME>




	</div>
	<div style="width:100%; height:auto; float:left; margin-top:10px;">
		<div class="grid-container item1">
			<form action="upload.php" target="up_iframe" method="post" enctype="multipart/form-data" name="form1" id="form1">
				<input type="file" size="5" name="filUpload" id="filUpload" style="display: none;" value="" />&nbsp;&nbsp;
				<input type="hidden" id="phn" name="phn" value="<?= $hn ?>" />
				<button id="b_file" name="b_file" onclick="thisFileUpload();">เลือกรูป</button>
				<br /><span id="file_upload_name">ไม่มีไฟล์</span><br />
				<input type="submit" id="iSubmit" value=" Upload " style="cursor:pointer;" />
			</form>
		</div>
	</div>
	<div style="width:100%; height:auto; float:left; display:none;">
		<input type="button" value="  ถ่ายรูปจากกล้อง  " style="cursor:pointer;" onclick="popupWebcamet('<?= $hn ?>');" />
	</div>

</div>
<div style="width:48%; height:470px; float:left;">
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">รหัสคนไข้ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="hn" size="15" value="<?= $hn ?>" disabled="disabled" /></div>
		<div style="width:20%; float:left; text-align:right;"><span style="color: red;">*</span>Card No :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="cn" size="15" /></div>
	</div>
	<?
$sql = "select * from tb_gernaral where typ='PN'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">คำนำหน้าชื่อ :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select id="pname" style="width:117px;">
				<? while($rs=mysql_fetch_array($result)){  ?>
				<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
				<? } ?>
			</select>
		</div>
		<div style="width:20%; float:left; text-align:right;">เพศ :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select id="sex" style="width:117px;">
				<option value="ชาย">ชาย</option>
				<option value="หญิง">หญิง</option>
			</select>
		</div>

	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;"><span style="color: red;">*</span>ชื่อ :&nbsp;</div>

		<div style="width:30%; float:left;"><input type="text" id="fname" size="15" /></div>
		<div style="width:20%; float:left; text-align:right;"><span style="color: red;">*</span>สกุล :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="lname" size="15" /></div>
	</div>
	<?
$sql5 = "select velid,velname from tb_level order by velid asc";
$result5 = mysql_query($sql5) or die ("Error Query [".$sql5."]"); 


$sql = "select * from tb_gernaral where typ='ST'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>

	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ระดับคนไข้ :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select id="plevel" style="width:117px;">
				<? while($rs=mysql_fetch_array($result5)){  ?>
				<option value="<?= $rs['velname'] ?>"><?= $rs['velname'] ?></option>
				<? } ?>
			</select>
		</div>
		<div style="width:20%; float:left; text-align:right;">สถานะภาพ :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select id="st" style="width:117px;">
				<option value="ไม่ระบุ">ไม่ระบุ</option>
				<? while($rs=mysql_fetch_array($result)){  ?>
				<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
				<? } ?>
			</select>
		</div>
	</div>

	<div class="line">
		<div style="width:20%; float:left; text-align:right;">บัตรประชาชน :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="pno" size="15" maxlength="13" /></div>
		<div style="width:20%; float:left; text-align:right;">Passpoert No :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="pass" size="15" maxlength="15" /></div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">วัน-เดือน-ปี เกิด :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="dd" size="2" style="width:25px" maxlength="2" onkeyup="chk_dob('1')" />-<input type="text" id="dm" size="2" style="width:25px" maxlength="2" onkeyup="chk_dob('2')" />-<input type="text" id="dy" size="4" style="width:45px" maxlength="4" onkeyup="calage(<?= date('Y', time()) ?>)" /> </div>
		<div style="width:20%; float:left; text-align:right;">อายุ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="age" size="5" style="width:20px" readonly="TRUE" /> ปี</div>
	</div>
	<?


$sql = "select * from tb_gernaral where typ='OC' order by name asc";
$result1 = mysql_query($sql) or die ("Error Query [".$sql."]"); 

?>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">อาชีพ :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select id="oc" style="width:117px;">
				<option value="ไม่ระบุ">ไม่ระบุ</option>
				<? while($rs=mysql_fetch_array($result1)){  ?>
				<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
				<? } ?>
			</select>
		</div>



		<div style="width:20%; float:left; text-align:right;">แหล่งข่าว :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select id="bl" style="width:117px;">
				<option value="ไม่ระบุ">ไม่ระบุ</option>
				<option value="นิตยสาร">นิตยสาร</option>
				<option value="เวปไซด์">เวปไซด์</option>
				<option value="อินเตอร์เน็ต">อินเตอร์เน็ต</option>
				<option value="เพื่อน">เพื่อน</option>
				<option value="ญาติ">ญาติ</option>
			</select>
		</div>



	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;"><?php if ($_SESSION['company_data'] == "1") {
																	echo "สาขา :&nbsp;";
																} ?></div>
		<div style="width:30%; float:left;">
			<?php
			if ($_SESSION['company_data'] == "1") {
				if ($_SESSION['branch_id'] != "") {
					$branch_id = $_SESSION['branch_id'];
					$sql = "";
					$sql = "select * from tb_branch order by branchid";

					$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
					$Num_Rows = mysql_num_rows($result);
			?>
					<select name="sel_branchid_p_new" id="sel_branchid_p_new">
						<?php
						if ($Num_Rows > 0) {
							$flag = 0;
							while ($rs = mysql_fetch_array($result)) {
								if ($branch_id == $rs['branchid']) {
						?>
									<option value="<?php echo $rs['branchid'] ?>" selected><?php echo $rs['branchname']; ?></option>
								<?php
								} else {
								?>
									<option value="<?php echo $rs['branchid'] ?>"><?php echo $rs['branchname']; ?></option>
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

	<div class="line">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:30%; float:left;"><span id="txtdate"></span></div>
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:30%; float:left;"></div>
	</div>
	<!-- <div class="line">&nbsp;</div> -->

	<div class="line">
		<div style="width:20%; float:left; text-align:right;"><span style="color: red;">*</span>ที่อยู่ :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="address" size="45" /></div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;"><span style="color: red;">*</span>จังหวัด :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select name='province' id='province' onchange="data_show(this.value,'amphur');" style="width:117px;">
				<option value="">-- เลือกจังหวัด --</option>
				<?
			$rstTemp=mysql_query('select * from province Order By PROVINCE_ID ASC');
			while($arr_2=mysql_fetch_array($rstTemp)){
			?>
				<option value="<?= $arr_2['PROVINCE_ID'] ?>"><?= $arr_2['PROVINCE_NAME'] ?></option>
				<? }?>
			</select>
			<!-- <input type="text" id="province" size="15" onfocus="serchtxt('register/sql_aum.php','aumz','')"  onkeyup="serchtxt('register/sql_pro.php','proz',this)" />
		<div id="proz" class="bl"  ></div> -->
		</div>
		<div style="width:20%; float:left; text-align:right;">อำเภอ/เขต :&nbsp;</div>
		<div style="width:30%; float:left; ">
			<select name='amphur' id='amphur' onchange="data_show(this.value,'district');" style="width:117px;">
				<option value="">-- เลือกอำเภอ---</option>
			</select>
			<!-- <input type="text" id="aum" size="15" onfocus="serchtxt('register/sql_tum.php','tumz','')"  onkeyup="serchtxt('register/sql_aum.php','aumz',this)" />
        <div id="aumz" class="bl" ></div> -->
		</div>
	</div>
	<div class="line">

		<div style="width:20%; float:left; text-align:right;">ตำบล/แขวง :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select name='district' id='district' onchange="data_show(this.value,'zipcode');" style="width:117px;">
				<option value="">-- เลือกแขวง --</option>
			</select>
			<!-- <input type="text" id="tum" size="15"  onkeyup="serchtxt('register/sql_tum.php','tumz',this)" />
		<div id="tumz" class="bl" ></div> -->
		</div>
		<div style="width:20%; float:left; text-align:right;">รหัสไปรษณีย์ :&nbsp;</div>
		<div style="width:30%; float:left;">
			<!-- <input type="text" id="post" size="15" maxlength="5" onfocus="serchtxt('register/sql_pro.php','proz','')" /> -->
			<select name='zipcode' id='zipcode' style="width:117px;">
				<option value="">-- รหัสไปรษณีย์ --</option>
			</select>
		</div>
	</div>

	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ประเทศ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="country" size="15" value="ไทย" /></div>
	</div>
	<div class="line">&nbsp;</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">เบอร์โทร :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="tel" size="15" /></div>
		<div style="width:20%; float:left; text-align:right;"><span style="color: red;">*</span>เบอร์มือถือ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="mtel" size="15" /></div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">E-mail :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="email" size="45" /></div>
	</div>

	<div class="line" style=" border-bottom:#CCCCCC 1px dotted;">
		<div style="width:20%; float:left; text-align:right;">Facebook :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="facebook" size="45" /></div>
	</div>
</div>



<div style="width:35%; height:500px; margin-left:0.5%; float:left; ">
	<?
$sql = "select * from tb_gernaral where typ='BL' order by name asc";
$result1 = mysql_query($sql) or die ("Error Query [".$sql."]"); 

?>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">อาการเบื้องต้น :&nbsp;</div>
		<div style="width:80%; float:left;">
			<select id="lt" style="width:117px;" onchange="getlt(this)">
				<option value="ไม่ระบุ">ไม่ระบุ</option>
				<? while($rs=mysql_fetch_array($result1)){  ?>
				<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
				<? } ?>
			</select>
		</div>

	</div>
	<div class="line" style="height:80px;">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:80%; float:left;">
			<textarea name="textarea" cols="36" rows="3" id="mem"></textarea>
		</div>
	</div>


	<div class="line">
		<div style="width:20%; float:left; text-align:right;">แพ้ยา :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="hidden" id="did" value="" />
			<input type="text" id="drug" size="26" onkeyup="serchtxt('register/sql_druge.php','dl',this)" />&nbsp;<input type="button" value="  เพิ่ม " onClick="adddruganti('register/sql_adddruganti.php','dz','register/druganti_list.php')" />
			<div id="dl" class="bl"></div>
		</div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:80%; float:left;">
			<div style="width:99%; height:20px; line-height:20px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
				<div style="width:80%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>

			</div>
		</div>
	</div>
	<div class="line" style="height:99px; overflow:hidden;">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div id="dz" style="width:80%; float:left; overflow:auto">

		</div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">โรคประจำตัว :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="hidden" id="doid" value="" />
			<input type="text" id="dio" size="26" onkeyup="serchtxt('register/sql_dio.php','dol',this)" />&nbsp;<input type="button" value="  เพิ่ม " onClick="adddinose('register/sql_adddinoseanti.php','doz','register/dinoseanti_list.php')" />
			<div id="dol" class="bl"></div>
		</div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:80%; float:left;">
			<div style="width:99%; height:20px; line-height:20px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
				<div style="width:80%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>

			</div>
		</div>
	</div>





	<div class="line" style="height:95px;  overflow:hidden;  border-bottom:#CCCCCC 1px dotted;">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div id="doz" style="width:80%; float:left; ">
		</div>
	</div>

	<div class="line" style="border-bottom:#CCCCCC 1px dotted;">
		<div style="width:20%; float:left; text-align:right;">รู้จักผิวดีจาก :&nbsp;</div>
		<div style="width:80%; float:left;">
			<select id="how" style="width:117px;">
				<option value="">--- เลือกหัวข้อ ---</option>
				<?php
				$catagory = array("เว็บไซต์คลีนิก", "เว็บไซต์อื่น", "เดินผ่าน", "นิตยสาร", "เฟสบุคคลีนิก", "วิทยุ/ทีวี", "อินเตอร์เน็ต", "โบรชัวร์", "เพื่อน/คนรู้จัก", "ยูทูป", "การแนะนำของเน็ตไอดอล", "อื่นๆ");
				foreach ($catagory as $value) {
					echo "<option value='$value'>$value</option>";
				} ?>
			</select>
			&nbsp;&nbsp;อื่นๆ : <input type="text" id="other" size="11" />
		</div>
	</div>

	<div class="line" style="margin-top:10px;text-align:right;">
		<div style="width:70%; float:left; text-align:right; font-weight:bold">&nbsp;
			คนไข้ :&nbsp;
			<select id="typ" style="width:60px;">
				<option value="O">เก่า</option>
				<option value="N">ใหม่</option>
			</select>
		</div>
		<div id="doz" style="width:30%; float:left; text-align:right;">
			<input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:35px;" onclick="addpatient('ADD')" />&nbsp;

		</div>
	</div>

</div>