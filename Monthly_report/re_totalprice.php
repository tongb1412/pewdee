<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');
/*$sdate = $_GET['sdate'];
$edate = $_GET['edate'];*/

$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 



if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = $_SESSION['branch_id'];
}
$as = "a";
// echo "x".$branchid."x";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];
$branchname = get_branch_name($branchid,$_SESSION['company_code']);

$where_branch_id2 = "";
if($branchid == "") {
	$where_branch_id2 = " where cn = '".$_SESSION["branch_id"] ."' and company_code ='".$_SESSION['company_code']."'  ";
}else {
	$where_branch_id2 = " where cn = '".$branchid ."' and company_code ='".$_SESSION['company_code']."' ";
}
$sqlC ="select clinicname from tb_clinicinformation $where_branch_id2";
// echo $sqlC;
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$cname = $rs['clinicname'];
if($cname =="") {
	$cname = "ทั้งหมด";
}



$c =0; $d=0; $t=0;
$sql = "select a.*,b.fname efname,b.lname elname ,c.fname cfname,c.lname clname,d.fname ckfname ,d.lname cklname ,branchname
from tb_totalprice a
left join tb_staff b on a.empname = b.staffid
left join tb_staff c on a.cashier = c.staffid
left join tb_staff d on a.cashier_check = d.staffid
left join tb_branch f ON a.branchid = f.branchid
where (a.date between '$sdate%' and '$edate%') $where_branch_id";
// echo $sql;exit();
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);
$n=1; $m=1; $s='y'; $x = 52; 

$n=1;

while($rs=mysql_fetch_array($result)){  
//$c = $dp + $rs['cash'];
//$d = $lp + $rs['credit'];
//$t = $lp + $rs['tot'];

$c = $c + $rs['cash'];
$k1 = $k1 + $rs['k_krungsri'];
$k2 = $k2 + $rs['k_kasikorn'];
$k3 = $k3 + $rs['k_thai'];
$k4 = $k4 + $rs['k_amax'];
$k5 = $k5 + $rs['k_uob'];
$k6 = $k6 + $rs['k_ktc'];
$k7 = $k7 + $rs['k_tana'];
$k8 = $k8 + $rs['total'];

$k9 = $rs['branchname'];



if($s=='y'){ 
?>
<!--<div style="width:100%; height:3508px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">    -->
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">รายงานสรุปบันทึกยอดรายวัน <?php if ($branchname != "") {
																																						echo " (สาขา $branchname)";
																																					} ?></div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ระหว่างวันที่ <?= $_GET['sdate'] . '  ถึง  ' . $_GET['edate']; ?>
</div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

	<div style="width:100%; float:left; text-align:right;">
		หน้า : <?= '1'; ?>&nbsp;
	</div>

</div>


<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">

	<?php
	if ($branchid == "") { ?>
		<div style="width:3%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
		<div style="width:4%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">เงินสด</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงศรีฯ</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">กสิกร</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">ไทยพาณิชย์</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">Amax</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">OUB</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงไทย</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">ธนชาติ</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">ผู้บันทึก</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">แคชเขียร์ประจำวัน</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">พนักงานตรวจ</div>
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">เวลาบันทึก</div>
	<?php
	} else {
	?>
		<div style="width:3%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
		<div style="width:4%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">เงินสด</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">กรุงศรีฯ</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">กสิกร</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">ไทยพาณิชย์</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">Amax</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">OUB</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">กรุงไทย</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">ธนชาติ</div>
		<div style="width:4%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;text-align: left;">ผู้บันทึก</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">แคชเขียร์ประจำวัน</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">พนักงานตรวจ</div>
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">เวลาบันทึก</div>
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">สาขา</div>
	<?php
	}
	?>



</div>

<? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }  
if($m-1 > 1){  $x = 56; } 
if($n == ((($m-1) * $x) + 1) && $m > 1){
 
    ?>
<br><br>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
	<div style="width:50%; float:left; text-align:left;">
		<?= $dname ?>&nbsp;
	</div>
	<div style="width:50%; float:left; text-align:right;">
		หน้า : <?= $m; ?>&nbsp;
	</div>
</div>
<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">

	<?php
	if ($branchid == "") { ?>
		<div style="width:3%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
		<div style="width:4%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">เงินสด</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงศรีฯ</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">กสิกร</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">ไทยพาณิชย์</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">Amax</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">OUB</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงไทย</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">ธนชาติ</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">ผู้บันทึก</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">แคชเขียร์ประจำวัน</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">พนักงานตรวจ</div>
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">เวลาบันทึก</div>
	<?php
	} else {
	?>
		<div style="width:3%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
		<div style="width:4%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
		<div style="width:7%; float:left; border-bottom:#999999 2px solid;">เงินสด</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">กรุงศรีฯ</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">กสิกร</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">ไทยพาณิชย์</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">Amax</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">OUB</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">กรุงไทย</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">ธนชาติ</div>
		<div style="width:4%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;text-align: left;">ผู้บันทึก</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">แคชเขียร์ประจำวัน</div>
		<div style="width:6%; float:left; border-bottom:#999999 2px solid;">พนักงานตรวจ</div>
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">เวลาบันทึก</div>
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">สาขา</div>
	<?php
	}
	?>


</div>
<?
 } 
?>


<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">


	<?php
	if ($branchid == "") { ?>
		<div style="width:3%; text-align: center; float:left;"><?= $n ?></div>
		<div style="width:3%; float:left;"><?= $rs['date'] ?></div>
		<div style="width:5%; text-align:right; float:left;">&nbsp;<?= number_format($rs['cash'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_krungsri'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_kasikorn'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_thai'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_amax'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_uob'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_ktc'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_tana'], '2', '.', ',') ?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?= number_format($rs['total'], '2', '.', ',') ?></div>
		<div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;<?= $rs['efname'] . '    ' . $rs['elname']  ?></div>
		<div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;<?= $rs['cfname'] . '    ' . $rs['clname']  ?></div>
		<div style="width:7%; float:left;"><?= $rs['ckfname'] . '    ' . $rs['cklname']  ?></div>
		<div style="width:10%; float:left;"><?= $rs['datenow'] ?></div>
	<?php
	} else {
	?>
		<div style="width:3%; text-align: center; float:left;"><?= $n ?></div>
		<div style="width:3%; float:left;"><?= $rs['date'] ?></div>
		<div style="width:5%; text-align:right; float:left;">&nbsp;<?= number_format($rs['cash'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_krungsri'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_kasikorn'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_thai'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_amax'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_uob'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_ktc'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['k_tana'], '2', '.', ',') ?></div>
		<div style="width:6%; text-align:right; float:left;">&nbsp;<?= number_format($rs['total'], '2', '.', ',') ?></div>
		<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;<?= $rs['efname'] . '    ' . $rs['elname']  ?></div>
		<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;<?= $rs['cfname'] . '    ' . $rs['clname']  ?></div>
		<div style="width:7%; float:left;">&nbsp;<?= $rs['ckfname'] . '    ' . $rs['cklname']  ?></div>
		<div style="width:10%; float:left;">&nbsp;<?= $rs['datenow'] ?></div>
		<div style="width:10%; float:left;">&nbsp;<?= $rs['branchname'] ?></div>
	<?php
	}
	?>



</div>






<? $n++; } ?>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>



<div style="width:100%; font-size:11px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:1%; float:left; text-align:center;">&nbsp;</div>

	<div style="width:5%; float:left; text-align:right">รวม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($c, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($k1, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($k2, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($k3, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($k4, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($k5, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($k6, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($k7, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left; text-align:center">&nbsp;&nbsp;<?= '-' ?></div>
</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>