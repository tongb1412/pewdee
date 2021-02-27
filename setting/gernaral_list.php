<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$mode = $_GET['mode'];
$cl = '';

?>
<div style="width:83%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
			<div style="width:20%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
			<? if($mode!='PT' && $mode!='LB' && $mode!='GTR' && $mode!='GTC'){ ?>
			<div style="width:80%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
			<? } else { 
			if($mode=='LB'){ $ss ='ราคา'; } else { $ss = 'ส่วนลด';  }
			if($mode=='GTR' || $mode=='GTC'){ $ss ='เปอเซนต์'; }
			?>
			<div style="width:50%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
			<div style="width:30%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;<?=$ss?></div>
			<? } ?>
</div>
		
<? 
$cl = $color1;
$sql = "select * from tb_gernaral where typ='$mode'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

$Per_Page = 15;   // Per Page

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
$sql .=" order by name asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
$Num = mysql_num_rows($result);

if($result){

$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:80%;background:<?=$cl?>; "  >
	<div style="width:22%; float:left;"><?=$n?></div>
	<? if($mode!='PT' && $mode!='LB' && $mode!='GTR' && $mode!='GTC' ){ ?>	
	<div style="width:68%; float:left;"><?=$rs['name']?></div>
	<? } else { ?>
	<div style="width:53%; float:left;"><?=$rs['name']?></div>
	<div style="width:15%; float:left;"><?=$rs['discount']?></div>
	<? } ?>
	<div style="width:10%; float:left; text-align:right">
    <img src="images/icon/pedit.png" align="แก้ไขข้อมูล" title="แก้ไขข้อมูล" style="cursor:pointer;" onClick="editgernaral('<?=$rs['name']?>','<?=$rs['id']?>','<?=$rs['discount']?>');" />
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('setting/gernaral_del.php','d_list','id=<?=$rs['id']?>&mode=<?=$mode?>')" />
	</div>
</div>
<? $n++; } ?>


<div style="width:83%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
 <?=$Num_Rows;?> 
  รายการ :hh 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','setting/gernaral_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";	

	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/gernaral_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>


<? } ?>