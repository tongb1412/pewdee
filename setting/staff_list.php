<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$txtserch = $_GET['txt'];

$cl = $color1;
if(empty($txtserch)){
	$sql = "select * from tb_staff ";
} else {
	$sql = "select * from tb_staff where staffid like '%$txtserch%' or nickname like '%$txtserch%' or fname like '%$txtserch%' or lname like '%$txtserch%' ";
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
$sql .=" order by staffid desc LIMIT $Page_Start , $Per_Page";

$result  = mysql_query($sql);
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
	<div style="width:30%; float:left;"><?=$rs['staffid']?>&nbsp;</div>
	<div style="width:55%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?>&nbsp;</div>
	<div style="width:15%; float:left; text-align:right;">
	<img src="images/icon/pdetail.png" align="รายละเอียด" title="แก้ไข" style="cursor:pointer;" onclick="ajaxLoad('post','setting/edit_employee.php','sid=<?=$rs['staffid']?>','staffedit')" />&nbsp;<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick=""/>
	
	</div>
</div>
<? } ?>

<div style="width:98%; margin:auto; margin-top:10px; text-align:right; line-height:20px; float:left;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','setting/staff_list.php','txt=<?=$txtserch?>&Page=<?=$Prev_Page?>','d_tall')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}

		echo	" <b>$Page </b>";			
		
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/staff_list.php','txt=<?=$txtserch?>&Page=<?=$Next_Page?>','d_tall')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>
<? } ?>