<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
<?
include('../class/config.php');
$mode = $_GET['mode'];
$cl = '';
$dat = date('d-m-Y',time());

?>
			<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
				<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
				<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลา</div>
				<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
				<div style="width:35%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
				<div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพทย์</div>
			</div>
		
<? 
$cl = $color1;
$sql = "select distinct(a.hn) hn,a.pdate,b.cradno,b.pname,b.fname,b.lname,substr(c.vdate,12,8) vdate,c.empname  ";
$sql .="from tb_payment a,tb_patient  b,tb_vst c where (a.hn = b.hn) and (a.hn = c.hn) and  (a.pdate like '%$dat%') group by a.hn";
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
$sql .=" order by a.billno asc LIMIT $Page_Start , $Per_Page";
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
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:99%;background:<?=$cl?>; ">
	<div style="width:8%; height:20px; text-align: left; right line-height:20px;  float:left; "><?=$n?></div>
	<div style="width:15%; height:20px; text-align:left; line-height:20px;  float:left; ">&nbsp;&nbsp;&nbsp;<?=$rs['vdate']?></div>
	<div style="width:15%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['cradno']?></div>
	<div style="width:35%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:22%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['empname']?></div>

	
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
	<a href="javascript: ajaxLoad('get','daily_report/repatient_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','daily_report/repatient_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>



	

