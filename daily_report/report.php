 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; margin:auto; margin-top:5px; height:30px;">
<div style="width:300px; font-size:16px; font-weight:bold;"><img src="images/icon/d_report.png" align="absmiddle" />&nbsp;รายงานประจำวัน</div>
</div>
<div style="width:99%; height:auto; margin:auto; margin-top:5px; text-align:center;">
	<div id="main" class="main" style="width:20%; margin:auto; height:495px; overflow:hidden; float:left;">
		<div class="littleDD" style="font-size:14px; font-weight:bold;" >เมนู	</div>

		<div class="setting_menu"  onClick="setbtnSetting(1,5)">รายงานรายได้</div>
		<div id="ST1" style="display:; height:auto;">

			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/repayment.php','','reportpage')">รายงานรายได้ทั้งหมด</a></div>
		    <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/rear.php','','reportpage')">รายงานรายได้จากค้างชำระ</a></div>

			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/reapayment.php','','reportpage')">รายงานคนไข้ค้างชำระ</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/recredit.php','','reportpage')">รายงานรายได้แยกตามบัตรเครดิต</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/resalement.php','','reportpage')">รายงานรายได้การขายทรีทเมนท์</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/resalecourse.php','','reportpage')">รายงานรายได้การขายคอร์ส</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/resalepg.php','','reportpage')">รายงานรายได้การขายแพ็คเกจ</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/reeuser.php','','reportpage')">รายงานรายได้ผู้ทำ</a></div>
			<!--<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/resumdr.php','','reportpage')">รายงานรายได้ตามแพทย์</a></div>-->
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/repatient.php','','reportpage')">รายงานคนไข้ประจำวัน</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/rediscount.php','','reportpage')">รายงานส่วนลด 100%</a>
			</div>

		</div>





	   	<div class="setting_menu" onClick="setbtnSetting(2,5)">รายงานรวม</div>
		<div id="ST2" style="display:none; height:auto;">
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

		</div>

        <div class="setting_menu"  onClick="setbtnSetting(3,5)">รายงานคนไข้</div>
		<div id="ST3" style="display:none; height:auto;">
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

        <div class="setting_menu"  onClick="setbtnSetting(4,5)">รายงานเกี่ยวกับยา</div>
		<div id="ST4" style="display:none; height:auto;">
  			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/redrugerec.php','','reportpage')">รายงานการจ่ายยาประจำวัน</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rebuydruge.php','','reportpage')">รายงานยาถึงจุดสั่งซื้อ</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/reexpiredruge.php','','reportpage')">รายงานยาใกล้หมดอายุ</a>
			</div>

            <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/stockcard.php ','','reportpage')">Stock Card</a></div>
            			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/drug_out.php','','reportpage')">นำยาออกนอกระบบ</a>
			</div>
		</div>

        <div class="setting_menu" onClick="setbtnSetting(5,5)">อื่น ๆ</div>
		<div id="ST5" style="display:none; height:auto;">
  			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rep_df.php ','','reportpage')">บัญชีแพทย์</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/rep_treatment.php ','','reportpage')">รายงานการใช้ทรีทเม้นท์</a></div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/patient_out.php','','reportpage')">คนไข้นอกระบบ</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','setting/costs.php','','reportpage')">ค่าใช้จ่าย</a>
			</div>
			<div class="setting_menu_list" style="display:none;">
			<a href="javascript: ajaxLoad('post','Monthly_report/restockdruge.php','','reportpage')">จำนวนยาคงเหลือ</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/totalprice.php','','reportpage')">ลงยอดเงินประจำวัน</a>
			</div>
            <div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/totalcash.php','','reportpage')">ลงยอดเงินสดประจำวัน</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','daily_report/dtime.php','','reportpage')">ลงเวลาแพทย์</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotalprice.php','','reportpage')">รายงานลงยอดเงิน</a>
			</div>
			<div class="setting_menu_list">
			<a href="javascript: ajaxLoad('post','Monthly_report/retotalcash.php','','reportpage')">รายงานยอดเงินสด</a>
			</div>
		</div>


	</div>
	<div id="reportpage" style="float:left; margin:auto; width:79%; height:auto;  margin-left:5px;">
		<? include('repayment.php'); ?>


   </div>
</div>
