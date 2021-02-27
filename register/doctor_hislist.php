<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$tid = $_POST['tid'];
$tname = $_POST['tname'];


?>
<div class="line" style="height:20px; line-height:20px;">	
	<div style="width:60%; float:left; text-align:right">
	ชื่อ : <?=$tid;?> <?=$tname;?>
	</div>
	
	<div style="width:98%; height:20px;padding-top:5px;margin-left:5px;  margin-top:5px; color:#000000; font-weight:bold; float:left; font-size:13px;background:<?=$tabcolor?>;">
				<div style="width:15%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
				<div style="width:25%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่ทำ</div>
				<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
				<div style="width:40%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้ทำ</div>
				
	</div>	

<?


$sql = "select * from tb_pctuse where vn='$vn' and pid ='$tid'  order by dat";

$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$n=1;
while($rs=mysql_fetch_array($result)){  
	if($cl != $color1){
		$cl = $color1;
	} else {
		$cl = $color2;
	}
?>



<div  style="width:98%; height:20px; line-height:20px; text-align:left; float:left; margin-left:5px; border-bottom:#CCCCCC 1px dotted; " onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')"   > 

	<div style="width:15%; float:left;"  ><?=$n?>&nbsp;</div>
	<div style="width:20%; float:left;  height:20px; "><?=$rs['dat']?>&nbsp;</div>
	<div style="width:20%; float:left; text-align:right;" ><?=$rs['qty'];?>&nbsp;</div>
	<div style="width:45%; float:left; " >&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['ename'];?></div>

</div>


<? $n++; } ?>




