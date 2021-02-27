<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? include('../class/config.php'); ?>
<div style="width:99%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
    <div style="width:15%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;VN</div>
	<div style="width:10%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัสคนไข้</div>
	<div style="width:10%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Card No.</div>
	<div style="width:25%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ - สกุล</div>
	<div style="width:25%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพทย์ผู้ตรวจ</div>
	<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลาเข้า</div>
</div>
<div id="p_list" style=" width:100%; margin-top:5px; text-align:center; height:auto;">

<?

$cl = $color1;
$txtserch = $_GET['txt'];

if(empty($txtserch)){
	$sql = "select * from tb_patient a,tb_vst b where a.hn=b.hn and b.status = 'DOC' ";
} else {
	$sql = "select * from tb_patient a,tb_vst b where (a.hn=b.hn) and (b.status = 'DOC') and (a.cradno like '%$txtserch%' or a.hn like '%$txtserch%' or a.fname like '%$txtserch%' or a.lname like '%$txtserch%') ";
}



$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

$Per_Page = 18;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])	{	$Page=1;	}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
		$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
		$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
}
$sql .=" order by b.vn asc LIMIT $Page_Start , $Per_Page";

$result  = mysql_query($sql) or die ("Error Query [".$sql."]"); 
if($result){
$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}


?>
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>" >
	<div style="width:15%; float:left; cursor:pointer;" onClick="swabtab(2,3,'doctor/doctor_form.php','content','mode=<?=$rs['vn']?>')"  >
	<?=$rs['vn']?>&nbsp;
	</div>
	<div style="width:10%; float:left; cursor:pointer;" onClick="swabtab(2,3,'doctor/doctor_form.php','content','mode=<?=$rs['vn']?>')" >
	<?=$rs['hn']?>&nbsp;
	</div>
	<div style="width:10%; float:left; cursor:pointer;" onClick="swabtab(2,3,'doctor/doctor_form.php','content','mode=<?=$rs['vn']?>')" >
	<?=$rs['cradno']?>&nbsp;
	</div>
	<div style="width:26%; float:left; cursor:pointer;" onClick="swabtab(2,3,'doctor/doctor_form.php','content','mode=<?=$rs['vn']?>')" >
	<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?>&nbsp;
	</div>
	<div style="width:25%; float:left; cursor:pointer;" onClick="swabtab(2,3,'doctor/doctor_form.php','content','mode=<?=$rs['vn']?>')" >
	<? if($rs['empid'] != '00'){ echo $rs['empname']; } else { echo 'ไม่ระบุแพทย์'; } ?>&nbsp;
	</div>
	<div style="width:8%; float:left; cursor:pointer;" onClick="swabtab(2,3,'doctor/doctor_form.php','content','mode=<?=$rs['vn']?>')" >
	<?=substr($rs['vdate'],11,9)?>&nbsp;
	</div>
	<div style="width:5%; text-align:right; float:left;"  >	
	<img src="images/icon/cc.png" align="ส่งกลับเวชระเบียน" title="ส่งกลับเวชระเบียน" style="cursor:pointer;" onclick="sendpatient('hn=<?=$rs['hn']?>&vn=<?=$rs['vn']?>','doctor/sendpatient.php','sd')" />
	</div>
</div>
<? } ?>

<div style="width:99%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','register/patient_list.php','txt=<?=$txtserch?>&Page=<?=$Prev_Page?>','p_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	for($i=1; $i<=$Num_Pages; $i++){
		if($i != $Page)
		{
	?>		
	<a href="javascript: ajaxLoad('get','register/patient_list.php','txt=<?=$txtserch?>&Page=<?=$i?>','p_list')"><?=$i?></a>	
	<?
		}
		else
		{ 	
			if($Num_Pages!= 1){	echo " <b>$i </b>";}			
		}
	}
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','register/patient_list.php','txt=<?=$txtserch?>&Page=<?=$Next_Page?>','p_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>


</div>
