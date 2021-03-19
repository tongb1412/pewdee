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
$sql = "select tname from tb_druge where did='$did'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$n = mysql_num_rows($result);
if(!empty($n)){
	$rs=mysql_fetch_array($result);
	$dname = 'ยา : '.$rs['tname'];
} else {
	$dname = 'ยา : ทั้งหมด';
}


?>



<? 
if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = "";
}
$as = "a";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

if(empty($did)){
$sql  = "select a.*,b.vdate,c.fname,c.lname,c.cradno, d.cn, d.clinicname from tb_drugerec a,tb_vst b,tb_patient c, tb_clinicinformation d where a.vn = b.vn and b.status = 'COM'  and a.hn=c.hn and (b.vdate between '$sdate%' and '$edate%') and a.branchid = d.cn " . $where_branch_id;
} else {
$sql  = "select a.*,b.vdate,c.fname,c.lname,c.cradno, d.cn, d.clinicname from tb_drugerec a,tb_vst b,tb_patient c, tb_clinicinformation d where a.vn = b.vn and b.status = 'COM'  and a.hn=c.hn and (b.vdate between '$sdate%' and '$edate%') and (a.did like '%$did%') and a.branchid = d.cn " . $where_branch_id;

}

$sql .=" $where_branch_id order by vdate asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 81;

 $tt=0; 
while($rs=mysql_fetch_array($result)){  





 
if($s=='y'){ 	
?>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานการจ่ายยา
</div>
<!--	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ช่วงวันที่ <?= $sdate ?>  ถึง  <?= $edate ?>
	</div>-->
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
	<div style="width:50%; float:left; text-align:left;">
		<?= $dname ?>&nbsp;
	</div>
	<div style="width:50%; float:left; text-align:right;">
		หน้า : <?= '1'; ?>&nbsp;
	</div>

</div>
<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
	<div class="report report-no center" style="width: 8%;">ลำดับ</div>
	<div class="report report-name">Crad No.</div>
	<div class="report ">วันที่</div>
	<div class="report report-name">คนไข้</div>
	<div class="report report-name">ยา</div>
	<div class="report report-name">จำนวน</div>
	<div class="report report-name">สาขา</div>

</div>


<? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }  
if($m-1 > 1){  $x = 86; } 
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
	<div class="report report-no center" style="width: 8%;">ลำดับ</div>
	<div class="report report-name">Crad No.</div>
	<div class="report ">วันที่</div>
	<div class="report report-name">คนไข้</div>
	<div class="report report-name">ยา</div>
	<div class="report report-name">จำนวน</div>
	<div class="report report-name">สาขา</div>
</div>




<?
 } 
?>



<div style="width:100%; font-size:10px; text-align: left; float:left; margin:auto; overflow:hidden; ">
	<div class="report-data report-no center" style="width: 8%;"><?= $n ?></div>
	<div class="report-data report-name" style="margin-left: 4%">&nbsp;<?= $rs['cradno'] ?></div>
	<div class="report-data ">&nbsp;<?= $rs['vdate'] ?></div>
	<div class="report-data report-name">&nbsp;<?= $rs['fname'] . '    ' . $rs['lname'] ?></div>
	<div class="report-data report-name">&nbsp;<?= $rs['dname'] ?></div>
	<div class="report-data report-no" style="margin-left: 4%">
		<? echo number_format($rs['qty'],'0','.',',') ?>
	</div>
	<div class="report-data report-name" style="margin-left: 1%"><?= $rs['clinicname'] ?></div>
</div>


<? $n++; } ?>