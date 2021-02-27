<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">

<?
include('../class/config.php');
$cl = '';
$dat = date('d-m-Y',time());

?>
    <div style="width:99%; height:50px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
		<div class="line" >
      		<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      		<div style="width:50%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ/</div>
      		<div style="width:30%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายจ่าย</div>
		</div>
		<div class="line" >
      		<div style="width:20%;text-align:left; float:left;">&nbsp;&nbsp;</div>
      		<div style="width:50%;text-align:left; text-align: left; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หมายเหตุ</div>
      		<div style="width:30%;text-align:left; text-align:center; float:left;">&nbsp;&nbsp;เงินสด</div>
		</div>
		
		
    </div>
	
		
<? 




$cl = $color1;
$sql = "select  *  from tb_costs where (date like '%$dat%')   ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 


$n=1;
$Per_Page = 14;   // Per Page

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
$sql .=" order by id asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){

while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}


?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:94%;;background:<?=$cl?>; ">
	<div style="width:15%; float:left;"><?=$n?></div>
	<div style="width:50%; float:left;"><?=$rs['name']?></div>
	<div style="width:28%; float:left; text-align:right;"><?=number_format($rs['total'],'2','.',',')?></div>						
	
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
	<a href="javascript: ajaxLoad('get','daily_report/retypepay_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','daily_report/retypepay_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>

</div>

<!--รวม-->

<div id="d_list2" style=" width: 98%; margin-top:10px;   text-align:center; height:30px; background-color:#FFCC99;  ">
	
<?
include('../class/config.php');
$dat = date('d-m-Y',time());
$sql = "select date,sum(total) s_cash from tb_costs  where date like '%$dat%'  group by 'date%'  ";

$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
$row=mysql_fetch_array($s_result);



?>	

	<div class="line" style="margin-top: 4px;">

      <div style="width:60%; float:left; text-align:right;">รวมรายจ่ายเงินสด :&nbsp;</div>
      <div style="width:40%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_cash'],'2','.',',')?>"/>
      </div>


	
	</div>
</div>












