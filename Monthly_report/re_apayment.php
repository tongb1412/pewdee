<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

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

$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.pdate  from tb_apayment a,tb_patient  b,tb_payment c where (a.hn = b.hn) and (a.billno = c.billno) and (c.pdate between '$sdate%' and '$edate%')  ";


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
	ช่วงวันที่ <?=$sdate?>  ถึง  <?=$edate?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
		<?=$dname?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:20%;text-align:left; float:left; border-bottom:#999999 2px solid;">Crad No.</div>
      <div style="width:30%;text-align:left; float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนเงิน</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">เลขที่ใบเสร็จ</div>
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
		<?=$dname?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?=$m;?>&nbsp;
		</div>
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;;">ลำดับ</div>
      <div style="width:20%; text-align:left; float:left; border-bottom:#999999 2px solid;">Crad No.</div>
      <div style="width:30%; text-align:left; float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนเงิน</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">เลขที่ใบเสร็จ</div>
	</div>		
	
	
	

<?
 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">
	<div style="width:10%; text-align:center; float:left;"><?=$n?></div>
	<div style="width:20%; float:left;"><?=$rs['cradno']?></div>
	<div style="width:30%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:20%; text-align:right; float:left;"><?=number_format($rs['total'],'0','.',',')?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:20%; float:left; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['billno']?></div>
	
								
	
</div>	
	
	
<? $n++; } ?>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:5%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:47%; float:left;">&nbsp;</div>
	<div style="width:20%; float:left; text-align:right">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:6%; text-align:right; float:left;"><?=number_format($tt,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:20%; float:left; text-align:center"><?='-'?></div>
	
								
	
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

