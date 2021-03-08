<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];

$t0 = strtotime($_GET['sdate']);
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
$where_branch_id = "";
if($_SESSION['branch_id'] !="") {
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
}
if(empty($did)){
$sql  = "select  empid,empname,tid,tname,sum(totalprice) totalprice,count(*) qty ";
$sql .= "from tb_pctrec  where   (dat between '$sdate%' and '$edate%') and (typ ='C')  ";
} else {
$sql  = "select  empid,empname,tid,tname,sum(totalprice) totalprice,count(*) qty ";
$sql .= "from tb_pctrec  where   (dat between '$sdate%' and '$edate%') and (typ ='C' ) and (empid like '%$did%') ";
}

$sql .=" $where_branch_id group by empid,empname,tid,tname order by empid ";

$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0;

$total = 0;
$total1 = 0;

while($rs=mysql_fetch_array($result)){  
$nn++;




 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานรวมการขายทรีทเมนท์/เลเซอร์
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
    
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:30%; float:left; border-bottom:#999999 2px solid;">รายการ</div>      
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
	  <div style="width:22%; float: left; border-bottom:#999999 2px solid;">จำนวนคนไข้</div> 
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
    
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:30%; float:left; border-bottom:#999999 2px solid;">รายการ</div>      
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนคนไข้</div> 
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
   
	<div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:30%; float:left; text-align:right">รวม</div>	
    <div style="width:20%; float:left; text-align:right">&nbsp;<?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:20%; float:left; text-align:right"><?=number_format($qty,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>		
</div>
<? 
 $h=1; $m=1; $n++; 
 $total = 0;
 
}
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; ">			
	&nbsp;<?=$dname?>
</div>
<? 
}


$total = $total + $rs['totalprice'];
$total1 = $total1+ $rs['totalprice'];
$qty = $m;




?>	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden;  ">
	<div style="width:10%; float:left;"><?=$m?></div>
	<div style="width:20%; float:left;"><?=$rs['tid']?></div>
	<div style="width:30%; float:left;"><?=$rs['tname']?></div>
    <div style="width:20%; float:left; text-align:right"><?=number_format($rs['totalprice'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:20%; float:left; text-align:right"><?=number_format($rs['qty'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	

</div>	
<? 
	
$n++; $h++; $m++;   } 
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<div style="width:10%; float:left;">&nbsp;</div>
    
	<div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:30%; float:left; text-align:right">รวม</div>	
    <div style="width:20%; float:left; text-align:right"><?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:20%; float:left; text-align:right"><?=number_format($qty,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">

	<div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:20%; float:left;">รวมทั้งหมด</div>
	<div style="width:30%; float:left; text-align:right"><?=$nn.'  รายการ';?></div>	
    <div style="width:20%; float:left; text-align:right">&nbsp;<?=number_format($total1,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:20%; float:left; text-align:right"><?=$nn.'  รายการ';?></div>		
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

