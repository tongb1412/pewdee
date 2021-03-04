<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; margin:auto; margin-top:5px; height:30px;">
	<div style="width:100px; font-size:16px; font-weight:bold;"><img src="images/icon/setting.png" align="absmiddle" />&nbsp;ตั้งค่า</div>
</div>
<div style="width:99%; height:auto; margin:auto; margin-top:5px; text-align:center;">
	<div id="main" class="main" style="width:20%; margin:auto; height:495px; overflow:hidden; float:left;">
		<div class="littleDD" style="font-size:14px; font-weight:bold;">เมนู </div>

		<div class="setting_menu" onClick="setbtnSetting(1,6)">ตั้งค่ามาตรฐาน</div>
		<div id="ST1" style="display:; height:auto;">
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/clinicinformation.php','mode=CN','settingpage')">ข้อมูลคลินิก</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=PN','settingpage')">คำนำหน้าชื่อ</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=BL','settingpage')">อาการเริ่มต้น </a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=ST','settingpage')">สถานภาพ</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=OC','settingpage')">อาชีพ</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=TM','settingpage')">ตำบล</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=AM','settingpage')">อำเภอ</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=PV','settingpage')">จังหวัด</a>
			</div>
			<!--			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=CT','settingpage')">ประเภทบัตรเครดิต</a>
			</div>	-->
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=BK','settingpage')">ธนาคาร</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=AP','settingpage')">รายการนัด</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=PS','settingpage')">ตำแหน่ง</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DE','settingpage')">วุฒิการศึกษา</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=SS','settingpage')">สถานะการทำงาน</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=TW','settingpage')">ประเภทการทำงาน</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=GTR','settingpage')">กลุ่มทรีทเมนท์</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=GTC','settingpage')">กลุ่มคอร์ส</a>
			</div>

		</div>

		<div class="setting_menu" onClick="setbtnSetting(2,6)">ตั้งข้อมูลยา</div>
		<div id="ST2" style="display:none; height:auto;">
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DG','settingpage')">กลุ่มยา</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DT','settingpage')">ประเภทยา</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DN','settingpage')">หน่วยยา</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DS','settingpage')">ขนาดยา</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DU','settingpage')">วิธีใช้ยา</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DW','settingpage')">ข้อควรระวัง</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=DH','settingpage')">วิธีเก็บ</a>
			</div>
		</div>

		<div class="setting_menu" onClick="setbtnSetting(3,6)">ตั้งค่าโปรแกรม</div>
		<div id="ST3" style="display:none; height:auto;">

			<!--<div class="setting_menu_list">	<a href="javascript: ajaxLoad('post','setting/user.php','','settingpage')">ผู้ใช้โปรแกรม</a></div>-->
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/employee.php','','settingpage')">พนักงาน-แพทย์</a>
			</div>

			<!--<div class="setting_menu_list"><a href="">กำหนดรหัสอัตโนมัติ</a></div>-->

			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/level.php','','settingpage')">กำหนดสิทธิ์ระดับการรักษา</a>
			</div>
		</div>

		<div class="setting_menu" onClick="setbtnSetting(4,6)">ตั้งค่าทรีทเม้นท์</div>
		<div id="ST4" style="display:none; height:auto;">
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/treatment.php','','settingpage')">สร้างรายการเลเซอร์ / ทรีทเม้นท์</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/course.php','','settingpage')">สร้างรายการคอร์ส</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/package.php','','settingpage')">สร้างรายการแพ็คเกจ</a>
			</div>

			<!--			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','setting/pct_from.php','','settingpage')">เพิ่มคอร์สเก่า</a>
			</div>-->

		</div>
		<div class="setting_menu" onClick="setbtnSetting(5,6)">ตั้งค่าการรักษา</div>
		<div id="ST5" style="display:none; height:auto;">
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/gernaral_setting.php','mode=LB','settingpage')">หัตถการ / แล็บ</a>
			</div>
		</div>

		<div class="setting_menu" onClick="setbtnSetting(6,6)">อื่น ๆ</div>
		<div id="ST6" style="display:none; height:auto;">
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/patient_out.php','','settingpage')">คนไข้นอกระบบ</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/drug_out.php','','settingpage')">ยานอกระบบ</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','setting/costs.php','','settingpage')">ค่าใช้จ่าย</a>
			</div>
			<div class="setting_menu_list">
				<a href="javascript: ajaxLoad('post','promotion/promotion_admin.php','','settingpage')">โปรโมชั่น</a>
			</div>
		</div>



	</div>
	<div id="settingpage" style="float:left; margin:auto; width:79%; height:auto;  margin-left:5px;">
		<? include('clinicinformation.php'); ?>


	</div>
</div>