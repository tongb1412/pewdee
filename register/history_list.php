<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];

$sql = "select empname from tb_vst where vn='$vn' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$rs=mysql_fetch_array($result);
$stotal = 0;
?>
<div class="line" style="height:20px; line-height:20px;">	
	<div style="width:60%; float:left; text-align:right">
	แพทย์ : <?=$rs['empname'];?> 
	</div>
	<div style="width:40%; float:left; text-align:right">
		<input type="button" value="พิมพ์ใบเสร็จ"  onclick="formpreprint('vn=<?=$vn?>','register/frmprint.php','sd')"  style="display:none;"/>
        
        <input type="button" value="ยกเลิกใบเสร็จ"  onclick="formpreprint('vn=<?=$vn?>','register/cbil.php','sd')" />
	</div>
</div>
<?
$n=1; $total = 0; 
$sql = "select * from tb_drugerec where vn='$vn' and pid='-' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>

<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold; color:#0033FF;">ยา</div>
</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total + ( $rs['price'] *$rs['qty'] );
$stotal = $stotal + ( $rs['price'] *$rs['qty'] );
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

?>

<div  style="width:98%; height:20px; line-height:20px; text-align:left; float:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; " ><?=$rs['dname']?>&nbsp;</div>
	<div style="width:15%;float:left;  text-align:right"><?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " ><?=number_format($rs['price'] *$rs['qty'] ,'2','.',',')?>&nbsp;</div>

</div>
<? 
$n++; 
} 

$sql = "select * from tb_labrec where vn='$vn' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold;color:#0033FF;">หัตถการ / แล็บ</div>

</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total + ( $rs['price'] *$rs['qty'] );
$stotal = $stotal + ( $rs['price'] *$rs['qty'] );
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

$price = $rs['price'];
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; float:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; ">
	<?=$rs['lname']?>&nbsp;</div>
	<div style="width:15%;float:left; text-align:right" >
	<?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " >
	<?=number_format($rs['price'] *$rs['qty'] ,'2','.',',')?>&nbsp;</div>

</div>
<? 
$n++; 
}
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('T','L') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">ทรีทเม้นท์ / เลเซอร์</div>

</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total +  $rs['totalprice'] ;
$stotal = $stotal + $rs['totalprice'] ;
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

$price = $rs['price'];
$pid = $rs['tid'];
$sqlu = "select empid,ename from tb_pctuse where vn='$vn' and pid='$pid' and ftyp='T' ";
$ustr = mysql_query($sqlu) or die ("Error Query [".$sqlu."]");	
$ru=mysql_fetch_array($ustr);
$eid = $ru['empid'];
$ename = $ru['ename'];
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; float:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; ">
	<?=$rs['tname']?>&nbsp;</div>
	<div style="width:15%;float:left;  text-align:right">
	<?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " >
	<?=number_format($rs['totalprice'],'2','.',',')?>&nbsp;</div>

</div>
<? 
$n++; 
}
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('P','C') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">คอร์ท / แพ็คเกจ</div>

</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total +  $rs['totalprice'] ;
$stotal = $stotal + $rs['totalprice'] ;
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

$price = $rs['price'];

?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; float:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; " >
	<?=$rs['tname']?>&nbsp;</div>
	<div style="width:15%;float:left;  text-align:right" >
	<?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; ">
	<?=number_format($rs['totalprice'],'2','.',',')?>&nbsp;</div>

</div>
<? 
$n++; 
}

$sql = "select * from tb_drugerec where vn='$vn' and pid <> '-' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold; color:#0033FF;">ยาชุดแพ็คเกจ ( <span style="color:#FF0000">ไม่คิดเงิน</span> ) </div>

</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 

if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

?>

<div  style="width:98%; height:20px; line-height:20px; text-align:left; float:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; " ><?=$rs['dname']?>&nbsp;</div>
	<div style="width:15%;float:left; text-align:right" ><?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; "><?=number_format($rs['price'] *$rs['qty'] ,'2','.',',')?>&nbsp;</div>

</div>
<? 
$n++; 
} 

$sql = "select * from tb_pctuse where uvn='$vn' and ftyp IN ('P','C') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  "   > 
	<div style="width:100%;float:left; font-weight:bold; color:#0033FF;">รายการใช้ทรีทเม้นท์ </div>

</div>
<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 

if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

?>

<div  style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; float:left; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 
	<div style="width:5%;float:left; "><?=$n.'.'?></div>
	<div style="width:65%;float:left; "><?=$rs['tname']?>&nbsp;</div>
	<div style="width:15%;float:left;  text-align:right" ><?=$rs['qty']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " ></div>

</div>
<? 
$n++; 
} 


?>





<div  style="width:98%; height:20px; line-height:20px; font-weight:bold; text-align:left; margin-left:5px; float:left; border-bottom:#CCCCCC 1px dotted; background:#CCCCCC; "  > 
	<div style="width:5%;float:left; ">&nbsp;</div>
	<div style="width:60%;float:left; ">&nbsp;</div>
	<div style="width:20%;float:left;  text-align:right" >รวมเงินทั้งหมด :&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " ><?=number_format($stotal,'2','.',',')?>&nbsp;</div>

</div>

<?
$sqla = "select * from tb_payment where vn='$vn' ";
$astr = mysql_query($sqla) or die ("Error Query [".$sqla."]");	
$a=mysql_fetch_array($astr);
$discount = $a['discount'];
$ku = $a['ku'];
$atotal = $a['cash'] + $a['credit'] ;

?>

<div  style="width:98%; height:20px; line-height:20px; font-weight:bold; text-align:left; margin-left:5px; float:left; border-bottom:#CCCCCC 1px dotted; background:#CCCCCC; "  > 
	<div style="width:55%;float:left; text-align:right ">คูปอง :&nbsp;</div>
	<div style="width:15%;float:left; "><?=number_format($ku,'2','.',',')?>&nbsp;</div>
	<div style="width:15%;float:left;  text-align:right" >ส่วนลด :&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " ><?=number_format($discount,'2','.',',')?>&nbsp;</div>

</div>

<div  style="width:98%; height:20px; line-height:20px; font-weight:bold; text-align:left; margin-left:5px; float:left; border-bottom:#CCCCCC 1px dotted; background:#CCCCCC; "  > 
	<div style="width:5%;float:left; ">&nbsp;</div>
	<div style="width:65%;float:left; ">&nbsp;</div>
	<div style="width:15%;float:left;  text-align:right" >รวมรับเงิน :&nbsp;</div>
	<div style="width:15%;float:left; text-align:right; " ><?=number_format($atotal,'2','.',',')?>&nbsp;</div>

</div>

