<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:100%; height:370px; float:left;">
<?
include('../class/config.php');
$txtserch = $_GET['txt'];

$cl = $color1;
if(empty($txtserch)){
	$sql = "select * from tb_laser ";
} else {
	$sql = "select * from tb_laser where lid like '%$txtserch%'  or lname like '%$txtserch%'  ";
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
$sql .=" order by lname asc LIMIT $Page_Start , $Per_Page";

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
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>; width:90%; cursor:pointer;" onclick="laserinstock_movetxt('<?=$rs['lid']?>','<?=$rs['lname']?>','<?=$rs['unit']?>')" >

	<div style="width:100%; float:left; font-size:12px;"><?=$rs['lname']?>&nbsp;</div>

</div>
<? } ?>

<? } ?>
</div>
<div style="width:98%; margin:auto; margin-top:10px; text-align:right; line-height:20px; float:left;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','stock/druge_list.php','txt=<?=$txtserch?>&Page=<?=$Prev_Page?>','p_list')">	
	<img src='../stock/images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
		echo " <b>$Page </b>";			
	
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','stock/druge_list.php','txt=<?=$txtserch?>&Page=<?=$Next_Page?>','p_list')">	
	<img src='../stock/images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>