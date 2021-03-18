<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');
//$sdate = $_GET['sdate'];
//$edate = $_GET['edate'];

/*$nd = substr($_GET['edate'],0,2) + 1; 
if(strlen($nd)==1){ $nd = '0'.$nd; }
$sdate = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2)  ;
$edate = substr($_GET['edate'],6,4).'-'.substr($_GET['edate'],3,2).'-'.$nd ;*/
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
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.pdate, d.cn, d.clinicname  from tb_apayment a,tb_patient  b,tb_payment c, tb_clinicinformation d where (a.hn = b.hn) and (a.billno = c.billno) and (c.pdate between '$sdate%' and '$edate%') and a.branchid = d.cn " . $where_branch_id;
$sql .=" order by a.billno asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 54;

 $tt=0; 
while($rs=mysql_fetch_array($result)){  

$tt = $tt + $rs['total'];



 
if($s=='y'){ 	
	?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
		รายงานคนไข้ค้างชำระ
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
		ช่วงวันที่ <?= $sdate ?> ถึง <?= $edate ?>
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
		<div class="report" style="width: 10%;">ลำดับ</div>
		<div class="report" style="width: 10%;">Crad No.</div>
		<div class="report" style="width: 30%;">ชื่อ-สกุล</div>
		<div class="report" style="width: 20%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนเงิน</div>
		<div class="report" style="width: 10%;">เลขที่ใบเสร็จ</div>
		<div class="report" style="width: 20%;">สาขา</div>
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
			<div class="report" style="width: 10%;">ลำดับ</div>
			<div class="report" style="width: 10%;">Crad No.</div>
			<div class="report" style="width: 30%;">ชื่อ-สกุล</div>
			<div class="report" style="width: 20%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนเงิน</div>
			<div class="report" style="width: 10%;">เลขที่ใบเสร็จ</div>
			<div class="report" style="width: 20%;">สาขา</div>
		</div>
	<?
	} 
	?>

	<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">
		<div class="report-data center"><?= $n ?></div>
		<div class="report-data left"><?= $rs['cradno'] ?></div>
		<div class="report-data left" style="margin-left: 7%;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
		<div class="report-data left" style="margin-left: 16%;"><?= number_format($rs['total'], '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div class="report-data left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['billno'] ?></div>
		<div class="report-data left" style="margin-left: 2%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['clinicname'] ?></div>
	</div>

<? $n++; } ?>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;">
	<div class="report-data left">&nbsp;</div>
	<div class="report-data left">&nbsp;</div>
	<div class="report-data left" style="margin-left:22%;">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div class="report-data left"><?= number_format($tt, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<!-- <div class="report-data left"><?= '-' ?></div> -->
</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>