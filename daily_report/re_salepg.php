<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];

$dat = date('Y-m-d');

$sqlC .="select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$dname ='';

$empid = '';

if(empty($did)){
$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat like '%$dat%') and (a.typ ='P' ) ";
} else {
$sql  = "select a.*,b.cradno,b.pname,b.fname,b.lname ";
$sql .= "from tb_pctrec a,tb_patient  b where (a.hn = b.hn) and  (a.dat like '%$dat%') and (a.typ ='P' ) and (a.empid like '%$did%') ";
}


$sql .=" order by a.empid ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0;

$total = 0;
$total1 = 0;

$qtotal = 0;
$qtotal1 = 0;

while($rs=mysql_fetch_array($result)){  
$nn++;




 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานรายได้การขายแพ็คเกจ 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=date('d/m/Y',time());?> 
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
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;ชื่อลูกค้า</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:15%; float:left; border-bottom:#999999 2px solid;">รายการ</div>   
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>   
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">ราคา</div>
	  <div style="width:15%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;ผู้สนันสนุน</div> 
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
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;ชื่อลูกค้า</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:15%; float:left; border-bottom:#999999 2px solid;">รายการ</div>   
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>   
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">ราคา</div>
	  <div style="width:15%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;ผู้สนันสนุน</div>
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
	<div style="width:10%; float:left;">&nbsp;</div>
    <div style="width:25%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:15%; float:left; text-align:right">รวม</div>	
    <div style="width:10%; float:left; text-align:right">&nbsp;<?=number_format($qtotal,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>
    <div style="width:12%; float:left; text-align:right">&nbsp;<?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left; text-align:right">-</div>	
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


$total = $total + $rs['totalprice'];
$total1 = $total1 + $rs['totalprice'];


$qtotal = $qtotal + $rs['qty'];
$qtotal1 = $qtotal1 + $rs['qty'];


?>	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden;  ">
	<div style="width:10%; float:left;"><?=$m?></div>
    <div style="width:25%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:8%; float:left;"><?=$rs['tid']?></div>
	<div style="width:15%; float:left;"><?=$rs['tname']?></div>
    <div style="width:10%; float:left; text-align:right"><?=number_format($rs['qty'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
    <div style="width:12%; float:left; text-align:right"><?=number_format($rs['totalprice'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left;"><?=$rs['cname']?></div>
	
	
</div>	
<? 

$n++; $h++; $m++;   } 
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<div style="width:10%; float:left;">&nbsp;</div>
    <div style="width:25%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">&nbsp;</div>
	<div style="width:15%; float:left; text-align:right">รวม</div>	
    <div style="width:10%; float:left; text-align:right"><?=number_format($qtotal,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
    <div style="width:12%; float:left; text-align:right"><?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left; text-align:right">-</div>	
</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">

	<div style="width:10%; float:left;">&nbsp;</div>
    <div style="width:25%; float:left;">&nbsp;</div>
	<div style="width:8%; float:left;">รวมทั้งหมด</div>
	<div style="width:15%; float:left; text-align:right"><?=$nn.'  รายการ';?></div>	
    <div style="width:10%; float:left; text-align:right">&nbsp;<?=number_format($qtotal1,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>
    <div style="width:12%; float:left; text-align:right">&nbsp;<?=number_format($total1,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:15%; float:left; text-align:right">-</div>	
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

