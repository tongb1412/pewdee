<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 
include('../class/config.php'); 
include_once('../class/permission_user.php');
?>

<?
$txtserch = $_GET['txt'];
$cl = $color1;


if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = '';
}
$as = "";
// echo "x".$branchid."x";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];




if(empty($txtserch)){
	$sql = "select * from tb_druge where status ='IN' $where_branch_id  ";
} else {
	$sql = "select * from tb_druge where (did like '%$txtserch%'  or gname like '%$txtserch%' or tname like '%$txtserch%'  ) and ( status ='IN') $where_branch_id ";
}

// echo $sql;



$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

$Per_Page = 16;   // Per Page

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
$sql .=" order by did desc LIMIT $Page_Start , $Per_Page";

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
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="background:<?= $cl ?>">

	<div style="width:30%; float:left; cursor:pointer; ">
		<?= $rs['did'] ?>&nbsp;
	</div>
	<div style="width:60%; float:left; cursor:pointer; ">
		<?= $rs['tname'] ?>&nbsp;
	</div>
	<div style="width:10%; float:left; text-align:right;">
		&nbsp;<img src="images/icon/export16.png" align="คนไข้นอกระบบ" title="คนไข้นอกระบบ" style="cursor:pointer;" onClick="ajaxEdit('post','daily_report/offdruge.php','did=<?= $rs['did'] ?>&mode=off','reportpage');" />

	</div>


</div>
<? } ?>

<div style="width:99%; margin:auto; margin-top:1%; text-align:right; line-height:20px;">
	<?= $Num_Rows; ?>
	รายการ :
	<?= $Num_Pages; ?>
	หน้า :
	<?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','daily_report/din_list.php','txt=<?= $txtserch ?>&Page=<?= $Prev_Page ?>','p_list')">
		<img src='images/icon/back.png' border='0' align="absmiddle" />
	</a>
	<?
	}
	echo " <b>$Page </b>";
	// for($i=1; $i<=$Num_Pages; $i++){
	// 	if($i != $Page)
	// 	{
	// ?>
	<!-- <a href="javascript: ajaxLoad('get','daily_report/din_list.php','txt=<?= $txtserch ?>&Page=<?= $i ?>','p_list')"><?= $i ?></a> -->
	<?
	// 	}
	// 	else
	// 	{ 	
	// 		if($Num_Pages!= 1){	echo " <b>$i </b>";}			
	// 	}
	// }
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','daily_report/din_list.php','txt=<?= $txtserch ?>&Page=<?= $Next_Page ?>','p_list')">
		<img src='images/icon/next.png' border='0' align="absmiddle" />
	</a>
	<?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>