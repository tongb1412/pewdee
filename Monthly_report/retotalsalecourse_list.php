<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
<?
include('../class/config.php');
$cl = '';

$did = $_POST['did'];
//$sdate = $_POST['sdate'];
//$edate = $_POST['edate'];

/*$nd = substr($_POST['edate'],0,2) + 1;
if(strlen($nd)==1){ $nd = '0'.$nd; }
$sdate = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2)  ;
$edate = substr($_POST['edate'],6,4).'-'.substr($_POST['edate'],3,2).'-'.$nd ;*/

if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {


$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
 $total = 0;
}




?>
    <div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
	  <div style="width:30%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้ขาย</div>
      <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
      <div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
      <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา</div>
	  <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวนคนไข้</div>
    </div>
	
		
<? 
$where_branch_id = "";
if($_SESSION['branch_id'] !="") {
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
}
$cl = $color1;
if(empty($did)){
$sql  = "select  empid,empname,tid,tname,sum(totalprice) totalprice,count(*) qty ";
$sql .= "from tb_pctrec  where   (dat between '$sdate%' and '$edate%') and (typ ='C' ) ";
} else {
$sql  = "select  empid,empname,tid,tname,sum(totalprice) total,count(*) qty ";
$sql .= "from tb_pctrec  where   (dat between '$sdate%' and '$edate%') and (typ ='C' ) and (empid like '%$did%') ";
}
$sql .= " $where_branch_id group by empid,empname,tid,tname ";
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
$sql .=" order by empid,tid asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){
$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}
$total = $total + $rs['totalprice'];
?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:98%;;background:<?=$cl?>; ">
	<div style="width:8%; float:left;"><?=$n?></div>
	<div style="width:30%; float:left;"><?=$rs['empname']?></div>
	<div style="width:10%; float:left;"><?=$rs['tid']?></div>
	<div style="width:22%; float:left;"><?=$rs['tname']?></div>
	<div style="width:15%; float:left;">&nbsp;<?=number_format($rs['totalprice'],'0','.',',')?></div>
	<div style="width:15%; float:left;">&nbsp;<?=number_format($rs['qty'],'0','.',',')?></div>
								
	
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
	<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalement_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$edate?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalement_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	

?>
</div>

<? } ?>
</div>



<!--รวม-->

<div id="d_list2" style=" width: 99%; margin-top:10px;   text-align:center; height:30px; background-color:#FFCC99;  ">

<?



$did = $_POST['did'];


if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {


$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

}



if(empty($did)){
$sql  = "select sum(a.totalprice) total ";
$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat between '$sdate%' and '$edate%') and (a.typ ='C' ) ";
} else {
$sql  = "select sum(a.totalprice) total ";
$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat between '$sdate%' and '$edate%') and (a.typ ='C' ) and (a.empid like '%$did%')  ";
}



$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rt=mysql_fetch_array($str);




?>





	<div class="line" style="margin-top: 4px;">
	  <div style="width:20%; float:left; text-align:right;">รวมทั้งหมด :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($rt['total'],'0','.',',')?>" />
      </div>
    </div>	
	
	
	
	
	</div>
