<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:auto; margin:auto; height:auto;">
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');


//$nd = substr($_GET['edate'],0,2) + 1;

//$sdate = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2)  ;
//$edate = substr($_GET['edate'],6,4).'-'.substr($_GET['edate'],3,2).'-'.$nd ;
$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1);

if(!empty($_GET['branchid'])){
	$branchid = $_GET['branchid'];
} else {
	$branchid = '';
}
$where_branch_id = "";
if($branchid != "") {
	if($branchid != "00"){ 
		$where_branch_id = " and (b.branchid ='".$branchid."' or b.branchid is null ) ";
	} 
}else if($_SESSION['branch_id'] != "") {	
	$where_branch_id = " and (b.branchid ='".$_SESSION['branch_id']."'  or b.branchid is null ) ";
}
// $branchname = "";
// if($branchid != "" && $branchid != "00") {
// 	$sql2 = "select branchid,branchname from tb_branch where branchid = '$branchid' and company_code ='".$_SESSION['company_code']."' ";
// 	$result = mysql_query($sql2) or die("Error Query [".$sql2."]"); 
//     while ($rs=mysql_fetch_array($result)) {
// 		$branchname = $rs['branchname'];
//     }
// }
$branchname = get_branch_name($branchid,$_SESSION['company_code']);
// echo "x" . $branchid . "x" ;

$sql = "select distinct(b.hn) hn, b.cradno,b.pname,b.fname,b.lname,c.vdate,c.empname,c.empid,d.branchname  ";
$sql .="from tb_patient  b left join tb_vst c on b.hn = c.hn left join tb_branch d on b.branchid = d.branchid ";
$sql .= " where (c.vdate between '$sdate%' and '$edate%')  and c.status not IN ('CANCEL') $where_branch_id";
$sql .="  order by c.vdate,c.vn  ";
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 

$n=1; $m=1; $s='y'; $x = 81; 

$t1=0; $t2=0; $t3=0;
while($rs=mysql_fetch_array($result)){ 
$t1++;
switch($rs['empid']){
case '00' : $t3++; break;
case '-' : $t3++; break;

}
 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานคนไข้ <?php if($branchname != "") { echo " (สาขา $branchname)"; } ?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=$_GET['sdate'].'  ถึง  '.$_GET['edate'];?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

		<div style="width:100%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
			<?php 
				if($branchid == "") { ?>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
				<div style="width:16%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
				<div style="width:11%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
				<div style="width:47%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;แพทย์</div>
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
			<?php 
				} else { 
			?>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
				<div style="width:16%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
				<div style="width:11%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
				<div style="width:30%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;แพทย์</div>
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;สาขา</div>
				<div style="width:17%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
			<?php 		
				}
			?>
			
	</div>		
 <? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }
if($m-1 > 1){  $x = 83;} 
if($n == ((($m-1) * $x) + 1) && $m > 1){
   
    ?>
	<br>
	
	<div style="width:100%; height:25px; line-height:25px; text-align:right; font-size:12px; font-weight:bold; float:left;">

		หน้า : <?=$m.'  '.$n.'  '.$x;?>&nbsp;
		
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
			<?php 
				if($branchid == "") { ?>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
				<div style="width:16%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
				<div style="width:11%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
				<div style="width:47%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;แพทย์</div>
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
			<?php 
				} else { 
			?>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
				<div style="width:16%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
				<div style="width:11%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
				<div style="width:30%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;แพทย์</div>
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;สาขา</div>
				<div style="width:17%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
			<?php 
				} 
			?>
	</div>	
<?

 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden; ">
		<?php 
		if($branchid == "") { ?>
		<div style="width:8%; float:left; text-align:center;"><?=$n?></div>
		<div style="width:15%; float:left;">&nbsp;<?=$rs['vdate']?></div>
		<div style="width:10%; float:left;">&nbsp;<?=$rs['cradno']?></div>
		<div style="width:31%; float:left; text-align:left">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
		<div style="width:31%; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['empname']?></div>	
		<?php 
			} else { 
		?>
		<div style="width:8%; float:left; text-align:center;"><?=$n?></div>
		<div style="width:15%; float:left;">&nbsp;<?=$rs['vdate']?></div>
		<div style="width:10%; float:left;">&nbsp;<?=$rs['cradno']?></div>
		<div style="width:21%; float:left; text-align:left">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
		<div style="width:21%; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['empname']?></div>		
		<div style="width:20%; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['branchname']?></div>			
		<?php 
			} 
		?>
</div>	
	
	
<? $n++; } 

?>	

	
								
	
</div>

</div>
