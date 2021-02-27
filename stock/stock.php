
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; margin:auto; margin-top:30px; height:20px;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left;line-height:20px;">
	<img src="images/icon/group.png" align="absmiddle" />&nbsp;คลังยา
	</div>
	<div style="width:80%; text-align:right; float:left;line-height:20px;">
	<input type="button" value="  รายการทั้งหมด  " onclick="loadmodule('home','stock/stock.php','') " style="height:25px; font-size:13px; line-height:25px;" />
	<input type="button"  value="  เพิ่มรายการใหม่ " onclick="swabtab(4,6,'stock/druge_new_from.php','content','')"  style="height:25px; font-size:13px; line-height:25px; " />	
<!--	<input type="button" value="  สั่งซื้อ  " onclick="swabtab(2,5,'','content','')" style="height:25px; font-size:13px; line-height:25px;" />-->
	<input type="button" value="  รับเข้า  " onclick="swabtab(3,6,'stock/instock.php','content','')" style="height:25px; font-size:13px; line-height:25px;" />
	<input type="button" value="  ปรับสต็อค  " onclick="swabtab(6,6,'stock/cutstock.php','content','')" style="height:25px; font-size:13px; line-height:25px;" />
	</div>
</div>

<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
<div class="littleDD" >
	<div id="tab1" class="tab" style="width:150px; background-color:#FFFFFF; display: ;  line-height:30px;">
	รายการทั้งหมด
	</div>	
	<div id="tab2" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
    สั่งซื้อ
	</div>
	<div id="tab3" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
    รับเข้า
	</div>
	<div id="tab4" class="tab" style="width:150px; background-color:#FFFFFF; display:none; line-height:30px;">
	เพิ่มข้อมูลใหม่
	</div>
	<div id="tab5" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
	ข้อมูล
	</div>	
	<div id="tab6" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
	ปรับสต็อค
	</div>	


</div>


<div id="content" style=" width:100%; margin-top:5px; text-align:center; height:auto;">

<?  require("druge.php");	 ?>

</div>
</div>
