<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$txtserch = $_GET['txt'];
$selserch = $_GET['bid'];
$mode = $_GET['mode'];
$company_data = $_SESSION["company_data"];
$company_code = $_SESSION["company_code"];

// echo $txtserch;
// echo " ";
// echo $selserch;
// echo " ";
// echo $mode;exit();

if($txtserch == "ค้นหา"){
	$txtserch = "";
}
if($selserch == "" || $selserch == undefined || $selserch == null){
	$selserch = $_SESSION['branch_id'];
}

$where_branch_id = "";
if($company_data == "1"){
	if($selserch != "00" && $selserch != "all" && empty($txtserch)){
		$where_branch_id = "and branchid = '$selserch' or branchid is NULL or branchid = '' "; 
	}
	else if($selserch != "00" && $selserch != "all"){
		$where_branch_id = "and branchid = '$selserch' "; 
	}
	else{
		$where_branch_id = "";
	}
}
else{
		$where_branch_id = "and branchid = '$selserch' "; 
}

// echo $where_branch_id;
$cl = $color1;
if(empty($txtserch) && $selserch == "00"){
	$sql = "select * from tb_patient where stayin <> 'OFF' and company_code = '$company_code' ";
} else if(empty($txtserch) && $selserch != "") {
	$sql = "select * from tb_patient where stayin <> 'OFF' and company_code = '$company_code' " . $where_branch_id;
} else if($mode == "cross_branch" && !empty($txtserch)){
		$sql = "select * from tb_patient where (selfphone like '%$txtserch%' or personalid like '%$txtserch%') and (stayin <> 'OFF') and company_code = '$company_code' ";
} else {
	$sql = "select * from tb_patient where (cradno like '%$txtserch%' or hn like '%$txtserch%' or fname like '%$txtserch%' or lname like '%$txtserch%') and (stayin <> 'OFF') " . $where_branch_id . "and company_code = '$company_code' ";
}

// echo $sql;exit();
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

$Per_Page = 18;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])	{ $Page=1; }
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page) {
	$Num_Pages =1;
} else if(($Num_Rows % $Per_Page)==0) {
	$Num_Pages =($Num_Rows/$Per_Page) ;
} else {
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
$sql .=" order by hn desc LIMIT $Page_Start , $Per_Page";

$result  = mysql_query($sql);
if($result){
$n=1;
while($rs = mysql_fetch_array($result)){

	if($rs['branchid'] == "" || $rs['branchid'] == null){
		$branch_id_p = $_SESSION['branch_id'];
	}
	else{
		$branch_id_p = $rs['branchid'];
	}


	if($cl != $color1){
		$cl = $color1;
	} else {
		$cl = $color2;
	}
	$phn = $rs['hn'];
	$psql = "select * from tb_apayment where hn='$phn'";
	$str  = mysql_query($psql);
	$pn = mysql_num_rows($str);
	if(!empty($pn)){ $cl = '#FF6600';  }


	?>
	<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>" >
		<div style="width:20%; float:left; cursor:pointer;" ondblclick="cleartabreg(5,4,8,'register/patient_edit_from.php','content','bid=<?php echo $selserch ?>&hn=<?=$rs['hn']?>')" ><?=$rs['cradno']?>&nbsp;</div>
		<div style="width:15%; float:left; cursor:pointer;" ondblclick="cleartabreg(5,4,8,'register/patient_edit_from.php','content','bid=<?php echo $selserch ?>&hn=<?=$rs['hn']?>')"><?=$rs['hn']?>&nbsp;</div>
		<div style="width:31%; float:left; cursor:pointer;" ondblclick="cleartabreg(5,4,8,'register/patient_edit_from.php','content','bid=<?php echo $selserch ?>&hn=<?=$rs['hn']?>')"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?>&nbsp;</div>
		<div style="width:17%; float:left; cursor:pointer;" ondblclick="cleartabreg(5,4,,'register/patient_edit_from.php','content','bid=<?php echo $selserch ?>&hn=<?=$rs['hn']?>')"><? if(! empty($rs['selfphone'])){ echo $rs['selfphone']; } else { echo '-'; } ?>&nbsp;</div>
		<div style="width:17%; float:left; text-align:right;">
		<? if(!empty($pn)){ ?><img src="images/icon/ar.png" align="ค้างชำระ" title="ค้างชำระ" style="cursor:pointer;" onclick="loadmodule('home','register/apayment.php','bid=<?php echo $branch_id_p ?>&hn=<?=$rs['hn']?>')" />&nbsp;&nbsp;<? }?><img src="images/icon/xxxx.png" align="ส่งเข้าระบบ" title="ส่งเข้าระบบ" style="cursor:pointer;" onclick="sendpatient('bid=<?php echo $branch_id_p ?>&hn=<?=$rs['hn']?>','register/sendpatient.php','sd')" />&nbsp;&nbsp;<img src="images/icon/ShoppingCart.png" align="ขายยาหน้าร้าน" title="ขายยาหน้าร้าน" style="cursor:pointer; display:none;" onclick="loadmodule_druge('home','register/sale_druge.php','<?=$rs['hn']?>','<?=$rs['vn']?>',<?php echo $branch_id_p ?>)"/>&nbsp;&nbsp;<img src="images/icon/Folder.png" align="ประวัติการรักษา" title="ประวัติการรักษา" style="cursor:pointer;" onclick="loadmodule('home','register/history.php','bid=<?php echo $branch_id_p ?>&hn=<?=$rs['hn']?>')" />&nbsp;&nbsp;<img src="images/icon/treatment.png" align="ประวัติทรีทเมนทร์" title="ประวัติทรีทเม้นท์" style="cursor:pointer;" onclick="loadmodule('home','register/history_treatment.php','bid=<?php echo $branch_id_p ?>&hn=<?=$rs['hn']?>')" />&nbsp;&nbsp;<img src="images/icon/hnn.png" align="เพิ่มคอร์สเก่า" title="เพิ่มคอร์สเก่า" style="cursor:pointer; display:none;" onclick="loadmodule('home','register/doctor.php','bid=<?php echo $branch_id_p ?>&hn=<?=$rs['hn']?>')" />&nbsp;&nbsp;<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer; display:none;" onClick="ConfDelete('register/patient_del.php','p_list','bid=<?php echo $branch_id_p ?>&id=<?=$rs['hn']?>')"/>
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
	<a href="javascript: ajaxLoad('get','register/patient_list.php','sel=<?=$selserch?>&txt=<?=$txtserch?>&Page=<?=$Prev_Page?>','p_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}

		echo " <b>$Page </b>";			
		
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','register/patient_list.php','sel=<?=$selserch?>&txt=<?=$txtserch?>&Page=<?=$Next_Page?>','p_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>