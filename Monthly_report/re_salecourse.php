<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];

$t0 = strtotime($_GET['sdate']);
//$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$t1 = strtotime($_GET['edate']) ;
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

/*$nd = substr($_GET['edate'],0,2) + 1; 
if(strlen($nd)==1){ $nd = '0'.$nd; }
$sdate = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2)  ;
$edate = substr($_GET['edate'],6,4).'-'.substr($_GET['edate'],3,2).'-'.$nd ;*/

$sqlC .="select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$dname ='';

$empid = '';

if(empty($did)){
$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat between '$sdate%' and '$edate%') and (a.typ ='C' ) ";
} else {
$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat between '$sdate%' and '$edate%') and (a.typ ='C' ) and (a.empid like '%$did%') ";
}

$sql .=" order by a.empid ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0;

$total = 0; $qtotal = 0;
$total1 = 0; $qtotal1 = 0;

while($rs=mysql_fetch_array($result)){  
$nn++;




 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานรายได้การขายคอร์ส 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=$_GET['sdate'];?> ถึง  <?=$_GET['edate'];?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
		&nbsp;สาขา <?=$cname?>
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">ชื่อลูกค้า</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:15%; float:left; border-bottom:#999999 2px solid;">รายการ</div> 
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>     
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">ราคา</div>
	  <div style="width:15%; float:left; border-bottom:#999999 2px solid;">ผู้สนันสนุน</div>	 
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
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">ชื่อลูกค้า</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:15%; float:left; border-bottom:#999999 2px solid;">รายการ</div>   
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>   
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">ราคา</div>
	  <div style="width:15%; float:left; border-bottom:#999999 2px solid;">ผู้สนันสนุน</div>
	</div>	
<?
} 
$ft = 'N';
if($empid != $rs['empid'] ){
$empid = $rs['empid'];  
$dname = $rs['empname'];
if($n>1){

?>
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<div style="width:8%; float:left;">&nbsp;</div>
    <div style="width:12%; float:left;">&nbsp;</div>
    <div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:15%; float:left; text-align:right">รวม</div>	
    <div style="width:10%; float:left; text-align:right">&nbsp;<?=number_format($qtotal,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
    <div style="width:12%; float:left; text-align:right">&nbsp;<?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left;">-</div>		
</div>
<? 
 $h=1; $m=1; $n++;
 $total = 0; $qtotal = 0;
}
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; ">			
	&nbsp;<?=$dname?>
</div>
<? 
}

$qtotal = $qtotal + $rs['qty'];
$total = $total + $rs['totalprice'];
$total1 = $total1 + $rs['totalprice'];
$qtotal1 = $qtotal1 + $rs['qty'];




?>	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden;  ">
	<div style="width:8%; float:left;"><?=$m?></div>
    <div style="width:12%; float:left;"><?=$rs['dat']?></div>
    <div style="width:20%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:8%; float:left;"><?=$rs['tid']?></div>
	<div style="width:15%; float:left;"><?=$rs['tname']?></div>
    <div style="width:10%; float:left; text-align:right"><?=number_format($rs['qty'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>
    <div style="width:12%; float:left; text-align:right"><?=number_format($rs['totalprice'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['cname']?></div>
	
</div>	
<? 

$n++; $h++; $m++;   } 
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<div style="width:8%; float:left;">&nbsp;</div>
    <div style="width:12%; float:left;">&nbsp;</div>
    <div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:15%; float:left; text-align:right">รวม</div>	
    <div style="width:10%; float:left; text-align:right"><?=number_format($qtotal,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
    <div style="width:12%; float:left; text-align:right"><?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left;">-</div>	
</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">

	<div style="width:8%; float:left;">&nbsp;</div>
    <div style="width:12%; float:left;">&nbsp;</div>
    <div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">รวมทั้งหมด</div>
	<div style="width:15%; float:left; text-align:right"><?=$nn.'  รายการ';?></div>	
    <div style="width:10%; float:left; text-align:right">&nbsp;<?=number_format($qtotal1,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
    <div style="width:12%; float:left; text-align:right">&nbsp;<?=number_format($total1,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left; ">-</div>	
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

