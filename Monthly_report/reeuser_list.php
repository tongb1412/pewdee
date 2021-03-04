<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
<?
include('../class/config.php');
$cl = '';

$did = $_POST['did'];

// if(!empty($_POST['edate'])){

//$nd = substr($_POST['edate'],0,2) + 1; 
//if(strlen($nd)==1){ $nd = '0'.$nd; }
//$sdate = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2)  ;
//$edate = substr($_POST['edate'],6,4).'-'.substr($_POST['edate'],3,2).'-'.$nd ;
//} else {
//$sdate = date('Y-m-d');
//$edate = date('Y-m-d');
//}

if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {


$t0 = strtotime($_POST['sdate']);
//$t1 = strtotime($_POST['edate']) + (1*24*3600); 
$t1 = strtotime($_POST['edate']); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
 $total = 0;
}


?>
    <div style="width:99%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
      <div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
      <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
      <div style="width:23%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อลูกค้า</div>
      <div style="width:9%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา</div>
	  <div style="width:21%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้ทำ</div>
    </div>
	
		
<? 
$cl = $color1;
if(empty($did)){
$sql = "select a.totalprice,b.tid,b.tname,b.qty,b.empid,b.ename,c.cradno,c.pname,c.fname,c.lname,(a.totalprice / a.qty) priceunit,((a.totalprice / a.qty)*b.qty) price";
$sql .= " from tb_pctrec a,tb_pctuse b,tb_patient c  where (a.hn = c.hn) and  (b.dat between '$sdate%' and '$edate%') and (a.vn = b.vn) and (a.tid = b.pid) ";
} else {
$sql = "select a.totalprice,b.tid,b.tname,b.qty,b.empid,b.ename,c.cradno,c.pname,c.fname,c.lname,(a.totalprice / a.qty) priceunit,((a.totalprice / a.qty)*b.qty) price";
$sql .= " from tb_pctrec a,tb_pctuse b,tb_patient c  where (a.hn = c.hn) and  (b.dat between '$sdate%' and '$edate%') and (a.vn = b.vn) and (a.tid = b.pid)   and (b.empid like '%$did%') ";
}
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 



$Per_Page = 14;   // Per Page

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
$sql .=" order by b.empid asc LIMIT $Page_Start , $Per_Page";
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
	<div style="width:8%; float:left;"><?=$rs['tid']?></div>
	<div style="width:22%; text-align:left; float:left;"><?=$rs['tname']?></div>	
	<div style="width:8%; float:left;">&nbsp;<?=number_format($rs['qty'],'0','.',',')?></div>
	<div style="width:23%; text-align:left; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:10%; float:left;">&nbsp;<?=number_format($rs['price'],'2','.',',')?></div>
	<div style="width:21%; text-align:left; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['ename']?></div>
								
	
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
	<a href="javascript: ajaxLoad('post','Monthly_report/reeuser_list.php','Page=<?=$Prev_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/reeuser_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','d_list')">	
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

<div id="d_list2" style=" width: 99%; margin-top:10px;   text-align:center; height:30px; background-color:#FFCC99;  ">
	
<?
include('../class/config.php');
//$dat = date('d-m-Y',time());
if(empty($did)){
$sql  = "select sum(((a.totalprice / a.qty)*b.qty)) s_total ";
$sql .= "from tb_pctrec a,tb_pctuse b,tb_patient c  where (a.hn = c.hn) and  (b.dat between '$sdate%' and '$edate%') and (a.vn = b.vn) and (a.tid = b.pid)  ";
} else {
$sql  = "select sum(((a.totalprice / a.qty)*b.qty)) s_total ";
$sql .= "from tb_pctrec a,tb_pctuse b,tb_patient c  where (a.hn = c.hn) and  (b.dat between '$sdate%' and '$edate%') and (a.vn = b.vn) and (a.tid = b.pid) and (b.empid like '%$did%') ";
}
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
$row=mysql_fetch_array($s_result);



?>	

	<div class="line" style="margin-top: 4px;">
	  <div style="width:20%; float:left; text-align:right;">รวมทั้งหมด :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_total'],'2','.',',')?>" />
      </div>
    </div>	
	
	
	
	
	</div>
