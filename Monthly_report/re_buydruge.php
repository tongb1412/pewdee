<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];


$dname ='';
$sql = "select tname from tb_druge where   did='$did'   ";
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


if(empty($did)){
$sql  = "select * from tb_druge where status='IN'  and (sqty > total) ";
} else {
$sql  = "select * from tb_druge where status='IN' and (did like '%$did%') and  (sqty > total) ";

}

$sql .=" order by did asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 79;

 $tt=0; 
while($rs=mysql_fetch_array($result)){  





 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานยาถึงจุดสั่งซื้อ
	</div>
<!--	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ช่วงวันที่ <?=$sdate?>  ถึง  <?=$edate?>
	</div>-->
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
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;กลุ่มยา</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;คงเหลือ</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">จุดสั่งซื้อ</div>
	 
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
		<?=$dname?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?=$m;?>&nbsp;
		</div>
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;กลุ่มยา</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;คงเหลือ</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">หน่วย</div>
	</div>		
	
	
	

<?
 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align: center; float:left; margin:auto; overflow:hidden; border-bottom:#999999 1px dotted; ">
	<div style="width:10%; float:left;"><?=$n?></div>
	<div style="width:8%; float:left;"><?=$rs['did']?></div>
	<div style="width:25%; text-align:left; float:left;"><?=$rs['tname']?></div>
	<div style="width:20%; float:left;"><?=$rs['dgroup']?></div>
	<div style="width:25%; float:left;"><? echo number_format($rs['total'],'0','.',',') ?></div>
	<div style="width:12%; float:left;">&nbsp;<?=$rs['sqty']?></div>
	
								
	
</div>	
	
	
<? $n++; } ?>	


