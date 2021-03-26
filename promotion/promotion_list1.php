<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
// $txtserch = $_GET['txt'];
$date = date('Y-m-d');

if(!empty($_REQUEST['txt'])){
	$txtserch = $_REQUEST['txt'];
} else {
	$txtserch = "";
}

if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

$where_branch_id = "";
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];

if($company_data == "1"){
	if($branch_id =="00") {
		$where_branch_id = " and company_code = '$company_code' ";
	} else {
		$where_branch_id = " and (branchid ='" . $branch_id . "' and company_code = '$company_code') ";
	}
} else {
	$where_branch_id = " and (company_code = '$company_code' and branchid ='" . $branch_id . "' or branchid = '07') ";
}

$cl = $color1;

if(empty($txtserch)){
	$sql = "select * from promotion where datestop >=  '$date' $where_branch_id ";
} else if($txtserch == ""){
	$sql = "select * from promotion where datestop >= '$date' $where_branch_id ";
} else {
	$sql = "select * from promotion where datestop >= '$date' and proid like '%$txtserch%' or proname like '%$txtserch%' $where_branch_id ";
}
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

$Per_Page = 18;   // Per Page

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
$sql .=" order by proid desc LIMIT $Page_Start , $Per_Page";

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
<div  class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>; cursor:pointer;" ondblclick="ajaxLoad('post','promotion/edit_promotion_admin.php','pid=<?=$rs['proid']?>','staffedit')" >
	<div style="width:30%; float:left;"><?=$rs['proid']?>&nbsp;</div>
	<div style="width:50%; float:left;"><?=$rs['proname']?>&nbsp;</div>
	<div style="width:15%; float:left;"> 
	<img src="images/icon/pdetail.png" align="รายละเอียด" title="แก้ไข" style="cursor:pointer;" onclick="ajaxLoad('post','promotion/edit_promotion_admin.php','pid=<?=$rs['proid']?>','staffedit')" />
	<?php 
	if($rs['branchid'] == $_SESSION['branch_id'] || $_SESSION['company_code'] == "1"){
		?>
		<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('promotion/promotion_del.php','d_tall','id=<?=$rs['proid']?>')" /> 
		<?php
	}
	?>
	
	</div>

</div>
<? } ?>

<div style="width:98%; margin:auto; margin-top:10px; text-align:right; line-height:20px; float:left;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','setting/staff_list.php','txt=<?=$txtserch?>&Page=<?=$Prev_Page?>','d_tall')">	
	<img src='../setting/images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}

		echo	" <b>$Page </b>";			
		
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/staff_list.php','txt=<?=$txtserch?>&Page=<?=$Next_Page?>','d_tall')">	
	<img src='../setting/images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>
<? } ?>