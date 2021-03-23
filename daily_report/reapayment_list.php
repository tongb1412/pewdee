<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');
$mode = $_GET['mode'];
$cl = '';
$dat = date('Y-m-d');
// $dat = "2011-08-07";

if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}
$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

?>
<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
	<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
	<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
	<div style="width:30%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
	<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รวมเงิน</div>
	<div style="width:30%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เลขที่ใบเสร็จ</div>
</div>

<? 

$cl = $color1;
$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.pdate  from tb_apayment a,tb_patient  b,tb_payment c where (a.hn = b.hn) and (a.billno = c.billno) and (c.pdate like '%$dat%') $where_branch_id";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

// echo $sql;
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

<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="width:98%;;background:<?= $cl ?>; ">
	<div style="width:10%; float:left;"><?= $n ?></div>
	<div style="width:10%; float:left;"><?= $rs['cradno'] ?></div>
	<div style="width:30%; float:left;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
	<div style="width:20%; float:left;"><?= number_format($rs['total'], '0', '.', ',') ?></div>
	<div style="width:30%; float:left;"><?= $rs['billno'] ?></div>
</div>

<? $n++; } ?>
<div style="width:83%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
	<?= $Num_Rows; ?>
	รายการ :
	<?= $Num_Pages; ?>
	หน้า :
	<?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','daily_report/repayment_list.php','branchid<?php echo $branch_id; ?>&mode=<?= $mode ?>&Page=<?= $Prev_Page ?>','d_list')">
		<img src='images/icon/back.png' border='0' align="absmiddle" />
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','daily_report/repayment_list.php','branchid<?php echo $branch_id; ?>&mode=<?= $mode ?>&Page=<?= $Next_Page ?>','d_list')">
		<img src='images/icon/next.png' border='0' align="absmiddle" />
	</a>
	<?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>