<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
if(!empty($_POST['did'])){
$did = $_POST['did'];
} else {
$did = '';
}


$cl = '';

/*$nd = substr($_POST['edate'],0,2) + 1; 
if(strlen($nd)==1){ $nd = '0'.$nd; }
$sdate = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2)  ;
$edate = substr($_POST['edate'],6,4).'-'.substr($_POST['edate'],3,2).'-'.$nd ;*/

if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {


$t0 = strtotime($_POST['sdate']);
//$t1 = strtotime($_POST['edate']);
$t1 = strtotime($_POST['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
}




?>
    <div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
      <div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
      <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อบัตร</div>
      <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เลขที่บัตร</div>
	  <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวนเงิน</div>
      <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เลขที่ใบเสร็จ</div>
    </div>
	
		
<? 
$cl = $color1;
if(empty($did)){
	$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname  from tb_payment a,tb_patient  b where (a.hn = b.hn) and  (a.pdate between '$sdate%' and '$edate%') and (a.credit >0)  ";
} else {
	$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname  from tb_payment a,tb_patient  b where (a.hn = b.hn) and  (a.pdate between '$sdate%' and '$edate%') and (credit >0) and (a.creditname like '%$did%') ";
}
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 



$Per_Page = 15;   // Per Page

$Page = $_POST["Page"];
if(!$_POST["Page"])	{	$Page=1;	}
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
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:98%;;background:<?=$cl?>; ">
	<div style="width:8%; float:left;"><?=$n?></div>
	<div style="width:10%; float:left;"><?=$rs['cradno']?></div>
	<div style="width:22%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:15%; float:left;">&nbsp;<?=$rs['creditname']?></div>
	<div style="width:15%; float:left;">&nbsp;<?=$rs['credittype']?></div>
	<div style="width:15%; float:left;">&nbsp;<?=number_format($rs['credit'],'2','.',',')?></div>
	<div style="width:15%; float:left;"><?=$rs['billno']?></div>
	

	
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
	<a href="javascript: ajaxLoad('post','Monthly_report/recredit_list.php','Page=<?=$Prev_Page?>&sdate=<?=$sdate?>&edate=<?=$edate?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/recredit_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$edate?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>
