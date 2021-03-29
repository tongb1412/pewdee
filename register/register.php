<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
if(! empty($_POST['vn'])){
	$vn = $_POST['vn'];
	$hn = $_POST['hn'];
	$sql_delete="delete from tb_drugerec where vn= '$vn' ";
	mysql_query($sql_delete);
	$sql = "update tb_patient set vn='-'  where hn='$hn' ";
	mysql_query($sql);	
}
?>


<div style="width:99%; margin:auto; height:25px;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
		<img src="images/icon/group.png" align="absmiddle" />&nbsp;เวชระเบียน
	</div>
	<div style="width:80%; text-align:right; float:left; line-height:20px;">
		<input type="button" value="  รายชื่อทั้งหมด  " onclick="loadmodule('home','register/register.php','')" style="height:25px; font-size:13px; line-height:25px;" />
		<input type="button" value="  เพิ่มคนไข้ใหม่  " onclick="cleartabreg(6,4,10,'register/patient_new_from.php','content','')" style="height:25px; font-size:13px; line-height:25px; " />
		<input type="button" value="  ตารางนัด  " onclick="loadmodule('home','appointment/appointment.php','')" style="height:25px; font-size:13px; line-height:25px; " />
	</div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
	<div class="littleDD">
		<div id="tab1" class="tab" style="width:150px; background-color:#FFFFFF;">
			<a href="javascript: loadpage('content',1,4,'register/patient.php')">รายชื่อทั้งหมด</a>
		</div>
		<div id="tab2" class="tab" style="width:100px; display:none;">
			<a href="javascript: loadpage('content',2,4,'register/appointment.php')">รายการนัด</a>
		</div>
		<div id="tab3" class="tab" style="width:100px; display:;">
			<a href="javascript: loadpage('content',3,4,'register/patientinsys.php')">คนไข้ในระบบ</a>
		</div>
		<div id="tab4" class="tab" style="width:100px; display:none;">
			<a href="javascript: loadpage('content',4,4,'')">สถิติประจำวัน</a>
		</div>

		<div id="tab5" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:20px;">
			<a href="javascript: regClick('F','register/patient_edit_from.php','content')">ข้อมูลทั่วไป</a>

		</div>
		<div id="tab6" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
			เพิ่มข้อมูลใหม่
		</div>
		<div id="tab7" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
			ข้อมูล
		</div>
		<div id="tab8" class="tab" style="width:100px; display:none; line-height:20px;">
			<a href="javascript: regClick('H','register/history.php','content')">ประวัติการรักษา</a>

		</div>

		<div id="tab9" class="tab" style="width:100px; display:none; line-height:20px;">
			<a href="javascript: regClick('T','register/history_treatment.php','content')">ประวัติทรีทเม้นท์</a>

		</div>
		<div id="tab10" class="tab" style="width:100px; display:none; line-height:20px;">
			<a href="javascript: regClick('U','register/doctor_history.php','content')">ประวัติการใช้ทรีทเมนท์</a>

		</div>

	</div>

	<div id="content" style=" width:100%; margin-top:5px; text-align:center; height:auto;">
		<?  require("patient.php");	 ?>
	</div>

</div>