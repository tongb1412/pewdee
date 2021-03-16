<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_GET['mode'];
?>

<div style="width:100%; height:420px; text-align:left; overflow:auto ">

	<?
$n=1; $total = 0;
$sql = "select * from tb_drugerec where vn='$vn' and pid='-' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
		<div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">ยา</div>

	</div>
	<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total + ( $rs['price'] *$rs['qty'] );
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

?>

	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
		<div style="width:5%;float:left; "><?= $n . '.' ?></div>
		<div style="width:65%;float:left; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['dname'] ?>&nbsp;</div>
		<div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= number_format($rs['price'] * $rs['qty'], '2', '.', ',') ?>&nbsp;</div>

	</div>
	<? 
$n++; 
} 

$sql = "select * from tb_labrec where vn='$vn' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
		<div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">หัตถการ / แล็บ</div>

	</div>
	<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total + ( $rs['price'] *$rs['qty'] );
if($cl != $color1){
	$cl = $color2;
} else {
	$cl = $color2;
}

$price = $rs['price'];
?>
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
		<div style="width:5%;float:left; "><?= $n . '.' ?></div>
		<div style="width:65%;float:left; cursor:pointer;" onClick="movelabEdit('<?= $rs['lid'] ?>','<?= $rs['lname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>')">
			<?= $rs['lname'] ?>&nbsp;</div>
		<div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movelabEdit('<?= $rs['lid'] ?>','<?= $rs['lname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>')">
			<?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movelabEdit('<?= $rs['lid'] ?>','<?= $rs['lname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>')">
			<?= number_format($rs['price'] * $rs['qty'], '2', '.', ',') ?>&nbsp;</div>

	</div>
	<? 
$n++; 
}
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('T','L') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
		<div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">ทรีทเม้นท์ / เลเซอร์</div>

	</div>
	<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
$total = $total + ( $rs['price'] *$rs['qty'] );
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
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
		<div style="width:5%;float:left; "><?= $n . '.' ?></div>
		<div style="width:65%;float:left; cursor:pointer;" onClick="movelaserEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>','<?= $rs['unit'] ?>','<?= $eid ?>','<?= $ename ?>')">
			<?= $rs['tname'] ?>&nbsp;</div>
		<div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movelaserEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>','<?= $rs['unit'] ?>','<?= $eid ?>','<?= $ename ?>')">
			<?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movelaserEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>','<?= $rs['unit'] ?>','<?= $eid ?>','<?= $ename ?>')">
			<?= number_format($rs['totalprice'], '2', '.', ',') ?>&nbsp;</div>

	</div>
	<? 
$n++; 
}
$sql = "select * from tb_pctrec where vn='$vn' and typ IN ('P','C') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
		<div style="width:100%;float:left; font-weight:bold; color:#0033FF; ">คอร์ท / แพ็คเกจ</div>

	</div>
	<?
}
$cl = $color1;
while($rs=mysql_fetch_array($result)){ 
	$total = $total + ( $rs['price'] *$rs['qty'] );
	if($cl != $color1){
		$cl = $color2;
	} else {
		$cl = $color2;
	}

	$price = $rs['price'];

	?>
		<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
			<div style="width:5%;float:left; "><?= $n . '.' ?></div>
			<div style="width:65%;float:left; cursor:pointer;" onClick="movepctEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>')">
				<?= $rs['tname'] ?>&nbsp;</div>
			<div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movepctEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>')">
				<?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movepctEdit('<?= $rs['tid'] ?>','<?= $rs['tname'] ?>','<?= $rs['qty'] ?>','<?= $price ?>','<?= $rs['typ'] ?>','<?= $rs['totalprice'] ?>')">
				<?= number_format($rs['totalprice'], '2', '.', ',') ?>&nbsp;</div>

		</div>
		<? 
	$n++; 
}
$sql = "select * from tb_drugerec where vn='$vn' and pid <> '-' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
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

	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
		<div style="width:5%;float:left; "><?= $n . '.' ?></div>
		<div style="width:65%;float:left; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['dname'] ?>&nbsp;</div>
		<div style="width:15%;float:left; cursor:pointer; text-align:right" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div style="width:15%;float:left; text-align:right; cursor:pointer;" onClick="movedrugeEdit('<?= $rs['did'] ?>','<?= $rs['dname'] ?>','<?= $rs['qty'] ?>','<?= $rs['unit'] ?>','<?= $rs['price'] ?>')"><?= number_format($rs['price'] * $rs['qty'], '2', '.', ',') ?>&nbsp;</div>

	</div>
	<? 
$n++; 
} 
$sql = "select * from tb_pctuse where uvn='$vn' and ftyp IN ('P','C') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$num = mysql_num_rows($result);
if(!empty($num)){
?>
	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px;  ">
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

	<div style="width:98%; height:20px; line-height:20px; text-align:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">
		<div style="width:5%;float:left; "><?= $n . '.' ?></div>
		<div style="width:65%;float:left; "><?= $rs['tname'] ?>&nbsp;</div>
		<div style="width:15%;float:left;  text-align:right"><?= $rs['qty'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div style="width:15%;float:left; text-align:right; "><input type="button" value="  " class="btn_del" onclick="pctUseDelete('doctor/pctuse_del.php','content','<?= $rs['uvn'] ?>','<?= $rs['tid'] ?>','<?= $rs['empid'] ?>','<?= $rs['ftyp'] ?>')" title="ลบ" alt="ลบ" /> </div>

	</div>
	<? 
$n++; 
} 
?>




</div>
<div style="width:100%; height:25px; float:left; font-size:16px; font-weight:bold; color:#FF0000; background:#CCCCCC; border-top:#CCCCCC 1px dotted;">
	<div class="line">
		<div style="width:70%; float:left; text-align:right; line-height:25px;">รวมเงิน :&nbsp;</div>
		<div style="width:30%; float:left; text-align:right; line-height:25px;">
			<?= number_format($total, '2', '.', ',') ?>&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	</div>
</div>