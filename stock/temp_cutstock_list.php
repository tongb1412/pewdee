
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$lno = $_GET['mode'];

$cl = $color1;
$sql = "select * from tb_temp_drugecutstock where lno='$lno' order by dname";
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

	<div style="width:15%; float:left; line-height:20px;"><?=$rs['did']?></div>
	<div style="width:42%; float:left; line-height:20px;"><?=$rs['dname']?></div>
	<div style="width:15%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['qty'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	</div>
	<div style="width:11%; float:left; line-height:20px;"><?=$rs['unit']?></div>
	<div style="width:10%; float:left; line-height:20px;">
	<? if($rs['typ']=='I') { echo 'รับเข้า'; } else { echo 'จ่ายออก'; } ?>
	</div>	

	<div style="width:5%; float:left; text-align:right; line-height:20px;">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('stock/del_temp_cutstock.php','dlist','did=<?=$rs['did']?>&lno=<?=$rs['lno']?>')"/>
	</div>
</div>
<? 

} 
}
mysql_close($dblink);
?>