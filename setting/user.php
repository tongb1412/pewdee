<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

?>

<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
	<div class="littleDD" style="font-size:14px; font-weight:bold;" >ตั้งค่าผู้ใช้โปรแกรม</div>

<div style="width:100%; height:auto; margin:auto; text-align:center; margin-top:10px;">
<div  style="width:30%; height:450px; float:left; text-align:center; ">

	<div style="width:98%; height:auto; margin:auto; ">
		<div class="txt_serch" style="width:206px">
		<input class="input_serch" type="text" id="txts" size="28" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('setting/useremp_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','setting/useremp_list.php','txt=','p_list')" />
		</div>
	</div>
	<div style="width:98%; height:20px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; padding:opx; border:<?=$tabcolor?> 1px solid;">    
		<div style="width:100%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;พนักงาน</div>
	</div>	
	
    <div id="p_list" style="width:98%; height:400px; margin:auto;  border:<?=$tabcolor?> 1px solid;">
	<?  require("useremp_list.php");	 ?>

    </div>

</div>
<div  style="width:68%; height:auto; float:left; text-align:center; margin-left:10px; ">

        <input type="hidden" id="typ" value="new" />  
	
		<div class="line">
    	<div style="width:17%; float:left; text-align:right;">รหัสพนักงาน :&nbsp;</div>
		<div style="width:15%; float:left;"><input type="text" id="staffid" size="10"  value="<?=$staffid?>" /></div> 
		<div style="width:20%; float:left; text-align:right;">ชื่อพนักงาน :&nbsp;</div>
		<div style="width:48%; float:left; "><input type="text" id="fname" size="34" value="<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']?>"  /></div>   
		</div>	
		<div class="line">
    	<div style="width:17%; float:left; text-align:right;">username :&nbsp;</div>
		<div style="width:15%; float:left;"><input type="text" id="user" size="10"  /></div> 
		<div style="width:20%; float:left; text-align:right;">password :&nbsp;</div>
		<div style="width:48%; float:left; "><input type="text" id="pass" size="34"  /></div>   
		</div>	
		<div class="line">
    	
		<div style="width:98%; float:left; text-align:right">
		<input type="button" value=" บันทึก "   onclick="adduser('setting/user_add.php','cdlist')">
	
		</div> 
		</div>	
		
		<div class="line" style="border:<?=$tabcolor?> 1px solid; padding:0px; height:20px; ">
		<div style="width:100%;  float:left; color:#000000; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; "> 
	
		<div style="width:15%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:35%;text-align:left; float:left;  line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อพนักงาน</div>
		<div style="width:20%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;username</div>
		<div style="width:30%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;password</div>
	
		</div>		
		</div>
		<div id="cdlist" class="line" style="padding:0px; height:auto; width:98%">     
			<? require("user_list.php"); ?>
		
		</div>	
		
</div>  
  
</div>




 
</div>
