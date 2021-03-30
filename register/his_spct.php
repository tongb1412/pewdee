<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../class/config.php');
require_once('../class/permission_user.php');

$txt = $_POST['dat'];
$cl = $color1;

if($_SESSION['cross_branch_data'] == "1") {
	$where_branch_id = "";
} else {
	
	$branch_id = $_SESSION['branch_id'];
	$company_data = $_SESSION['company_data'];
	$company_code = $_SESSION['company_code'];
	$where_data = set_where_user_data("a", $branch_id, $company_code, $company_data);
	$where_branch_id .= $where_data['where_branch_id'];
	$where_branch_id .= $where_data['where_company_code'];
}

if(empty($txt)){
    if($dat == '-') {
	$sql = "select a.*,b.status from tb_pctrec a,tb_vst b where a.hn='$hn' and a.dat = '-' and a.vn = b.vn and (b.status='COM') $where_branch_id  ";
	} else {
		$sql = "select a.*,b.status from tb_pctrec  a,tb_vst b where a.hn='$hn' and a.vn = b.vn and (b.status='COM') $where_branch_id ";
	}
} else {
	$hn = $_POST['hn'];
	if($txt=='00') {
		$sql = "select a.*,b.status from tb_pctrec a,tb_vst b where a.hn='$hn' and a.vn = b.vn and (b.status='COM') $where_branch_id  ";
	} else {
		$sql = "select  a.*,b.status from tb_pctrec  a,tb_vst b where a.hn='$hn' and a.vn = b.vn and (b.status='COM') and a.dat like '%$txt%' $where_branch_id ";
	}
}



$sql .=" order by a.dat asc ";
// echo $sql;
$result  = mysql_query($sql);

$dat = '';

while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

if($dat!=$rs['dat']){ $dat=$rs['dat']; $dd= $rs['dat']; } else { $dd='-';  }

?>

<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>; width:94%;" >
	<div style="width:20%; float:left;"  ><?=$dd?>&nbsp;</div>
	<div style="width:35%; float:left; overflow:hidden; height:20px; "><?=$rs['tname']?>&nbsp;</div>
	<div style="width:20%; float:left;" ><?=$rs['qty']?>&nbsp;</div>
	<div style="width:20%; float:left; text-align:right;" ><?=number_format($rs['totalprice'],'2','.',',')?>&nbsp;</div>
</div>


<? } ?>