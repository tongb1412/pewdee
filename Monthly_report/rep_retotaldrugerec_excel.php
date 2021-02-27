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

//$sdat = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2);
$sdat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['sdate'],3,2)  , substr($_GET['sdate'],0,2), substr($_GET['sdate'],6,4)));
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2)+1, substr($_GET['edate'],6,4)));
$edate  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2), substr($_GET['edate'],6,4)));
$endLine = 33;

echo $sdat;

if(!empty($_GET['did'])){
$did = $_GET['did'];
} else {
$did = '';
}

$sqlC .="select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$txt1 = ' วันที่ '.$_GET['sdate'].'  ถึง  '.$_GET['edate'].' สาขา  '.$rs['clinicname']; 



//$txt = 'ตั้งแต่วันที่ '.showdateTH($sdat).'  ถึงวันที่  '.showdateTH($edate); 


//$sdat = date('Y-m-d',strtotime($sdat) -1);
//$edat = date('Y-m-d',strtotime($edat) -1);



if(empty($did)){
	$sql  = "select a.did,a.dname,sum(a.qty) qty,count(*) count from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status <> 'CANCLE'  and a.hn=c.hn  and (b.vdate between '$sdat%' and '$edat%') group by a.did,a.dname  "; 
} else {
	$sql  = "elect a.did,a.dname,sum(a.qty) qty,count(*) count from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status <> 'CANCLE'  and a.hn=c.hn and (b.vdate between '$sdat%' and '$edat%') and (a.did like '%$did%')group by a.did,a.dname   "; 
}



$str = mysql_query($sql) or die($sql);


?>
<BODY>
<TABLE  x:str BORDER="1">
<TR><TD colspan="8" align="center"><b>รายงานการจ่ายยารวม</b></TD></TR>
<TR><TD colspan="8" align="center"><b><?=$txt1?></b></TD></TR>


<TR >

    
        <td align="center" style="background:#CCCCCC">ลำดับ</td>
        <td align="center" style="background:#CCCCCC">ชื่อยา</td> 
        <td align="center" style="background:#CCCCCC">จำนวนยา</td>        
        <td align="center" style="background:#CCCCCC" >จำนวนคน</td>

  
</TR>



<?
$n = 1;  $total = 0;  $sd='';
while($rs = mysql_fetch_array($str)){ 
$t1 = ''; $t2 = ''; 
$dat = substr($rs['dat'],8,2).'-'.substr($rs['dat'],5,2).'-'. (substr($rs['dat'],0,4)+543);


             $did = $rs['dname'];
        	//if($sd!=$dat){ $sd=$dat; $dd= $dat; } else { $dd='-';  } 
			if ($di!=$did ) {$di=$did; $dname=$did;} else {$dname='-';}
			
		//	$t1 = $m;
			$t2 = $dname;
			$t7 = $rs['qty'];
			$t8 = $rs['count'];
			
		
			 


?>
<TR>
    <TD align="center" ><?=$n?></TD>
    <TD align="center" ><?=$t2?></TD>
    <TD align="center" ><?=number_format($t7,0,'.',','); ?>&nbsp;&nbsp;</TD>
    <TD align="left" ><?=number_format($t8,0,'.',','); ?>&nbsp;&nbsp;</TD>
 
</TR>

<? $n++; }?>




</TABLE>
</BODY>
</HTML>