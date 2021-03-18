<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?
include('../class/config.php');
include('../class/permission_user.php');
$cl = '';
/*$sdate = $_POST['sdate'];
$edate = $_POST['edate'];*/

$cl = '';
if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {

$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
}

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

if (!empty($_SESSION['company_data'])) {
	$company_data = $_SESSION['company_data'];
	$style = "list-full";
} else {
	$style = "list-small";
}

?>
<div class="monthly-list <?php echo $style; ?>">
	<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
		<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
		<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
		<div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เงินสด</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;บัตรเครดิต</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รวมทั้งหมด</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เลขที่ใบเสร็จ</div>
	</div>


	<? 




$cl = $color1;
$sql = "select a.*,(a.cash+a.credit) total1,b.cradno,b.pname,b.fname,b.lname from tb_payment a,tb_patient b where (a.hn = b.hn)  and (a.vn like 'AR%') and (a.pdate between '$sdate%' and '$edate%') " . $where_branch_id;
// echo $sql;exit();
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
$sql .=" order by a.billno asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){

while($rs=mysql_fetch_array($result)){  
	if($cl != $color1){
		$cl = $color1;
	} else {
		$cl = $color2;
	}

	?>

	<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="width:98%;;background:<?= $cl ?>; ">
		<div style="width:8%; float:left;"><?= $n ?></div>
		<div style="width:10%; float:left;">&nbsp;<?= $rs['cradno'] ?></div>
		<div style="width:22%; float:left;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
		<div style="width:15%; float:left;"><?= number_format($rs['cash'], '0', '.', ',') ?></div>
		<div style="width:15%; float:left;"><?= number_format($rs['credit'], '0', '.', ',') ?></div>
		<div style="width:15%; float:left;"><?= number_format($rs['total1'], '0', '.', ',') ?></div>
		<div style="width:15%; float:left;"><?= $rs['billno'] ?></div>
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

		<a href="javascript: ajaxLoad('post','Monthly_report/rear_list.php','branchid=<?php echo $branch_id ?>&Page=<?= $Prev_Page ?>&sdate=<?= $sdate ?>&edate=<?= $_POST['edate'] ?>','d_list')">
			<img src='images/icon/back.png' border='0' align="absmiddle" />
		</a>

		<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

		<!--	<a href="javascript: ajaxLoad('post','Monthly_report/rear_list.php','mode=<?= $mode ?>&Page=<?= $Next_Page ?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" /> 
	</a>-->
		<a href="javascript: ajaxLoad('post','Monthly_report/rear_list.php','branchid=<?php echo $branch_id ?>&Page=<?= $Next_Page ?>&sdate=<?= $sdate ?>&edate=<?= $_POST['edate'] ?>','d_list')">
			<img src='images/icon/next.png' border='0' align="absmiddle" />
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
//$sdate = $_POST['sdate'];
//$edate = $_POST['edate'];
$as = "";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql = "select pdate,sum(cash) s_cash ,sum(credit) s_credit,sum(cash+credit) s_total from tb_payment where  (vn like 'AR%') and (pdate between '$sdate%' and '$edate%') " . $where_branch_id . " group by ' pdate%' ";
// echo $sql;exit();
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
$row = mysql_fetch_array($s_result);



?>

	<div class="line" style="margin-top: 4px;">
		<div style="width:20%; float:left; text-align:right;">รวมเงินสด :&nbsp;</div>
		<div style="width:10%; float:left;">
			<input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($row['s_cash'], '2', '.', ',') ?>" />
		</div>
		<div style="width:20%; float:left; text-align:right;">รวมบัตรเคดิต :&nbsp;</div>
		<div style="width:10%; float:left;">
			<input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($row['s_credit'], '2', '.', ',') ?>" />
		</div>
		<div style="width:20%; float:left; text-align:right;">รวมทั้งหมด :&nbsp;</div>
		<div style="width:10%; float:left;">
			<input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12" ; value="<?= number_format($row['s_total'], '2', '.', ',') ?>" />
		</div>
	</div>


</div>