<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$SID = $_POST['sid'];
$sql = "select * from tb_staff where staffid='$SID'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);
if(! empty($row['birthday'])){

$y = date('Y',time());
$age = intval($y) - intval(substr($row['birthday'],6,4));
if($age < 0) {
	$age = (intval($y) + 543 ) - intval(substr($row['birthday'],6,4)) ;
}
} else {
	$age = '';
}
$branch = $row['branchid'];

?>

<input type="hidden" id="typ" value="edit" />
<div class="line">
	<div style="width:21%; float:left; text-align:right;">รหัสพนักงาน :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="staffid" size="15" value="<?= $SID ?>" /></div>

	<?	
				$sql = "select branchid,branchname from tb_branch where branchid = '$branchid' and company_code ='".$_SESSION['company_code']."' ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]");
				$roww=mysql_fetch_array($result);
				?>
	<div style="width:25%; float:left; text-align:right;">สาขา :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="branch" style="width:117px;">
			<option value="<?= $roww['branchid'] ?>"><?= $roww['branchname'] ?></option>
			<? 
				$sql = "select branchid,branchname from tb_branch where branchid <> '$branch' and company_code ='".$_SESSION['company_code']."' ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 				
				while($rs=mysql_fetch_array($result)){  
				
				?>
			<option value="<?= $rs['branchid'] ?>"><?= $rs['branchname'] ?></option>
			<? } ?>
		</select>
	</div>
</div>
<!--รหัสพนักงาน-->

<div class="line">
	<?
				$sql = "select * from tb_gernaral where typ='PN'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				
				?>
	<div style="width:21%; float:left; text-align:right;">คำนำหน้าชื่อ :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="pname" style="width:117px;">
			<option value="<?= $row['pname'] ?>"><?= $row['pname'] ?></option>
			<? 
					while($rs=mysql_fetch_array($result)){  
					if($rs['name']!=$row['pname']){
					?>
			<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
			<? } } ?>
		</select>
	</div>


	<div style="width:25%; float:left; text-align:right;">เพศ :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="sex" style="width:117px;">
			<? if($rs['sex']=='ชาย'){ ?>
			<option value="นาย">ชาย</option>
			<option value="นางสาว">หญิง</option>
			<? } else { ?>
			<option value="นางสาว">หญิง</option>
			<option value="นาย">ชาย</option>
			<? } ?>
		</select>
	</div>

</div>
<!--คำนำหน้าชื่อ-->

<div class="line">
	<div style="width:21%; float:left; text-align:right;">ชื่อ :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="fname" size="15" value="<?= $row['fname'] ?>" /></div>
	<div style="width:25%; float:left; text-align:right;">สกุล :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="lname" size="12" value="<?= $row['lname'] ?>" /></div>

</div>
<!--ชื่อ-สกุล-->


<div class="line">
	<div style="width:21%; float:left; text-align:right;">ชื่อเล่น :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="nname" size="15" value="<?= $row['nickname'] ?>" /></div>

	<?
				$sql = "select * from tb_gernaral where typ='ST'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
	<div style="width:25%; float:left; text-align:right;">สถานะภาพ :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="st" style="width:117px;">
			<? if(($row['state']!='ไม่ระบุ') && (! empty($row['re_status'])) ){ ?>
			<option value="<?= $row['re_status'] ?>"><?= $row['re_status'] ?></option>
			<? } else { ?>
			<option value="ไม่ระบุ">ไม่ระบุ</option>
			<? 
					}		
					while($rs=mysql_fetch_array($result)){  
					if($rs['name']!=$row['state']){
					?>
			<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
			<? } } ?>
		</select>
	</div>
</div>
<!--ชื่อเล่น-->


<div class="line">
	<?
				$sql = "select * from tb_gernaral where typ='BL'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
	<div style="width:21%; float:left; text-align:right;">หมู่เลือด :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="bl" style="width:117px;">
			<? if(($row['blood']!='ไม่ระบุ') && (! empty($row['blood'])) ){ ?>
			<option value="<?= $row['blood'] ?>"><?= $row['blood'] ?></option>
			<? } else { ?>
			<option value="ไม่ระบุ">ไม่ระบุ</option>
			<? 
						}		
						while($rs=mysql_fetch_array($result)){  
						if($rs['name']!=$row['blood']){
						?>
			<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
			<? } } ?>
		</select>
	</div>
	<?
				$sql = "select * from tb_gernaral where typ='DE'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
	<div style="width:25%; float:left; text-align:right;">วุฒิการศึกษา :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="degree" style="width:117px;">
			<option value="<?= $row['degree'] ?>"><?= $row['degree'] ?></option>
			<? 
					   while($rs=mysql_fetch_array($result)){  
					   if($rs['name']!=$row['degree']){
					 ?>
			<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
			<? } } ?>
		</select>
	</div>


</div>
<!--หมู่เลือด-->


<div class="line">
	<div style="width:21%; float:left; text-align:right;">วัน-เดือน-ปี เกิด :&nbsp;</div>
	<div style="width:25%; float:left;">
		<input type="text" id="dd" size="2" style="width:22px" maxlength="2" value="<?= substr($row['birthday'], 0, 2) ?>" />-<input type="text" id="dm" size="2" style="width:22px" maxlength="2" value="<?= substr($row['birthday'], 3, 2) ?>" />-<input type="text" id="dy" size="4" style="width:35px" maxlength="4" value="<?= substr($row['birthday'], 6, 4) ?>" />
	</div>
	<div style="width:25%; float:left; text-align:right;">บัตรประชาชน :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="idcard" size="12" value="<?= $row['idcard'] ?>" /></div>
</div>
<!--วัน เดือน ปี เกิด-->

