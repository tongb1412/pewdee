
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; margin:auto; margin-top:5px; height:30px;">
<div style="width:100px; font-size:16px; font-weight:bold;"><img src="images/icon/setting.png" align="absmiddle" />&nbsp;ตั้งค่า</div>
</div>
<div style="width:99%; height:auto; margin:auto; margin-top:5px; text-align:center;">
	<div id="main" class="main" style="width:20%; margin:auto; height:495px; overflow:hidden; float:left;">
		<div class="littleDD" style="font-size:14px; font-weight:bold;" >เมนู	</div>





		<div class="setting_menu"  onClick="setbtnSetting(1,4)">รายงานคนไข้</div>
		<div id="ST1" style="display:; height:auto;">
        	<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/repatient.php','','reportpage')">รายงานคนไข้</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/renewpatient.php','','reportpage')">รายงานคนไข้ใหม่</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/repatientcancle.php','','reportpage')">รายงานคนไข้ยกเลิก</a>
			</div>
		</div>

		<div class="setting_menu" onClick="setbtnSetting(2,4)">รายงานรายได้</div>
		<div id="ST2" style="display:none; height:auto;">
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/repayment.php','','reportpage')">รายงานรายได้ทั้งหมด</a></div>
		    <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rear.php','','reportpage')">รายงานรายได้จากค้างชำระ</a></div>
		    <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retypepay.php','','reportpage')">รายงานแยกตามการชำระ</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/recredit.php','','reportpage')">รายงานแยกตามบัตรเคดิต</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/reapayment.php','','reportpage')">รายงานคนไข้ค้างชำระ</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/resalement.php','','reportpage')">รายงานรายได้การขายทรีทเมนท์</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/resalecourse.php','','reportpage')">รายงานรายได้การขายคอร์ส</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/resalepg.php','','reportpage')">รายงานรายได้การขายแพ็คเกจ</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/reeuser.php','','reportpage')">รายงานรายได้ผู้ทำ</a></div>
			<div class="setting_menu_list" style="display:none">
			<a href="javascript: ajaxLoad('post','daily_report/resumdr.php','','reportpage')">รายงานรายได้ตามแพทย์</a></div>
            <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rep_doctor.php','','reportpage')">บัญชีแพทย์</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotalprice.php','','reportpage')">รายงานสรุปบันทึกยอดรายวัน</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotalcash.php','','reportpage')">รายงานสรุปบันทึกยอดสด</a></div>

		</div>

		<div class="setting_menu" onClick="setbtnSetting(3,4)">รายงานยา</div>
		<div id="ST3" style="display:none; height:auto;">
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/restockdruge.php	','','reportpage')">รายงานข้อมูลยาทั้งหมด</a></div>
		    <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rebuydruge.php	','','reportpage')">รายงานยาถึงจุดสั่งซื้อ</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/reexpiredruge.php','','reportpage')">รายงานยาใกล้หมดอายุ</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/redrugerec.php	','','reportpage')">รายงานการจ่ายยา</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/redrugeinstock.php	','','reportpage')">รายงานการรับยาเข้าสต็อค</a></div>
			</div>

		<div class="setting_menu" onClick="setbtnSetting(4,4)">รายงานรวม</div>
		<div id="ST4" style="display:none; height:auto;">
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalement.php	','','reportpage')">รายงานขายทรีทเม้นท์รวม</a></div>
		    <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalecourse.php	','','reportpage')">รายงานขายคอร์สรวม</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalepg.php	','','reportpage')">รายงานขายแพ็คเกจรวม</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotaldrugerec.php ','','reportpage')">รายงานการจ่ายยารวม</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rediscounttotal.php ','','reportpage')">รายงานส่วนลดทั้งหมด</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rediscount.php ','','reportpage')">รายงานส่วนลด100%</a></div>
            <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/repKupong.php ','','reportpage')">รายงานคูปอง</a></div>
            <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/repCbil.php ','','reportpage')">รายงานยกเลิกบิล</a></div>
            <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/repStock.php ','','reportpage')">รายงานยาคงคลัง</a></div>
            <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rep_df.php ','','reportpage')">บัญชีแพทย์</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rep_df_new.php ','','reportpage')">บัญชีแพทย์ ใหม่</a></div>
            <div class="setting_menu_list">
            <a href="javascript: ajaxLoad('post','Monthly_report/stockcard.php ','','reportpage')">Stock Card</a></div>
            <div class="setting_menu_list">
            <a href="javascript: ajaxLoad('post','Monthly_report/reprint.php ','','reportpage')">Reprint</a></div>
		</div>


	</div>
	<div id="reportpage" style="float:left; margin:auto; width:79%; height:auto;  margin-left:5px;">
		<? include('repatient.php'); ?>


   </div>
</div>
