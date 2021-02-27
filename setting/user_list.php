<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$mode = $_GET['mode'];
$cl = '';
$dat = date('d-m-Y',time());

?>

		
<? 
$cl = $color1;
$sql = "select * from tb_user  ";
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
if($result){
$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:98%;background:<?=$cl?>; height:20px ">
	<div style="width:15%; float:left;"><?=$rs['empid']?></div>
	<div style="width:35%; float:left;">&nbsp;&nbsp;<?=$rs['name']?></div>
	<div style="width:20%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['username']?></div>
	<div style="width:20%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['password']?></div>
	<div style="width:10%; float:left; text-align:right "  >
    <img src="images/icon/pedit.png" align="แก้ไขข้อมูล" title="แก้ไขข้อมูล" style="cursor:pointer;" onClick="edituser('<?=$rs['empid']?>','<?=$rs['name']?>','<?=$rs['username']?>','<?=$rs['password']?>');" />
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('setting/user_del.php','cdlist','id=<?=$rs['empid']?>')" />																									  
	</div>
</div>






<? $n++; } ?>
<div style="width:83%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','setting/user_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','cdlist')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/user_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','cdlist')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>