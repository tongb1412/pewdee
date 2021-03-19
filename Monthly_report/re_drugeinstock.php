<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');
$did = $_GET['did'];
$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 


$dname ='';
$sql = "select tname from tb_druge where did='$did' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$n = mysql_num_rows($result);
if(!empty($n)){
	$rs = mysql_fetch_array($result);
	$dname = 'ยา : '.$rs['tname'];
} else {
	$dname = 'ยา : ทั้งหมด';
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

if(empty($did)){
	$sql  = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*, d.cn, d.clinicname from tb_instock a, tb_drugeinstock b,tb_staff c, tb_clinicinformation d  where (a.lno=b.lno) and (a.empid = c.staffid)  and (a.ldate between '$sdate' and '$edate') and a.branchid = d.cn " . $where_branch_id;
} else {
	$sql  = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*, d.cn, d.clinicname from tb_instock a, tb_drugeinstock b,tb_staff c, tb_clinicinformation d  where (a.lno=b.lno) and (a.empid = c.staffid)  and (a.ldate between '$sdate' and '$edate') and (b.did like '%$did%') and a.branchid = d.cn " . $where_branch_id;
}

$sql .=" order by ldate,a.lno,did asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 65;

$tt=0; 
while($rs = mysql_fetch_array($result)){  
	
	if($s == 'y'){ 	
	?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
		รายงานการรับเข้ายาเข้าสต็อค
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
		ช่วงวันที่ <?= $_GET['sdate'] . '  ถึง  ' . $_GET['edate']; ?>
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
		<div class="report report-no center">ลำดับ</div>
		<div class="report report-no center">วันที่รับ</div>
		<div class="report report-name center">ผู้รับเข้า</div>
		<div class="report report-num center" style="width: 10%;">Lot no</div>
		<div class="report center">ยา</div>
		<div class="report report-no right" style="width: 13%">จำนวนรับ</div>
		<div class="report report-no right">คงเหลือ</div>
		<div class="report report-no right">เลขที่บิล</div>
		<div class="report center">ชื่อผู้ขาย</div>
		<div class="report center">สาขา</div>
	</div>

	<? 
	$s='n';
	}
	if( $n > ($m * $x) ){ $m++; }  
	if($m-1 > 1){  $x = 67; } 
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
		<div class="report report-no center">ลำดับ</div>
		<div class="report report-no center">วันที่รับ</div>
		<div class="report report-name center">ผู้รับเข้า</div>
		<div class="report report-num center" style="width: 10%;">Lot no</div>
		<div class="report center">ยา</div>
		<div class="report report-no right" style="width: 13%">จำนวนรับ</div>
		<div class="report report-no right">คงเหลือ</div>
		<div class="report report-no right">เลขที่บิล</div>
		<div class="report center">ชื่อผู้ขาย</div>
		<div class="report center">สาขา</div>
	</div>
	<?
	} 
	?>

	<div style="width:100%; font-size:10px; text-align: left; float:left; margin:auto; height:15px; overflow:hidden; ">
		<div style="width:6%; float:left;text-align: center;"><?= $n ?></div>
		<div style="width:8%; float:left;">&nbsp;<?= $rs['ldate'] ?></div>
		<div style="width:15%; float:left;">&nbsp;<?= $rs['fname'] . '    ' . $rs['lname'] ?></div>
		<div style="width:10%; text-align:left; float:left;">&nbsp;<?= $rs['lno'] ?></div>
		<div style="width:15%; float:left; overflow:hidden;">&nbsp;<?= $rs['dname'] ?></div>
		<div style="width:10%; float:left;text-align: center;">&nbsp;
			<? echo number_format($rs['qty'],'0','.',',') ?>
		</div>
		<div style="width:5%; float:left;text-align: center;">&nbsp;
			<? echo number_format($rs['total'],'0','.',',') ?>
		</div>
		<!-- <div style="width:8%; float:left;">&nbsp;<?= $rs['unit'] ?></div> -->
		<div style="width:8%; float:left;">&nbsp;<?= $rs['sid'] ?></div>
		<div style="width:8%; float:left;margin-left:2%">&nbsp;<?= $rs['sname'] ?></div>
		<div style="width:8%; float:left;">&nbsp;<?= $rs['clinicname'] ?></div>
	</div>


<? $n++; } ?>