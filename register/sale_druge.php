<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['hn'];

$sql = "select * from tb_patient where hn='$hn'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);


if($row['stayin']=='REG'){
	if($row['vn']!='-'){
		$vn = $row['vn'];
	} else {
		$vn = 'VN'.date('ymdHis',time());
		$sql = "update tb_patient set vn='$vn'  where hn='$hn' ";
		mysql_query($sql);
	}
	
	
	
}

?>
<div style="width:99%; margin:auto;  height:25px;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
	<img src="images/icon/group.png" align="absmiddle" />&nbsp;ขายยาหน้าร้าน 
	</div>
	<div style="width:80%; text-align:right; float:left; line-height:20px;">
	<? if($row['stayin']=='REG'){ ?>
	<input type="button" value="  ซื้อยา  " onclick="addvst('register/add_vst.php','FIN')" style="height:25px; font-size:13px; line-height:25px;" />
	<? } else { ?>
	<span style="color:#FF0000; font-size:16px; font-weight:bold;">ไม่สามารถซื้อยาหน้าร้านได้ เนื่องจากคนไข้อยู่ระหว่างการตรวจ</span>
	<? } ?>
	<input type="button"  value="  ยกเลิก " onclick="loadmodule('home','register/register.php','vn=<?=$vn?>&hn=<?=$hn?>')"  style="height:25px; font-size:13px; line-height:25px;" />	
	</div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
<div class="littleDD" style="font-size:25px; font-weight:bold; height:50px;" >    
	<div style="width:30%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ : <?=$hn; ?></div>
	<div style="width:65%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;"><?=$row['pname'].$row['fname'].'    '.$row['lname']; ?></div>
</div>
<div style="width:100%; height:auto; margin-top:10px; text-align:left;">
    <input type="hidden" id="hn" value="<?=$hn?>" />
	<input type="hidden" id="vn" value="<?=$vn?>" />	
	<input type="hidden" id="typ" value="99" />
	<input type="hidden" id="fis" value="Y" />
	<div class="line">
		<div style="width:40%; float:left; text-align:right; text-align:left;">
		&nbsp;&nbsp;รหัสยา :&nbsp;<input type="text" id="did" size="10" onkeyup="serchtxt('register/druge_list.php','dl',this)"/>&nbsp;ชื่อยา :&nbsp;<input type="text" id="dname" size="28" onkeyup="serchtxt('register/druge_list.php','dl',this)"/>
		<div id="dl" class="bl" style="width:100%;"></div>
		</div>	
		<div style="width:5%; float:left; text-align:right;">จำนวน :&nbsp;</div>
		<div style="width:10%; float:left; "><input type="text" id="qty" size="5" onkeyup="calnum('price','qty','uprice')" />&nbsp;<span id="unit"></span></div>
		<div style="width:5%; float:left; text-align:right;">ราคา :&nbsp;</div>
		<div style="width:10%; float:left; "><input type="text" id="uprice" size="10"  /><input type="hidden" id="price" /></div>		
		
		
	
		
		
		<div style="width:5%; float:left; text-align:center;  line-height:20px;">
		<input type="button" value=" เพิ่ม " onclick="addsaledlist('register/sale_druge_add.php','sdlist')" />
		</div>
	</div>	
	<div class="line" style="height:20px; line-height:20px;  ">
	<div style="width:99%; height:20px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; border:<?=$tabcolor?> 1px solid; ">
    <div style="width:10%;text-align:left; float:left; line-height:20px;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
	<div style="width:15%;  text-align:left; float:left;line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
	<div style="width:30%;text-align:left; float:left;line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
	<div style="width:10%;text-align:left; float:left;line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
	<div style="width:10%;text-align:left; float:left;line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
	<div style="width:10%;text-align:left; float:left;line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา/หน่วย</div>
	<div style="width:10%;text-align:left; float:left;line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคารวม</div>
	</div>	
    <div id="sdlist" class="line" >



<?
include('../class/config.php');
$cl = $color1;

$n=1; $total = 0;
$sql = "select * from tb_drugerec where vn='$vn' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
?>
	<div  style=" width:99%; margin-left:4px; height:350px;  border:<?=$tabcolor?> 1px solid; overflow:auto; ">

<?
while($rs=mysql_fetch_array($result)){ 
$total = $total + ( $rs['price'] *$rs['qty'] );
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}
?>
<div  style="width:99%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:8%;float:left; padding-left:20px; "><?=$n?></div>
	<div style="width:15%;float:left; padding-left:20px; cursor:pointer;" onClick="movedrugeEdit('<?=$rs['did']?>','<?=$rs['dname']?>','<?=$rs['qty']?>','<?=$rs['unit']?>','<?=$rs['price']?>')"><?=$rs['did']?>&nbsp;</div>
	<div style="width:30%;float:left; cursor:pointer;" onClick="movedrugeEdit('<?=$rs['did']?>','<?=$rs['dname']?>','<?=$rs['qty']?>','<?=$rs['unit']?>','<?=$rs['price']?>')"><?=$rs['dname']?>&nbsp;</div>
	<div style="width:10%;float:left; cursor:pointer;" onClick="movedrugeEdit('<?=$rs['did']?>','<?=$rs['dname']?>','<?=$rs['qty']?>','<?=$rs['unit']?>','<?=$rs['price']?>')"><?=$rs['qty']?>&nbsp;</div>
	<div style="width:10%;float:left;cursor:pointer;" onClick="movedrugeEdit('<?=$rs['did']?>','<?=$rs['dname']?>','<?=$rs['qty']?>','<?=$rs['unit']?>','<?=$rs['price']?>')"><?=$rs['unit']?>&nbsp;</div>
	<div style="width:8%;float:left; text-align:right;cursor:pointer; " onClick="movedrugeEdit('<?=$rs['did']?>','<?=$rs['dname']?>','<?=$rs['qty']?>','<?=$rs['unit']?>','<?=$rs['price']?>')"><?=number_format($rs['price'],'2','.',',')?>&nbsp;</div>
	<div style="width:9%;float:left; text-align:right; cursor:pointer;" onClick="movedrugeEdit('<?=$rs['did']?>','<?=$rs['dname']?>','<?=$rs['qty']?>','<?=$rs['unit']?>','<?=$rs['price']?>')"><?=number_format($rs['price'] *$rs['qty'] ,'2','.',',')?>&nbsp;</div>
	<div style="width:5%;float:left; text-align:right; ">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('register/sale_druge_del.php','sdlist','vn=<?=$rs['vn']?>&did=<?=$rs['did']?>')" />
	</div>
	
</div>
<? $n++; } ?>






	

	</div>	





	<div class="line" style="font-size:16px; font-weight:bold; height:25px;">
		<div style="width:100%; float:left; text-align:right; line-height:25px;">ราคารวม : <?=number_format($total,'2','.',',')?>&nbsp;&nbsp;&nbsp;</div>	 
	</div>	



	


	</div>		
	</div>




</div>



</div>