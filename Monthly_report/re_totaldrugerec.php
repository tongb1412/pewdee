<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
if(!empty($n)) {
	$rs=mysql_fetch_array($result);
	$dname = 'ยา : '.$rs['tname'];
} else {
	$dname = 'ยา : ทั้งหมด';
}

if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

$sqlC .="select clinicname from tb_clinicinformation where cn = '$branch_id'";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs = mysql_fetch_array($strc);
$cname = $rs['clinicname'];

$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

?>



<? 


if(empty($did)){
	$sql  = "select a.did,a.dname,sum(a.qty) qty,count(*) count from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status <> 'CANCLE'  and a.hn=c.hn and (b.vdate between '$sdate%' and '$edate%') ";
} else {
	$sql  = "select a.did,a.dname,sum(a.qty) qty,count(*) count from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status <> 'CANCLE'  and a.hn=c.hn and (b.vdate between '$sdate%' and '$edate%') and (a.did like '%$did%') ";

}

$sql .= $where_branch_id . " group by a.did,a.dname order by a.did asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 81;

 $tt=0; 
while($rs = mysql_fetch_array($result)){  





 
	if($s=='y'){ 	
		?>
		<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
			รายงานการจ่ายยา
		</div>
		<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
			ประจำวันที่ <?= $_GET['sdate'] . '  ถึง  ' . $_GET['edate']; ?>
		</div>
		<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
			<div style="width:50%; float:left; text-align:left;">
				<?= $dname ?>&nbsp;
				&nbsp;สาขา
					<?php
					if ($branch_id == "00") {
						echo "ทั้งหมด";
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
			<div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
			<div style="width:40%; float:left; border-bottom:#999999 2px solid;">ยา</div>
			<div style="width:25%; float:left; border-bottom:#999999 2px solid;">จำนวนยา</div>
			<div style="width:25%; float:left; border-bottom:#999999 2px solid;">จำนวนคน</div>
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
					&nbsp;สาขา
					<?php
					if ($branch_id == "00") {
						echo "ทั้งหมด";
					} else {
						echo $cname;
					}
					?>
				</div>
				<div style="width:50%; float:left; text-align:right;">
					หน้า : <?= $m; ?>&nbsp;
				</div>
			</div>
			<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
				<div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
				<div style="width:40%; float:left; border-bottom:#999999 2px solid;">ยา</div>
				<div style="width:25%; float:left; border-bottom:#999999 2px solid;">จำนวนยา</div>
				<div style="width:25%; float:left; border-bottom:#999999 2px solid;">จำนวนคน</div>
			</div>

		<?
		} 
		?>

		<div style="width:100%; font-size:10px; text-align: left; float:left; margin:auto; overflow:hidden; ">
			<div style="width:10%; float:left;text-align: center;"><?= $n ?></div>
			<div style="width:30%; float:left; margin-left:10%;">&nbsp;<?= $rs['dname'] ?></div>
			<div style="width:15%; float:left;text-align: left;margin-left:10%;">&nbsp;
				<? echo number_format($rs['qty'],'0','.',',') ?>
			</div>
			<div style="width:15%; float:left;text-align: left;margin-left:10%;">&nbsp;
				<? echo number_format($rs['count'],'0','.',',') ?>
			</div>
		</div>

	<? $n++; } ?>