<div class="line">

	<div style="width:21%; float:left; text-align:right;">แสดง :&nbsp;</div>
	<div style="width:26%; float:left;">
		<select id="eshow">
			<? if($row['eshow']!='Y'){ ?>
			<option value="N">ไม่แสดง</option>
			<option value="Y">แสดง</option>
			<? } else { ?>
			<option value="Y">แสดง</option>
			<option value="N">ไม่แสดง</option>
			<? } ?>
		</select>
	</div>

	<div style="width:24%; float:left; text-align:right;">&nbsp;</div>
	<div style="width:25%; float:left; display:none;">
		<input type="text" id="age" size="5" style="width:20px" readonly="TRUE" style="display:none;" />
	</div>

</div>
<!--เดือน-->
<!--user pass-->
<div class="line">
	<div style="width:21%; float:left; text-align:right;">Username :&nbsp;</div>
	<div style="width:25%; float:left;">
		<input type="text" id="user" size="15" value="<?= $row['user'] ?>" />

	</div>
	<div style="width:25%; float:left; text-align:right;">Password :&nbsp;</div>
	<div style="width:25%; float:left;">
		<input type="password" id="pass" size="12" value="<?= $row['pass'] ?>" />
	</div>
</div>
<div class="line">&nbsp;</div>

<div class="line">
	<div style="width:21%; float:left; text-align:right;">ที่อยู่ :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="address" size="43" value="<?= $row['address'] ?>" /></div>
</div>
<!--ที่อยู่-->


<div class="line">
	<div style="width:21%; float:left; text-align:right;">เบอร์มือถือ :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="tel" size="15" value="<?= $row['tel'] ?>" /></div>
	<div style="width:25%; float:left; text-align:right;">E-mail :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="mail" size="12" value="<?= $row['email'] ?>" /></div>
</div>
<!--เบอร์่-->

<div class="line">&nbsp;</div>


<div class="line">
	<?
			$sql = "select * from tb_gernaral where typ='PS'";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			?>
	<div style="width:21%; float:left; text-align:right;">ตำแหน่ง :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="pos" style="width:117px;">
			<option value="<?= $row['position'] ?>"><?= $row['position'] ?></option>
			<? 
					   while($rs=mysql_fetch_array($result)){  
					   if($rs['name']!=$row['position']){
					 ?>
			<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
			<? } } ?>
		</select>
	</div>
	<div style="width:25%; float:left; text-align:right;">ประเภท :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select name="select" id="mode">
			<? if($row['typ']=='D'){?>
			<option value="D">แพทย์</option>
			<option value="E">พนักงาน</option>
			<? } else { ?>
			<option value="E">พนักงาน</option>
			<option value="D">แพทย์</option>
			<? } ?>
		</select>
	</div>
</div>
<!--ตำแหน่ง-->


<div class="line">
	<?
			$sql = "select * from tb_gernaral where typ='SS'";
			$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
			?>
	<div style="width:21%; float:left; text-align:right;">สถานะ :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="status" style="width:117px;">
			<option value="<?= $row['status'] ?>"><?= $row['status'] ?></option>
			<? 
					   while($rs=mysql_fetch_array($result)){  
					   if($rs['name']!=$row['status']){
					 ?>
			<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
			<? } } ?>
		</select>
	</div>
	<div style="width:25%; float:left; text-align:right;">ประเภท :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="tpy" style="width:117px;">
			<option value="<?= $row['category'] ?>"><?= $row['category'] ?></option>
			<? 
					   while($rs=mysql_fetch_array($result)){  
					   if($rs['name']!=$row['category']){
					 ?>
			<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
			<? } } ?>
		</select>
	</div>
</div>
<!--สถานะ-->


<div class="line">
	<div style="width:21%; float:left; text-align:right;">วันเริ่มทำงาน :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="sdate" size="15" value="<?= $row['start_date'] ?>" /></div>
	<div style="width:25%; float:left; text-align:right;">อายุงาน :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="dday" size="12" value="<?= $row[''] ?>" /></div>
</div>
<!--วันที่เริ่มทำงาน-->


<div class="line">
	<div style="width:21%; float:left; text-align:right;">สิทธิวันลา :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="ll" size="15" value="<?= $row['L_date'] ?>" /></div>
	<div style="width:25%; float:left; text-align:right;">เลขที่บัญชี:&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="acc" size="12" value="<?= $row['acc_number'] ?>" /></div>
</div>
<!--สิทธิวันลา-->

<div class="line">
	<div style="width:21%; float:left; text-align:right;">ประกันสังคม :&nbsp;</div>
	<div style="width:25%; float:left;">
		<select id="sso">
			<? if($rs['sso']=='มี'){ ?>
			<option value="มี">มี</option>
			<option value="ไม่มี">ไม่มี</option>
			<? } else { ?>
			<option value="ไม่มี">ไม่มี</option>
			<option value="มี">มี</option>
			<? } ?>
		</select>
	</div>
	<div style="width:25%; float:left; text-align:right;">เลขที่ประกันสังคม :&nbsp;</div>
	<div style="width:25%; float:left;"><input type="text" id="ssonum" size="12" value="<?= $row['sso_on'] ?>" /></div>
</div>
<!--สิทธิวันลา-->

<!-- <div class="line">&nbsp;</div> -->


<div style="width:78%; text-align:right; float:left;">
	<input type="button" value="       บันทึก      " onclick="addstaff('setting/staff_add.php','settingpage')" style="height:25px; font-size:13px; line-height:25px;" />
	<input type="button" value=" รายการใหม่ " onclick="ajaxLoad('post','setting/employee.php','','settingpage')" style="height:25px; font-size:13px; line-height:25px;" />
</div>