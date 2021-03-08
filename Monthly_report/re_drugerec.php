<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];
$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 


$dname ='';
$sql = "select tname from tb_druge where   did='$did'";
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
$where_branch_id = "";
if($_SESSION['branch_id'] !="") {
	$where_branch_id = " and a.branchid ='".$_SESSION['branch_id']."'  ";
}
if(empty($did)){
$sql  = "select a.*,b.vdate,c.fname,c.lname,c.cradno from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status = 'COM'  and a.hn=c.hn  and (b.vdate between '$sdate%' and '$edate%')";
} else {
$sql  = "select a.*,b.vdate,c.fname,c.lname,c.cradno from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status = 'COM'  and a.hn=c.hn and (b.vdate between '$sdate%' and '$edate%') and (a.did like '%$did%') ";

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
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">Crad No.</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">คนไข้&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">ยา&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>
	 
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
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">Crad No.</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">คนไข้&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">ยา&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวน</div>
	</div>		
	
	
	

<?
 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align: left; float:left; margin:auto; overflow:hidden; ">
	<div style="width:10%; float:left;text-align: center;"><?=$n?></div>
	<div style="width:8%; float:left;">&nbsp;<?=$rs['cradno']?></div>
	<div style="width:25%; text-align:left; float:left;">&nbsp;<?=$rs['vdate']?></div>
	<div style="width:20%; float:left;">&nbsp;<?=$rs['fname'].'    '.$rs['lname']?></div>
	<div style="width:25%; float:left;">&nbsp;<?=$rs['dname']?></div>
	<div style="width:12%; float:left;text-align: center;">&nbsp;<? echo number_format($rs['qty'],'0','.',',') ?></div>
	
								
	
</div>	
	
	
<? $n++; } ?>	


