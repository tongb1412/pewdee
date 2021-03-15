<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="rep_stockcard_excel.xls"');# ???????? 
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<HTML>
<HEAD>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<?
include('../class/config.php');
include('../class/permission_user.php');

$sdat = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2)+1, substr($_GET['edate'],6,4)));
$edate  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2), substr($_GET['edate'],6,4)));
$endLine = 33;



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

if($branchid == "") {
	$where_branch_id2 = " where cn = '".$_SESSION["branch_id"] ."' and company_code ='".$_SESSION['company_code']."'  ";
}else {
	$where_branch_id2 = " where cn = '".$branchid ."' and company_code ='".$_SESSION['company_code']."' ";
}

$sqlC .="select clinicname from tb_clinicinformation $where_branch_id2";

$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];
if($cname =="") {
	$cname = "ทั้งหมด";
}
$txt1 = ' วันที่ '.$_GET['sdate'].'  ถึง  '.$_POST['edate'].' สาขา  '.$cname; 


//$txt = 'ตั้งแต่วันที่ '.showdateTH($sdat).'  ถึงวันที่  '.showdateTH($edate); 
//$sdat = date('Y-m-d',strtotime($sdat) -1);
//$edat = date('Y-m-d',strtotime($edat) -1);

if(empty($did)){
	$sql  = "select a.*,branchname  from drugelog a LEFT JOIN tb_branch b ON a.branchid = b.branchid where (dat between '$sdat' and '$edat') $where_branch_id order by did,dat "; 
} else {
	$sql  = "select a.*,branchname  from drugelog a LEFT JOIN tb_branch b ON a.branchid = b.branchid where (dat between '$sdat' and '$edat') and (did = '$did') $where_branch_id order by did,dat  "; 
}
// echo $sql;

$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 

$colspan = 8;
if ($branchid != "") {
	$colspan = 9;
}
?>
<BODY>
<TABLE  x:str BORDER="1">
<TR><TD colspan="<?=$colspan?>" align="center"><b>StockCard</b></TD></TR>
<TR><TD colspan="<?=$colspan?>" align="center"><b><?=$txt1?></b></TD></TR>


<TR >

    
        <td align="center" style="background:#CCCCCC">ลำดับ</td>
        <td align="center" style="background:#CCCCCC">ชื่อยา</td> 
        <td align="center" style="background:#CCCCCC">วันที่</td>        
        <td align="center" style="background:#CCCCCC" >ชื่อ</td>
        <td align="center" style="background:#CCCCCC" >Lotno / Vn</td>
        <td align="center" style="background:#CCCCCC">จำนวนรับ</td>
        <td align="center" style="background:#CCCCCC">จำนวนจ่าย</td> 
        <td align="center" style="background:#CCCCCC">คงเหลือ</td>     
		<?php 
        if ($branchid != "") {
		?>
        <td align="center" style="background:#CCCCCC">สาขา</td> 
		<?php
			} 
		?>
  
</TR>



<?
$n = 1;  $total = 0;  $sd='';
while($rs = mysql_fetch_array($str)){ 
$t1 = ''; $t2 = ''; 
$dat = substr($rs['dat'],8,2).'-'.substr($rs['dat'],5,2).'-'. (substr($rs['dat'],0,4)+543);


             $did = $rs['dname'];
        	//if($sd!=$dat){ $sd=$dat; $dd= $dat; } else { $dd='-';  } 
		//	if ($di!=$did ) {$di=$did; $dname=$did;} else {$dname='-';}
			
		//	$t1 = $m;
			$t2 = $did;
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

?>
<TR>
    <TD align="center" ><?=$n?></TD>
    <TD align="center" ><?=$t2?></TD>
    <TD align="center" ><?=$t3?></TD>
    <TD align="left" ><?=$t4?></TD>
    <TD align="left" ><?=$t5?></TD>
    <TD align="center" ><?=number_format($t6,0,'.',','); ?></TD>    
    <TD align="center" ><?=number_format($t7,0,'.',','); ?></TD>
    <TD align="left" ><?=number_format($t8,0,'.',','); ?></TD>
	<?php 
	if ($branchid != "") {
	?>
	<td align="center" ><?=$t9?></td>
	<?php
		} 
	?>
</TR>

<? $n++; }?>




</TABLE>
</BODY>
</HTML>