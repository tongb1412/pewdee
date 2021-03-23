<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');

$dat = date('d-m-Y',time());
// $dat = "2011-08-07";

if(!empty($_REQUEST['branchid'])) {
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.pdate from tb_apayment a,tb_patient  b,tb_payment c where (a.hn = b.hn) and (a.billno = c.billno) and (c.pdate like '%$dat%') $where_branch_id ";
$sql .=" order by a.branchid, a.billno asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 
// echo $sql;
$n=1; $m=1; $s='y'; $x = 54;
$tt=0;
$flag_branch = ""; 
while($rs = mysql_fetch_array($result)){

// $tt = $tt + $rs['credit'];
$tt = $tt + $rs['total'];



 
if($s=='y'){ 	
	?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
		รายงานคนไข้ค้างชำระ
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
		ประจำวันที่ <?= date('d/m/Y', time()); ?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
			<?= $dname ?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
			หน้า : <?= '1'; ?>&nbsp;
		</div>

	</div>
	<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
		<div style="width:20%; float:left; border-bottom:#999999 2px solid;">Crad No.</div>
		<div style="width:30%; float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
		<div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
		<div style="width:20%; float:left; border-bottom:#999999 2px solid;">เลขที่ใบเสร็จ</div>
	</div>
	<? 
	$s='n';
	}
	if( $n > ($m * $x) ){ $m++; }  
	if($m-1 > 1){  $x = 58; } 
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
		<div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
		<div style="width:20%; float:left; border-bottom:#999999 2px solid;">Crad No.</div>
		<div style="width:30%; float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
		<div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
		<div style="width:20%; float:left; border-bottom:#999999 2px solid;">เลขที่ใบเสร็จ</div>
	</div>
	
	<?
	}
	if($flag_branch != $rs['branchid']){
		$flag_branch = $rs['branchid'];
		?>
		<div style="width:100%; height:30px; line-height:25px; text-align:left; font-size:10px; font-weight:bold;  float:left; ">
			<div style="width:30%; float:left;">สาขา <?php echo $_SESSION['clinic_info'][$rs['branchid']]['clinicname'] ?></div>
		</div>
		<?php
	}
	?>
	<div style="width:100%; font-size:10px; text-align: center; float:left; margin:auto; ">
		<div style="width:10%; float:left;"><?= $n ?></div>
		<div style="width:10%; float:left;"><?= $rs['cradno'] ?></div>
		<div style="width:30%; float:left;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
		<div style="width:20%; float:left;"><?= number_format($rs['total'], '0', '.', ',') ?></div>
		<div style="width:20%; float:left;"><?= $rs['billno'] ?></div>
	</div>

<? $n++; } ?>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:5%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:47%; float:left;">&nbsp;</div>
	<div style="width:20%; float:left; text-align:right">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:6%; text-align:right; float:left;"><?= number_format($tt, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:20%; float:left; text-align:center"><?= '-' ?></div>



</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>