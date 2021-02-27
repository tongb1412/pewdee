<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; margin:auto; height:390px; float:left; margin-left:5px; margin-top:-5px; border:<?=$tabcolor?> 1px solid;">

<?

$txtserch = $_GET['txt'];

$cl = $color1;
if(empty($txtserch)){
	$sql = "select * from tb_druge where status='IN' ";
} else {
	$sql = "select * from tb_druge where (did like '%$txtserch%'  or gname like '%$txtserch%' or tname like '%$txtserch%'  or dgroup like '%$txtserch%') and (status='IN') ";
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
$sql .=" order by tname asc LIMIT $Page_Start , $Per_Page";

$result  = mysql_query($sql);
if($result){
$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

$did = $rs['did'];
$sql1 = "select sum(total) as total from tb_drugeinstock where did='$did' and total > 0 ";

$rst = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
$num  = mysql_num_rows($rst);
$dtotal = 0;
if(!empty($num)){
	$rss=mysql_fetch_array($rst);
	$dtotal = $rss['total'];
}

?>
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>; width:97%; cursor:pointer;" onclick="swabtab(5,5,'stock/druge_edit_from.php','content','did=<?=$rs['did']?>')" >
	<div style="width:15%; float:left;"><?=$rs['did']?>&nbsp;</div>	
	<div style="width:30%; float:left;"><?=$rs['tname']?>&nbsp;</div>
	<div style="width:21%; float:left;"><?=$rs['dgroup']?>&nbsp;</div>
	<div style="width:10%; float:left; text-align:right">
	<? echo number_format($rs['total'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div style="width:10%; float:left;"><?=$rs['unit']?>&nbsp;</div>
	<div style="width:13%; float:left; text-align:right;">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('stock/druge_del.php','p_list','id=<?=$rs['did']?>')"/>
	
	</div>
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
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}

		echo	" <b>$Page </b>";			
		
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','stock/druge_list.php','txt=<?=$txtserch?>&Page=<?=$Next_Page?>','p_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>