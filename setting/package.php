<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

?>
<div id="t_main" class="tmain" style="width:100%; margin:auto; height:495px; overflow:hidden; text-align:center ">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >สร้างรายการแพ็คเกจ</div>
  
  <div id="clist" style="width:90%; height:auto; margin:auto; text-align:right; margin-top:10px;">
  
  
  <div style="width:100%; height:auto; margin:auto; text-align:right; margin-top:10px; float:left;">
  <input type="button" value="  สร้างรายการใหม่  " onClick="ajaxLoad('post','setting/new_package.php','','clist')">
  </div>
  
  
  <div style="width:100%; height:auto; margin:auto; margin-top:5px; float:left;">
  	<div style="width:100%; height:20px; float:left; color:#000000; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; "> 
	
		<div style="width:15%;text-align:left; float:left;  line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:55%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อรายการ</div>
		
		<div style="width:20%;text-align:left; float:left; line-height:20px;">
		&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคาต่อหน่วย</div>
	
	</div>	  
  </div>
  <div style="width:100%; height:auto; margin:auto; float:left;">
  
  
  
<? 
$cl = $color1;
$sql = "select * from tb_package ";
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
$sql .=" order by pid asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
$Num = mysql_num_rows($result);

if($result){


while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:96%; margin:auto; background:<?=$cl?>">
	
	<div style="width:15%; float:left;"><?=$rs['pid']?></div>
	<div style="width:45%; float:left;"><?=$rs['name']?></div>

	<div style="width:30%; float:left; text-align:right">
	<? echo number_format($rs['price'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div style="width:10%; float:left; text-align:right;">

	<img src="images/icon/pedit.png" align="แก้ไขข้อมูล" title="แก้ไขข้อมูล" style="cursor:pointer;" onClick="ajaxLoad('post','setting/new_package.php','cid=<?=$rs['pid']?>','clist')" />
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('setting/package_del.php','settingpage','id=<?=$rs['pid']?>')" />
	</div>
</div>
<? } ?>


<div style="width:100%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','setting/package.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','settingpage')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
    echo " <b>$Page </b>";	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/package.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','settingpage')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>


<? } ?>		
  
  
  
  
  
  
  </div>
  
  
  </div>
  
 
  
</div>