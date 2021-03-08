<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
<?
include('../class/config.php');
$cl = '';
$dat = date('Y-m-d');
$did = $_POST['did'];


?>
    <div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
      <div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
      <div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้ขาย</div>
      <div style="width:25%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อลูกค้า</div>
      <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา</div>
    </div>
	
		
<? 
$where_branch_id = "";
if($_SESSION['branch_id'] !="") {
	$where_branch_id = " and a.branchid ='".$_SESSION['branch_id']."'  ";
}
$cl = $color1;
if(empty($did)){
	$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
	$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat like '%$dat%') and (a.typ ='C' ) $where_branch_id ";
} else {
	$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
	$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat like '%$dat%') and (a.typ ='C') and (a.empid like '%$did%') $where_branch_id ";
}
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
$sql .=" order by a.empid,a.tid asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){
$n=1; $total = 0;
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
	<div style="width:15%; float:left;"><?=$rs['tid']?></div>
	<div style="width:22%; float:left;"><?=$rs['tname']?></div>
	<div style="width:20%; float:left;"><?=$rs['empname']?></div>
	<div style="width:25%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:10%; float:left;">&nbsp;<?=number_format($rs['totalprice'],'0','.',',')?></div>
								
	
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
	<a href="javascript: ajaxLoad('get','daily_report/resalecourse_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','daily_report/resalecourse_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','d_list')">	
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
	

	<div class="line" style="margin-top: 4px;">
	  <div style="width:20%; float:left; text-align:right;">รวมทั้งหมด :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($total,'0','.',',')?>" />
      </div>
    </div>	
	
	
	
	
	</div>
