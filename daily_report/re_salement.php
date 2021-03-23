<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');
// $did = $_GET['did'];
$dat = date('Y-m-d');
// $dat = "2011-03-22";

if(!empty($_REQUEST['did'])){
	$did = $_REQUEST['did'];
} else {
	$did = "";
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

$sqlC .="select clinicname from tb_clinicinformation where cn = '$branch_id'";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];
$dname = '';
$empid = '';

if(empty($did)){
	$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
	$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn)  ";
	$sql .= "and (a.dat like '%$dat%') and (a.typ ='T' or typ ='L') ";
} else {
	$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
	$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat like '%$dat%') and (a.typ ='T' or typ ='L') and (a.empid like '%$did%')  ";
}

$sql .=" $where_branch_id order by a.empid ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 
$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0;
$total = 0;
$total1 = 0;
while($rs=mysql_fetch_array($result)){  
$nn++;

if($s=='y'){ 	
?>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานรายได้การขายทรีทเมนท์
</div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่ <?= date('d/m/Y', time()); ?>
</div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
	<div style="width:50%; float:left; text-align:left;">
		&nbsp;สาขา <?php 
		if($branch_id == "00"){
			$cname = "ทั้งหมด";
			echo $cname;
		} else {
			echo $cname;
		}
		?>
	</div>
	<div style="width:50%; float:left; text-align:right;">
		หน้า : <?= '1'; ?>&nbsp;
	</div>

</div>
<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
	<!-- <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
	<div style="width:25%; float:left; border-bottom:#999999 2px solid;">ชื่อลูกค้า</div>
	<div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
	<div style="width:20%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
	<div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
	<div style="width:25%; float:left; border-bottom:#999999 2px solid;">ผู้สนันสนุน</div> -->
	<div class="report report-no center">ลำดับ</div>
	<!-- <div class="report ">วันที่</div> -->
	<div class="report report-name center">ชื่อลูกค้า</div>
	<div class="report report-name center" style="width: 10%;">รหัส</div>
	<div class="report report-name center">รายการ</div>
	<div class="report report-name center">จำนวนเงิน</div>
	<div class="report report-name center">ผู้สนันสนุน</div>
	<div class="report report-name center" style="width: 20%">สาขา</div>
</div>
<? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }  
if($m-1 > 1){  $x = 54; } 
if($n == ((($m-1) * $x) + 1) && $m > 1){
 
    ?>
<br><br>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
	<div style="width:50%; float:left; text-align:left;">
		&nbsp;สาขา <?php 
		if($branch_id == "00"){
			$cname = "ทั้งหมด";
			echo $cname;
		} else {
			echo $cname;
		}
		?>
	</div>
	<div style="width:50%; float:left; text-align:right;">
		หน้า : <?= $m; ?>&nbsp;
	</div>
</div>
<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
	<!-- <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
	<div style="width:25%; float:left; border-bottom:#999999 2px solid;">ชื่อลูกค้า</div>
	<div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
	<div style="width:20%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
	<div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
	<div style="width:25%; float:left; border-bottom:#999999 2px solid;">ผู้สนันสนุน</div> -->
	<div class="report report-no center">ลำดับ</div>
	<!-- <div class="report ">วันที่</div> -->
	<div class="report report-name center">ชื่อลูกค้า</div>
	<div class="report report-name center" style="width: 10%;">รหัส</div>
	<div class="report report-name center">รายการ</div>
	<div class="report report-name center">จำนวนเงิน</div>
	<div class="report report-name center">ผู้สนันสนุน</div>
	<div class="report report-name center" style="width: 20%">สาขา</div>
</div>
<?
} 
$ft = 'N';
if($empid != $rs['empid'] ){
$empid = $rs['empid'];  
$dname = $rs['empname'];
if($n>1){

?>
<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">
	<!-- <div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:25%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:20%; float:left; text-align:right">รวม</div>
	<div style="width:12%; float:left; text-align:right">&nbsp;<?= number_format($total, '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div style="width:25%; float:left;">-</div> -->

	<div style="width:12%; float:left;">&nbsp;</div>
	<!-- <div style="width:12%; float:left;">&nbsp;</div> -->
	<div style="width:12%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:12%; float:left; text-align:right">รวม</div>
	<div style="width:12%; float:left; text-align:right">&nbsp;<?= number_format($total, '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div style="width:20%; float:left;">-</div>
</div>
<? 
 $h=1; $m=1; $n++; 
 $total = 0;
}
?>
<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; ">
	&nbsp;<?= $dname ?>
</div>
<? 
}


$total = $total + $rs['totalprice'];
$total1 = $total1 + $rs['totalprice'];





?>


<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden;">
	<!-- <div style="width:10%; float:left;"><?= $m ?></div>
	<div style="width:25%; float:left;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
	<div style="width:8%; float:left;"><?= $rs['tid'] ?></div>
	<div style="width:20%; float:left;"><?= $rs['tname'] ?></div>
	<div style="width:12%; float:left; text-align:right"><?= number_format($rs['totalprice'], '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div style="width:25%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['cname'] ?></div> -->

	<div class="report-data report-no center" style="margin-right: 3%;"><?= $m ?></div>
	<!-- <div class="report-data report-no left" style="width: 7%; margin-right:2%;"><?= $rs['dat'] ?></div> -->
	<div class="report-data report-name left" style="margin-right:3%;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
	<div class="report-data report-num left" style="margin-right:5%;"><?= $rs['tid'] ?></div>
	<div class="report-data left"><?= $rs['tname'] ?></div>
	<div class="report-data report-num left" style=" margin-left:3%;""><?= number_format($rs['totalprice'], '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div class="report-data report-name left" style="margin-left: 6%;">&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['cname'] ?></div>
	<div class="report-data report-big left" >&nbsp;&nbsp;&nbsp;&nbsp;<?= $_SESSION['clinic_info'][$rs['branchid']]['clinicname']; ?></div>
</div>
<? 

$n++; $h++; $m++;   } 
?>
<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">
	<!-- <div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:25%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:20%; float:left; text-align:right">รวม</div>
	<div style="width:12%; float:left; text-align:right"><?= number_format($total, '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div style="width:25%; float:left;">-</div> -->

	<div style="width:12%; float:left;">&nbsp;</div>
	<!-- <div style="width:12%; float:left;">&nbsp;</div> -->
	<div style="width:12%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:12%; float:left; text-align:right">รวม</div>
	<div style="width:12%; float:left; text-align:right">&nbsp;<?= number_format($total, '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div style="width:20%; float:left;">-</div>
</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">

	<!-- <div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:25%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">รวมทั้งหมด</div>
	<div style="width:20%; float:left; text-align:right"><?= $nn . '  รายการ'; ?></div>
	<div style="width:12%; float:left; text-align:right">&nbsp;<?= number_format($total1, '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div style="width:25%; float:left; ">-</div> -->
	<div style="width:12%; float:left;">&nbsp;</div>
	<!-- <div style="width:12%; float:left;">&nbsp;</div> -->
	<div style="width:5%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">รวมทั้งหมด</div>
	<div style="width:20%; float:left; text-align:right"><?= $nn . '  รายการ'; ?></div>
	<div style="width:12%; float:left; text-align:right">&nbsp;<?= number_format($total1, '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;</div>
	<div style="width:20%; float:left; ">-</div>
</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

