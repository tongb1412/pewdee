<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?
include('../class/config.php');
include('../class/permission_user.php');
$cl = '';
$did = $_POST['did'];

$filName = "Rep_Druge_Total.csv";
$objWrite = fopen("Rep_Druge_Total.csv", "w");


fwrite($objWrite,"\"code\",\"name\",\"Druge Group\",\"total\",\"Unit\"");
fwrite($objWrite,"\n");

if(empty($did)){
mysql_query("SET NAMES tis620");
$sql  = "select * from tb_druge where status='IN'   order by dgroup,tname asc";
} else {
mysql_query("SET NAMES tis620");
$sql  = "select * from tb_druge where status='IN' and (did like '%$did%') order by dgroup,tname asc";
}

$str  = mysql_query($sql);
while($rs  = mysql_fetch_array($str)){
    $code = $rs['did'];
	$tname = $rs['tname'];
	$unit = $rs['unit'];
	$dgroup = $rs['dgroup'];
	$total = $rs['total'];

	fwrite($objWrite,"\"$code\""); 
	fwrite($objWrite,",\"$tname\"");			
	fwrite($objWrite,",\"$dgroup\"");
	fwrite($objWrite,",\"$total\"");
	fwrite($objWrite,",\"$unit\"");
	fwrite($objWrite,"\n");

}

fclose($objWrite);

$selserch = "";
if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
	$selserch = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
	
}

$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];

$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

if ($_SESSION['company_data'] == "1") {
	$company_data = $_SESSION['company_data'];
	$style = "list-full";
} else {
	$style = "list-small";
}

?>
<div class="monthly-list <?php echo $style; ?>">
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
	<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?= $tabcolor ?>;">
		<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:37%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;กลุ่มยา</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
		<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
	</div>
	<? 
$cl = $color1;
mysql_query("SET NAMES utf8");
if(empty($did)){
$sql  = "select * from tb_druge where status='IN' ";
} else {
$sql  = "select * from tb_druge where status='IN' and (did like '%$did%') ";
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
$sql .=" order by dgroup,did asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){
	$n=1;
	while($rs = mysql_fetch_array($result)){  
		if($cl != $color1){
			$cl = $color1;
		} else {
			$cl = $color2;
		}

		$did = $rs['did'];
		if($selserch == "" || $selserch == "00"){
			$sql1 = "select sum(total) as total from tb_drugeinstock where did='$did' and total > 0 and company_code = '$company_code' ";
		} else {
			$sql1 = "select sum(total) as total from tb_drugeinstock where did='$did' and total > 0 and branchid = '$branch_id' and company_code = '$company_code' ";
		}
		
		// echo $sql1;exit();
		$rst = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
		$num  = mysql_num_rows($rst);
		$dtotal = 0;
		if(!empty($num)){
			$rss = mysql_fetch_array($rst);
			$dtotal = $rss['total'];
		}


		?>

			<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="width:98%;;background:<?= $cl ?>; ">
				<div style="width:8%; float:left;"><?= $n ?></div>
				<div style="width:15%; float:left;"><?= $rs['did'] ?></div>
				<div style="width:37%; float:left;"><?= $rs['tname'] ?></div>
				<div style="width:15%; float:left;"><?= $rs['dgroup'] ?></div>
				<div style="width:15%; float:left;">
					<?php
					if($_SESSION['company_data'] == "1" && $branch_id == ""){
						echo number_format($rs['total'],'0','.',',');
					} else {
						echo number_format($rss['total'],'0','.',',');
					}
					?>
				</div>
				<div style="width:10%; float:left;">&nbsp;<?= $rs['unit'] ?></div>
			</div>
	<? 		
		$n++; 

	} ?>
		<div style="width:83%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
			<?= $Num_Rows; ?>
			รายการ :
			<?= $Num_Pages; ?>
			หน้า :
			<?
		if($Prev_Page)
		{
		?>
			<a href="javascript: ajaxLoad('post','Monthly_report/restockdruge_list.php','branchid=<?php echo $selserch ?>&Page=<?= $Prev_Page ?>&sdate=<?= $sdate ?>&edate=<?= $edate ?>&did=<?= $_POST['did'] ?>','d_list')">
				<img src='images/icon/back.png' border='0' align="absmiddle" />
			</a>
			<?
		}
		
		echo " <b>$Page </b>";
		
		if($Page!=$Num_Pages)
		{
		?>
			<a href="javascript: ajaxLoad('post','Monthly_report/restockdruge_list.php','branchid=<?php echo $selserch ?>&Page=<?= $Next_Page ?>&sdate=<?= $sdate ?>&edate=<?= $edate ?>&did=<?= $_POST['did'] ?>','d_list')">
				<img src='images/icon/next.png' border='0' align="absmiddle" />
			</a>
			<?		
		}
		mysql_close($dblink);
	?>
		</div>

		<? } ?>
</div>