<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; height:30px; text-align:left; padding-left:5px;">
	<div class="txt_serch">
	<input class="input_serch" type="text" id="txts" size="41" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('stock/druge_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','stock/druge_list.php','txt=','p_list')" />
	</div>
</div>

<div style="width:99%; height:20px; margin-top:15px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
    <div style="width:15%;text-align:left; float:left; line-height:20px;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>	
	<div style="width:30%;text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
	<div style="width:20%;text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;กลุ่มยา</div>	
	<div style="width:10%;  text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
	<div style="width:10%;  text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
	<div style="width:15%;text-align:left; float:left; line-height:20px;">&nbsp;</div>
</div>

<div id="p_list" style=" width:100%; margin-top:5px; text-align:center; height:auto;">
	<?  require("druge_list.php");	 ?>

</div>