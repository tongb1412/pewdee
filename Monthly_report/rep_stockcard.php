<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');

if(!empty($_GET['did'])){
$did = $_GET['did'];
} else {
$did = '';
}


if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = '';
}
$as = "a";
// echo "x".$branchid."x";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];


$where_branch_id2 = "";
if($branchid == "") {
	$where_branch_id2 = " where cn = '".$_SESSION["branch_id"] ."' and company_code ='".$_SESSION['company_code']."'  ";
}else {
	$where_branch_id2 = " where cn = '".$branchid ."' and company_code ='".$_SESSION['company_code']."' ";
}
$sqlC .="select clinicname from tb_clinicinformation $where_branch_id2";
// echo $sqlC;
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$cname = $rs['clinicname'];
if($cname =="") {
	$cname = "ทั้งหมด";
}

$sdat = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2)+1, substr($_GET['edate'],6,4)));
$edate  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2), substr($_GET['edate'],6,4)));
$endLine = 33;

$txt1 = 'ตั้งแต่วันที่ '.showdateTH($sdat).'  ถึงวันที่  '.showdateTH($edate); 


if(empty($did)){
	$sql  = "select a.*,branchname  from drugelog a LEFT JOIN tb_branch b ON a.branchid = b.branchid where (dat between '$sdat' and '$edat') $where_branch_id order by did,dat "; 
} else {
	$sql  = "select a.*,branchname  from drugelog a LEFT JOIN tb_branch b ON a.branchid = b.branchid where (dat between '$sdat' and '$edat') and (did = '$did') $where_branch_id order by did,dat  "; 
}

// echo $sql;

$str  = mysql_query($sql);
$num = mysql_num_rows($str);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock Card</title>
</head>
<style type="text/css">
body {
	font: 12px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	background:#FFFFFF;
	padding: 0;
	margin: 0;
	text-align:center;
}
.txt1 { font-size:14px; font-weight:bold; height:25px; line-height:25px; }
.lineH { border-bottom:#999999 1px solid; font-size:12px; font-weight:bold; line-height:20px; height:20px; overflow:hidden; }
.line { border-bottom:#999999 1px dotted; line-height:20px; height:20px; }
.lineT { border-bottom:#999999 1px dotted; line-height:20px; height:20px; font-weight:bold; }
.lineName { line-height:20px; height:20px; font-weight:bold; }
</style>
<body>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td align="center" class="txt1">Stock Card</td></tr>
	<tr><td align="center" class="txt1"><?=$txt1;?></td></tr>
    <tr><td align="left" class="txt1"><?=$cname;?></td></tr>
    <tr>
    <td align="center">
    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" >
		<? 			
		$showLine = 1;
		showHeader($branchid); 		
        $n=0; $sd = ''; $m=1; 	$di = '';
        while($rs  = mysql_fetch_array($str)){
		    $showLine++;
			if($showLine > $endLine ){ showHeader($branchid); $showLine = 1; }			
        	$dat = substr($rs['dat'],8,2).'-'.substr($rs['dat'],5,2).'-'.substr($rs['dat'],0,4);
			$did = $rs['dname'];
        	//if($sd!=$dat){ $sd=$dat; $dd= $dat; } else { $dd='-';  } 
			if ($di!=$did ) {$di=$did; $dname=$did;} else {$dname='-';}
			
			$t1 = $m;
			$t2 = $dname;
			$t3 = $dat;
			$t4 = $rs['pname'];
			if ($rs['vn'] != '-') { $t5 = $rs['vn']; } else {$t5 = $rs['lno'];}
			if ($rs['typ'] == 'I') { 
				$t6 = $rs['qty']; 
				$t7 = 0;
			} else {
				$t6 = '0';
			    $t7 = $rs['qty']; 
			}
			//if ($rs['typ'] == 'P') { $t7 = '0'; } else {$t7 = $rs['qty'];}
			
			$t8 = $rs['total'];
			$t9 = $rs['branchname'];
				
		
			showDetail($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$branchid);       
         $n++; $m++;
		 } 
	
		
		 ?>
    </table> 
    </td>
    </tr>       
</table>
<?
function showdateTH($txt){   
    $dat = explode('-',$txt);
    $d = $dat[2];
	$m = $dat[1];
	$y = $dat[0] + 543;
	$tt = '0';
	//$thmonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษาคม","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$thmonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	for($i=0;$i<12;$i++){
	    $x = explode($thmonth[$i],$txt);
		if( count($x) == 2){ $tt='563'; }
		
	}
	
	$m=$m-1;
	 
	if($tt=='563'){
    	return $txt;
	} else {
		return $d." ".$thmonth[$m]." ".$y;
	}


}
function showHeader($branchid){
?>
    	<tr valign="top" >
        <td align="center" class="lineH" width="40">ลำดับ</td>
        <td align="center" class="lineH" width="80">ชื่อยา</td> 
        <td align="center" class="lineH" width="80" >วันที่</td>        
        <td align="center" class="lineH" width="200" >ชื่อ</td>
        <td align="center" class="lineH" >Lotno / Vn</td>
        <td align="center" class="lineH" width="80">จำนวนรับ</td>
        <td align="center" class="lineH" width="80">จำนวนจ่าย</td> 
        <td align="center" class="lineH" width="80">คงเหลือ</td> 
		<?php 
        if ($branchid != "") {
		?>
        <td align="center" class="lineH" width="200">สาขา</td> 
		<?php
			} 
		?>
    	</tr> 
<?
}
function showDetail($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$branchid){
?>
        <tr valign="top">
        <td align="center" class="line" ><?=$t1?></td>
        <td align="center" class="line" ><?=$t2?></td>      
        <td align="left" class="line" ><?=$t3?></td>
        <td align="left" class="line"><?=$t4?>&nbsp;&nbsp;</td>
        <td align="center" class="line"  ><?=$t5?></td>
        <td align="right" class="line"><?=number_format($t6,0,'.',','); ?>&nbsp;&nbsp;</td>
        <td align="right" class="line"><?=number_format($t7,0,'.',','); ?>&nbsp;&nbsp;</td>
        <td align="right" class="line"><?=number_format($t8,0,'.',','); ?>&nbsp;&nbsp;</td>
        
		<?php 
        if ($branchid != "") {
		?>
        <td align="center" class="line"  ><?=$t9?></td>
		<?php
			} 
		?>

    	</tr>  
<?
}

?>
</body>
</html>


