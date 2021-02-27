<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$sql = "select * from tb_autonumber where typ='LT'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = explode('-',$rs['number']);
$n = strlen($x[1]);
$lno = $x[0].'-' ;
$txt = explode('-',$rs['last']);
$num = intval($txt[1]) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$lno .= $t; 

$sql_del = "delete from tb_temp_laserinstock where lno='$lno'";
mysql_query($sql_del) or die ("Error Query [".$sql_del."]"); 
?>
<div  style="width:27%; height:450px; float:left; text-align:center; margin-left:10px;">

	<div style="width:98%; height:auto; margin:auto; margin-top:10px;">
		<div class="txt_serch" style="width:260px">
		<input class="input_serch" type="text" id="txts" size="30" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('laser/laser_in_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','laser/laser_in_list.php','txt=','p_list')" />
		</div>
	</div>
	<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">    
		<div style="width:100%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อเลเซอร์</div>
	</div>	
	
    <div id="p_list" style="width:98%; height:400px; margin:auto;  border:<?=$tabcolor?> 1px solid;">
	<?  require("laser_in_list.php");	 ?>

    </div>

</div>
<div style="width:65%; height:auto; float:left; margin-left:40px;">

	<div style="width:100%; height:auto; float:left;">
		<div class="line" >
			<div style="width:15%; float:left; text-align:left;">Lot No :&nbsp;</div>		
			<div style="width:85%; float:left; text-align:left;"><input type="text" id="lno" size="10"  value="<?=$lno?>"  style="border:#FFFFFF;"/></div>		
		</div>	
			
		<div class="line" style="height:20px;">
		    <div style="width:15%; float:left; text-align:left;">รหัสเลเซอร์ &nbsp;</div>		
			<div style="width:35%; float:left; text-align:left;">ชื่อเลเซอร์ &nbsp;</div>
			<div style="width:15%; float:left; text-align:left;">เลขที่บิล &nbsp;</div>		
			<div style="width:35%; float:left; text-align:left;">ชื่อผู้ขาย &nbsp;</div>	
		
		</div>	
		<div class="line" >	
			<div style="width:15%; float:left;"><input type="text" id="lid" size="10" style="border:1px solid #CCCCCC; background:#CCCCCC"  /></div>		
			<div style="width:35%; float:left;"><input type="text" id="lname" size="30"  style="border:1px solid #CCCCCC; background:#CCCCCC"   /></div>		
			<div style="width:15%; float:left;"><input type="text" id="sid" size="10"  /></div>		
			<div style="width:35%; float:left;"><input type="text" id="sname" size="30"    /></div>	

		</div>			
		<div class="line" style="height:20px;" >
		    <div style="width:15%; float:left; text-align:left;">จำนวนรับ &nbsp;</div> 
		</div>			
		<div class="line" >		
		    <div style="width:15%; float:left;"><input type="text" id="qty" size="4"  />&nbsp;<span id="lunit"></span></div>	
			<div style="width:20%; float:left; text-align:right;">
			<input type="button" id="btnadd" value=" เพิ่ม " onclick="add_templaser_instock('stock/add_templaser_instock.php','dlist')">&nbsp;<input type="button" value=" ลบ " onclick="cleartemplaser()">
			</div>			
		</div>						
		
	
	</div>
	<div style="width:100%; height:auto; float:left; border:<?=$tabcolor?> 1px solid;">
		<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">  			<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Lot No</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>	
			<div style="width:35%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อเลเซอร์</div>
			<div style="width:10%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
		</div>
	
	</div>
    <div id="dlist" style="width:100%; height:280px; float:left; overflow:auto; border:<?=$tabcolor?> 1px solid;">
<?
include('../class/config.php');	
$cl = $color1;
$sql = "select * from tb_temp_laserinstock where lno='$lno' order by lname";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

if($result){

while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>


<div style="width:95%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" >
	
	<div style="width:20%; float:left; line-height:20px;"><?=$lno?></div>
	<div style="width:15%; float:left; line-height:20px;"><?=$rs['lid']?></div>
	<div style="width:35%; float:left; line-height:20px;"><?=$rs['lname']?></div>
	<div style="width:15%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['qty'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	</div>
	<div style="width:10%; float:left; line-height:20px;">&nbsp;&nbsp;&nbsp;<?=$rs['unit']?></div>
	
	<div style="width:5%; float:left; text-align:right; line-height:20px;">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;"  onClick="ConfDelete('stock/sql_laser_del.php','dlist','lno=<?=$lno?>&url=stock/temp_laserinstock_list.php.php')" />
	</div>
</div>
<? 

} 
}
mysql_close($dblink);
?>
	
	</div>
    <div style="width:100%; height:auto; float:left;  text-align:right; padding-top:5px;">
	<input type="button" value=" นำเลเซอร์เข้าคลัง " style="font-size:14px; font-weight:bold; height:35px;" onclick="addinstock('stock/add_laserinstock.php','content')" >
	<input type="button" value="  รายการใหม่  " style="font-size:14px; font-weight:bold; height:35px;" onclick="swabtab(2,3,'stock/laserinstock.php','content','')">
	</div>


</div>