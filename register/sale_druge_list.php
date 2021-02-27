<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cl = $color1;
$vn = $_GET['mode'];

$n=1; $total = 0;
$sql = "select * from tb_drugerec where vn='$vn' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
?>
<div  style=" width:99%; margin-left:4px; height:350px;   border:<?=$tabcolor?> 1px solid; overflow:auto; ">

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