<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');
// $did = $_GET['did'];

$dat = date('Y-m-d');
$dat = "2011-03-22";

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
	$sql = "select a.totalprice, a.branchid,b.tid,b.pid,b.ftyp,b.typ,b.tname,b.qty,b.empid,b.ename,c.cradno,c.pname,c.fname,c.lname,(a.totalprice / a.qty) priceunit,((a.totalprice / a.qty)*b.qty) price ";
	$sql .= " from tb_pctrec a,tb_pctuse b,tb_patient c where (a.hn = c.hn) and  (b.dat like '%$dat%') and (a.vn = b.vn) and (a.tid = b.pid) ";
} else {
	$sql = "select a.totalprice, a.branchid,b.tid,b.ftyp,b.typ,b.tname,b.qty,b.empid,b.ename,c.cradno,c.pname,c.fname,c.lname,(a.totalprice / a.qty) priceunit,((a.totalprice / a.qty)*b.qty) price ";
	$sql .= " from tb_pctrec a,tb_pctuse b,tb_patient c where (a.hn = c.hn) and  (b.dat like '%$dat%') and (a.vn = b.vn) and (a.tid = b.pid) and (b.empid like '%$did%') ";
}

$sql .=" $where_branch_id order by b.empid asc ";

$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0; $total = 0;




while($rs=mysql_fetch_array($result)){  
$nn++;




 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานรายได้การผู้ให้บริการ 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=date('d/m/Y',time());?> 
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
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <!-- <div style="width:8%;  float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:22%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">ชื่อลูกค้า</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ราคา</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">ประเภท</div> -->

	  	<div class="report report-no center">ลำดับ</div>
		<div class="report report-num center">รหัส</div>
		<div class="report report-name center">รายการ</div>
		<div class="report report-no center">จำนวน</div>
		<div class="report report-name center" style="width:18%">ชื่อลูกค้า</div>
		<div class="report center">ราคา</div>
		<div class="report report-name center">ประเภท</div>
		<!-- <div class="report report-num center" >วันที่</div> -->
		<div class="report report-name center" >สาขา</div>	  
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
		หน้า : <?=$m;?>&nbsp;
		</div>
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <!-- <div style="width:8%;  float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:22%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">ชื่อลูกค้า</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ราคา</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">ประเภท</div> -->

	  <div class="report report-no center">ลำดับ</div>
		<div class="report report-num center">รหัส</div>
		<div class="report report-name center">รายการ</div>
		<div class="report report-no center">จำนวน</div>
		<div class="report report-name center" style="width:18%">ชื่อลูกค้า</div>
		<div class="report center">ราคา</div>
		<div class="report report-name center">ประเภท</div>
		<!-- <div class="report report-num center" >วันที่</div> -->
		<div class="report report-name center" >สาขา</div>
	</div>	
<?
} 
$ft = 'N'; 
if($empid != $rs['empid'] ){
	$empid = $rs['empid'];  
	$dname = $rs['ename'];


	if($n>1){

	?>
	<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
		<div style="width:5%; float:left; text-align:center;">&nbsp;</div>
		<div style="width:47%; float:left;">&nbsp;</div>
		<div style="width:20%; float:left; text-align:right">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div style="width:7%; text-align:right; float:left; text-align:right"><?=number_format($total,'0','.',',')?></div>
	</div>
	<? 
	$h=1; $m=1; $n++;  $total = 0;
	}
	?>	
	<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; ">			
		&nbsp;<?=$dname?>
	</div>
	<? 
}

switch($rs['ftyp']){
case 'PC' : $pid = $rs['pid']; $cid = $rs['tid']; $ftype = 'แพ็คเกจ'; 
            $t_sql = "select qty,typ,id from tb_package_detail where pid='$pid' ";
			$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
			$row=mysql_fetch_array($str);
			$qty = $row['qty']; 
			if($row['typ']=='C'){
			    $tid = $row['id'];  
				$t_sql = "select b.qty from tb_package_detail a,tb_course_detail b where a.id=b.cid and a.pid='$pid'  and b.tid='$cid' ";
				$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
				
				$row=mysql_fetch_array($str);
				$qty = $qty * $row['qty'];
				$price = ( $rs['totalprice'] / $qty ) * $rs['qty']; 			
			} else {
				$t_sql = "select qty from tb_package_detail where pid='$pid' and id='$cid' ";
				$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
				$row=mysql_fetch_array($str);
				$price = ( $rs['totalprice'] / $qty ) * $rs['qty'];					
			}
			break;
case 'C' :  $cid = $rs['pid']; $tid = $rs['tid']; $ftype = 'คอร์ส'; 
            $t_sql = "select qty from tb_course_detail where cid='$cid' and tid='$tid' ";
			$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
			$row=mysql_fetch_array($str);
			$price = ( $rs['totalprice'] / $row['qty'] ) * $rs['qty']; 			
			break;
case 'T' :  $price =  $rs['totalprice']; 
            if ( $rs['typ']=='L') { $ftype = 'เลเซอร์'; } else { $ftype = 'ทรีทเมนท์';  } 			
		    break;
}
$price =  $rs['price']; 
$total = $total + $price;
$total1 = $total1 + $price;










?>	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden;  ">
	<!-- <div style="width:8%; text-align: center; float:left;"><?=$m?></div>
	<div style="width:10%; float:left;"><?=$rs['tid']?></div>
	<div style="width:22%; float:left;"><?=$rs['tname']?></div>	
	<div style="width:10%; text-align: center; float:left;">&nbsp;<?=number_format($rs['qty'],'0','.',',')?></div>
	<div style="width:20%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:10%; text-align:right; float:left;">&nbsp;<?=number_format($price,'0','.',',')?>&nbsp;&nbsp;&nbsp;&nbsp</div>
	<div style="width:20%; float:left; text-align: center;"><?=$ftype?></div> -->

	<div class="report-data report-no center"><?= $m ?></div>
	<div class="report-data report-num"><?= $rs['tid'] ?></div>
	<div class="report-data report-name" style="margin-left: 3%;"><?= $rs['tname'] ?></div>
	<div class="report-data report-no">&nbsp;<?= number_format($rs['qty'], '0', '.', ',') ?></div>
	<div class="report-data report-name"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
	<div class="report-data report-num" style="margin-left: 3%;">&nbsp;<?= number_format($price, '0', '.', ',') ?>&nbsp;&nbsp;&nbsp;&nbsp</div>
	<div class="report-data report-num" style="margin-left: 9%;"><?= $ftype ?></div>
	<div class="report-data report-name" style="margin-left: 7%;"><?= $_SESSION['clinic_info'][$rs['branchid']]['clinicname']; ?></div>	
</div>	
<? 

$n++; $h++; $m++;   } 
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<div style="width:5%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:47%; float:left;">&nbsp;</div>
	<div style="width:20%; float:left; text-align:right">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:7%; text-align:right; float:left; text-align:right"><?=number_format($total,'0','.',',')?></div>
</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">

	<div style="width:10%; float:left;">&nbsp;</div>
    <div style="width:25%; float:left;">&nbsp;</div>
	<div style="width:10%; float:left;">รวมทั้งหมด</div>
	<div style="width:22%; float:left; text-align:right"><?=$nn.'  รายการ';?></div>	
    <div style="width:12%; float:left; text-align:right">&nbsp;<?=number_format($total1,'0','.',',')?></div>	
	<div style="width:20%; float:left; text-align:center ">-</div>	
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

