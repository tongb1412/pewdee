<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$did = $_GET['did'];
$sql = "select * from tb_druge where did='$did'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);


$sql1 = "select sum(total) as total from tb_drugeinstock where did='$did' and total > 0 ";

$rst = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
$num  = mysql_num_rows($rst);
$dtotal = 0;
if(!empty($num)){
	$rss=mysql_fetch_array($rst);
	$dtotal = $rss['total'];
}


?>
<div style="width:100%; height:470px; margin:auto; margin-top:20px; text-align:center;">

<div style="width:45%; height:440px; margin:auto; float:left; margin-left:20px; ">
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">รหัสยา :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="did" size="20" value="<?=$did?>" /></div>
		<div style="width:20%; float:left; text-align:right;">Barcode :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="bcode" size="20" value="<?=$row['barcode']?>" /></div>	
	</div>
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">ชื่อสามัญทางยา :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="gname" size="58" value="<?=$row['gname']?>" /></div>
	</div>	
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">ชื่อทางการค้า :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="tname" size="58" value="<?=$row['tname']?>" /></div>
	</div>	
	<div class="line" style="height:20px;" >&nbsp;</div>
<?
$dgid = $row['dgid'];
$sql = "select * from tb_gernaral where typ='DG' and id <> '$dgid'  ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">กลุ่มยา :&nbsp;</div>
		<div style="width:80%; float:left;">
		<select id="dgid" style="width:360px;">
		<option value="<?=$row['dgid']?>"><?=$row['dgroup']?></option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['id']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>		
		</div>
	</div>
<?
$tid = $row['tid'];
$sql = "select * from tb_gernaral where typ='DT' and id <> '$tid'  ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">ประเภท :&nbsp;</div>
		<div style="width:80%; float:left;">
		<select id="tid" style="width:360px;">
		<option value="<?=$row['tid']?>"><?=$row['typname']?></option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['id']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>		
		</div>
	</div>	
	
	<div class="line" style="height:20px;" >&nbsp;</div>
<?
$unit = $row['unit'];
$sql = "select * from tb_gernaral where typ='DN' and  name <> '$unit' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>	
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">คงเหลือ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="total" size="20" value="<?=$row['total']?>" readonly="true" style="background:#CCCCCC; border:1px solid #CCCCCC" /></div>
		<div style="width:20%; float:left; text-align:right;">หน่วย :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="unit" style="width:131px;">
		<option value="<?=$unit?>"><?=$unit?></option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>				
		</div>	
	</div>	
	
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">ต้นทุน :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="bprice" size="20" value="<?=$row['bprice']?>" readonly="true" sstyle="background:#CCCCCC; border:1px solid #CCCCCC" /></div>
		<div style="width:20%; float:left; text-align:right;">ราคาขาย :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="sprice" size="20" value="<?=$row['sprice']?>"  /></div>	
	</div>		
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">จุดสั่งซื้อ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="sqty" size="20"  value="<?=$row['sqty']?>"/></div>
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:30%; float:left;">&nbsp;</div>	
	</div>	
	<div class="line" style="height:20px;" >&nbsp;</div>	
	
<?
$duse = trim($row['duse']);
$sql = "select * from tb_gernaral where typ='DU' and name <> '$duse' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">วิธีใช้ :&nbsp;</div>
		<div style="width:80%; float:left;">
		<select id="duse" style="width:360px;">
		<option value="<?=$row['duse']?>"><?=$row['duse']?></option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>		
		</div>
	</div>	
<?
$wuse = trim($row['wuse']);
$sql = "select * from tb_gernaral where typ='DW' and name <> '$wuse' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">ข้อควรระวัง :&nbsp;</div>
		<div style="width:80%; float:left;">
		<select id="wuse" style="width:360px;">
		<option value="<?=$row['wuse']?>"><?=$row['wuse']?></option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>		
		</div>
	</div>		
<?
$huse = trim($row['huse']);
$sql = "select * from tb_gernaral where typ='DH' and name <> '$huse' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">วิธีเก็บ :&nbsp;</div>
		<div style="width:80%; float:left;">
		<select id="huse" style="width:360px;">
		<option value="<?=$row['huse']?>"><?=$row['huse']?></option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>		
		</div>
	</div>		
	
	
	
	
	
	<div class="line" style="height:30px;" >&nbsp;</div>	
	<div class="line" style="text-align:center;" >
		
		<div style="width:100%; float:left;"><input type="button" value="  แก้ไขข้อมูล  " style="font-size:14px; font-weight:bold; height:35px;" onclick="adddruge('EDIT')"  /></div>
	
	</div>		
		
</div>
<div style="width:45%; height:auto; margin:auto; float:left; margin-left:50px; ">
	<div style="width:100%; height:auto; float:left; margin-top:-5px; border:<?=$tabcolor?> 1px solid;">
		<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">  			<div style="width:25%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Lot No.</div>
			<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
			<div style="width:20%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา/หน่วย</div>
			
		</div>
	
	</div>
	<div id="dlist" style="width:100%; height:410px; float:left; overflow:auto; border:<?=$tabcolor?> 1px solid;">
<? 
include('../class/config.php');	
$cl = $color1;
$sql = "select * from tb_drugeinstock,tb_instock where tb_drugeinstock.lno = tb_instock.lno and tb_drugeinstock.did='$did' and tb_drugeinstock.total > 0 order by tb_drugeinstock.lno asc, tb_drugeinstock.dname asc";
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


<div style="width:95%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" >
	
	<div style="width:25%; float:left; line-height:20px;"><?=$rs['lno']?></div>
	<div style="width:20%; float:left; line-height:20px;"><?=$rs['ldate']?></div>
	<div style="width:20%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['qty'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	</div>
	<div style="width:15%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['total'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	</div>
	<div style="width:20%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['price'],'2','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>



</div>
<? 

} 
}
mysql_close($dblink);
?>	
	</div>
</div>

</div>