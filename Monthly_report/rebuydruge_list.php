<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?
	session_start();
include('../class/config.php');
include('../class/permission_user.php');
$cl = '';
$did = $_POST['did'];

if (!empty($_SESSION['company_data'])) {
	$company_data = $_SESSION['company_data'];
	$style = "list-full-daily";
} else {
	$style = "list-small";
}

?>
<div class="monthly-list <?php echo $style; ?>">
	<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
		<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
		<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;กลุ่มยา</div>
		<div style="width:25%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
		<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จุดสั่งซื้อ</div>
	</div>


	<? 



if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = "";
}
$as = "";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];


$cl = $color1;
if(empty($did)){
$sql  = "select * from tb_druge where status='IN' and (sqty > total) $where_branch_id";
} else {
$sql  = "select * from tb_druge where status='IN' and (did like '%$did%') and (sqty > total) $where_branch_id";
}
// echo $sql ;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 



if($_SESSION['company_data'] == "1"){
	$Per_Page = 17;   // Per Page
} else {
	$Per_Page = 14;   // Per Page
}

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
$sql .=" order by did asc LIMIT $Page_Start , $Per_Page";
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
		<div style="width:8%; float:left;"><?= $n ?></div>
		<div style="width:15%; float:left;"><?= $rs['did'] ?></div>
		<div style="width:22%; float:left;"><?= $rs['tname'] ?></div>
		<div style="width:20%; float:left;"><?= $rs['dgroup'] ?></div>
		<div style="width:25%; float:left;">
			<? echo number_format($rs['total'],'0','.',',') ?>
		</div>
		<div style="width:10%; float:left;">&nbsp;<?= $rs['sqty'] ?></div>


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
		<a href="javascript: ajaxLoad('post','Monthly_report/rebuydruge_list.php','branchid=<?php echo $branchid; ?>&Page=<?= $Prev_Page ?>&sdate=<?= $sdate ?>&edate=<?= $edate ?>','d_list')">
			<img src='images/icon/back.png' border='0' align="absmiddle" />
		</a>
		<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>
		<a href="javascript: ajaxLoad('post','Monthly_report/rebuydruge_list.php','branchid=<?php echo $branchid; ?>&Page=<?= $Next_Page ?>&sdate=<?= $sdate ?>&edate=<?= $edate ?>','d_list')">
			<img src='images/icon/next.png' border='0' align="absmiddle" />
		</a>
		<?		
	}
	
	mysql_close($dblink);

?>
	</div>

	<? } ?>
</div>