<? include('../class/config.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div style="width:99%; height:auto;  text-align:left; padding-left:5px;">
	<div class="txt_serch" >
	<input class="input_serch" type="text" id="txts" size="41" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('register/patient_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','register/patient_list.php','txt=','p_list')" />
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
	<?  require("patient_list.php");	 ?>

</div>