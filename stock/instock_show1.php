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

//$sql_del = "delete from tb_temp_drugeinstock where lno='$lno'";
//mysql_query($sql_del) or die ("Error Query [".$sql_del."]"); 
?>

<div style="width:99%; height:auto; float:left; margin-left:40px;">

	<div style="width:100%; height:auto; float:left;">
		<div class="line" >
			<div style="width:15%; float:left; text-align:left;">Lot No :&nbsp;</div>		
			<div style="width:85%; float:left; text-align:left;"><input type="text" id="lno" size="10"  value="<?=$lno?>"  style="border:#FFFFFF;"/></div>		
		</div>	
			
		<div class="line" style="height:20px;">
			<div style="width:15%; float:left; text-align:left;">เลขที่บิล &nbsp;</div>		
			<div style="width:35%; float:left; text-align:left;">ชื่อผู้ขาย &nbsp;</div>	
	
		</div>	
		<div class="line" >		
			<div style="width:15%; float:left;"><input type="text" id="sid" size="10"  /></div>		
			<div style="width:35%; float:left;"><input type="text" id="sname" size="30"    /></div>	

		</div>			
			
		<div class="line" >		


		
		</div>						
		
	
	</div>
	<div style="width:100%; height:auto; float:left; border:<?=$tabcolor?> 1px solid;">
		<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">  			<div style="width:40%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
			<div style="width:10%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา/หน่วย</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคารวม</div>
		</div>
	
	</div>
    <div id="dlist" style="width:100%; height:280px; float:left; overflow:auto; border:<?=$tabcolor?> 1px solid;">
<?
include('../class/config.php');	
$cl = $color1;
$sql = "select * from tb_temp_drugeinstock where lno='$lno' order by dname";
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
	
	<div style="width:42%; float:left; line-height:20px;"><?=$rs['dname']?></div>
	<div style="width:15%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['qty'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	</div>
	<div style="width:11%; float:left; line-height:20px;"><?=$rs['unit']?></div>
	<div style="width:16%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['price'],'2','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div style="width:10%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['totalprice'],'2','.',',') ?>&nbsp;&nbsp;&nbsp;
	</div>
	<div style="width:5%; float:left; text-align:right; line-height:20px;">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('stock/del_temp_instock.php','dlist','did=<?=$rs['did']?>&lno=<?=$rs['lno']?>')" />
	</div>
</div>
<? 

} 
}
mysql_close($dblink);
?>
	
	</div>
    <div style="width:100%; height:auto; float:left;  text-align:center; padding-top:5px;">
	<input type="button" value="  นำยาเข้าคลัง  " style="font-size:14px; font-weight:bold; height:35px;" onclick="addinstock('stock/add_instock.php','content')" >
	<input type="button" value="  รายการใหม่  " style="font-size:14px; font-weight:bold; height:35px;" onclick="swabtab(3,5,'stock/instock.php','content','')">
	</div>


</div>