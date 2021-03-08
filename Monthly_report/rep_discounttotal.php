<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];
$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

//$sdate = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2)  ;
//$edate = substr($_GET['edate'],6,4).'-'.substr($_GET['edate'],3,2).'-'.$nd ;

$sqlC .="select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname']; 

$dname ='';

$empid = '';

$where_branch_id = "";
if($_SESSION['branch_id'] !="") {
	$where_branch_id = " and a.branchid ='".$_SESSION['branch_id']."'  ";
}

if(empty($did)){
$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.empid,c.empname from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate  between '$sdate%' and '$edate%') and (c.status='COM') and a.discount <> 0 ";
} else {
$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.empid,c.empname from tb_payment a,tb_patient b,tb_vst c  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate  between '$sdate%' and '$edate%') and (c.empid like '%$did%') and c(c.status='COM') and a.discount <> 0 ";
}

$sql .=" $where_branch_id order by c.empid,a.billno asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0;

$dp =0; $lp=0; $tp=0; $cp=0; $pp=0; $ds=0; $tt=0; $re=0; $aa=0; $total = 0;
$dp1 =0; $lp1=0; $tp1=0; $cp1=0; $pp1=0; $ds1=0; $tt1=0; $re1=0; $aa1=0; $total1 = 0; $cash = 0; $credit = 0; $ku = 0;

while($rs=mysql_fetch_array($result)){  
$nn++;




 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานส่วนลดทั้งหมด
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=$_GET['sdate'].'  ถึง  '.$_GET['edate'];?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
		&nbsp;สาขา <?=$cname?>
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
      <div style="width:4%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid; overflow:hidden">Crad No.</div>
      <div style="width:14%; float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
      <div style="width:9%; float:left; border-bottom:#999999 2px solid;">ค่ายา</div>
      <div style="width:9%; float:left; border-bottom:#999999 2px solid;">หัตถการ</div>
      <div style="width:9%; float:left; border-bottom:#999999 2px solid;">เลเซอร์</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">คอร์ส</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">แพ็คเกจ</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">รวมเงิน</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">ส่วนลด</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">รับเงิน</div>

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
		&nbsp;สาขา <?=$cname?>
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?=$m;?>&nbsp;
		</div>
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
      <div style="width:4%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid; overflow:hidden">Crad No.</div>
      <div style="width:14%; float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
      <div style="width:9%; float:left; border-bottom:#999999 2px solid;">ค่ายา</div>
      <div style="width:9%; float:left; border-bottom:#999999 2px solid;">หัตถการ</div>
      <div style="width:9%; float:left; border-bottom:#999999 2px solid;">เลเซอร์</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">คอร์ส</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">แพ็คเกจ</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">รวมเงิน</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">ส่วนลด</div>
	  <div style="width:9%; float:left; border-bottom:#999999 2px solid;">รับเงิน</div>
	</div>	
<?
} 
$ft = 'N';
if($empid != $rs['empid'] ){
$empid = $rs['empid'];  
if($empid=='-'){ $dname = 'ซื้อยาหน้าร้าน';  } else { $dname = $rs['empname']; }
if($n>1){

?>
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<div style="width:4%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:14%; float:left; text-align:center"><?=$h - 1 .'  รายการ';?>&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($dp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($lp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($tp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?=number_format($cp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($pp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($tt1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($ds1,'0','.',',')?>&nbsp;&nbsp;</div>

	<div style="width:9%; text-align:right; float:left;"><?=number_format($re1,'0','.',',')?>&nbsp;&nbsp;</div>

</div>
<? 
 $h=1; $m=1; $n++;
$dp1 =0; $lp1=0; $tp1=0; $cp1=0; $pp1=0; $ds1=0; $tt1=0; $re1=0; $aa1=0; $total1 = 0;$cash1 = 0;$credit1 = 0; $ku1 = 0;
}
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; ">			
	&nbsp;<?=$dname?>
</div>
<? 
}


$dp = $dp + $rs['dp'];
$lp = $lp + $rs['lp'];
$tp = $tp + $rs['tp'];
$cp = $cp + $rs['cp'];
$pp = $pp + $rs['pp'];
$ds = $ds + $rs['discount'];
$tt = $tt + $rs['total'];
$cash = $cash + $rs['cash'];
$credit = $credit + $rs['credit'];
$ku = $ku + $rs['ku'];
$total = $total + ($rs['total'] -  $rs['discount']);


$dp1 = $dp1 + $rs['dp'];
$lp1 = $lp1 + $rs['lp'];
$tp1 = $tp1 + $rs['tp'];
$cp1 = $cp1 + $rs['cp'];
$pp1 = $pp1 + $rs['pp'];
$ds1 = $ds1 + $rs['discount'];
$tt1 = $tt1 + $rs['total'];
$cash1 = $cash1 + $rs['cash'];
$credit1 = $credit1 + $rs['credit'];
$ku1 = $ku1 + $rs['ku'];
$total1 = $total1 + ($rs['total'] -  $rs['discount']);




if($rs['recive'] < $rs['total']){	
	$recive = $rs['cash'] + $rs['credit'] + $rs['ku'];
	$re = $re + $recive;
	$aa = $aa + (($rs['total'] - $rs['discount']) - $recive);
	
	$re1 = $re1 + $recive;
	$aa1 = $aa1 + (($rs['total'] - $rs['discount']) - $recive);	
	
	$ar = ($rs['total'] - $rs['discount']) - $recive;
} else {
	$re = $re + ($rs['total'] -  $rs['discount']);
	$re1 = $re1 + ($rs['total'] -  $rs['discount']);
	
	$recive = $rs['total'] - $rs['discount'];
	$ar = 0;
}








?>	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden; ">
	<div style="width:4%; float:left; text-align:center;"><?=$m?></div>
	<div style="width:10%; float:left;">&nbsp;<?=$rs['cradno']?></div>
	<div style="width:14%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname'].'  '  ?></div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($rs['dp'],'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($rs['lp'],'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($rs['tp'],'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?=number_format($rs['cp'],'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($rs['pp'],'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($rs['total'],'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($rs['discount'],'0','.',',')?>&nbsp;&nbsp;</div>

	<div style="width:6%; text-align:right; float:left;"><?=number_format($recive,'0','.',',')?>&nbsp;&nbsp;</div>

	
								
	
</div>	
<? 

$n++; $h++; $m++;   } 
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<div style="width:4%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:14%; float:left; text-align:center"><?=$h - 1 .'  รายการ';?>&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($dp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($lp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($tp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?=number_format($cp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($pp1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($tt1,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($ds1,'0','.',',')?>&nbsp;&nbsp;</div>

	<div style="width:9%; text-align:right; float:left;"><?=number_format($re1,'0','.',',')?>&nbsp;&nbsp;</div>

</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">
	<div style="width:4%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:10%; float:left;">รวมทั้งหมด&nbsp;</div>
	<div style="width:14%; float:left; text-align:center"><?=$nn.'  รายการ';?>&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($dp,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($lp,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($tp,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?=number_format($cp,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($pp,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($tt,'0','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?=number_format($ds,'0','.',',')?>&nbsp;&nbsp;</div>

	<div style="width:9%; text-align:right; float:left;"><?=number_format($re,'0','.',',')?>&nbsp;&nbsp;</div>

	
								
	
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

