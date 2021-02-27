<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="rep_cash_excel.xls"');# ????????
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

$sdat = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2)+1, substr($_GET['edate'],6,4)));
$edate  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2), substr($_GET['edate'],6,4)));
$endLine = 33;



//if(!empty($_GET['did'])){
////$did = $_GET['did'];
//} else {
//$did = '';
//}

$sqlC .="select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]");
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$txt1 = ' วันที่ '.$_GET['sdate'].'  ถึง  '.$_GET['edate'].' สาขา  '.$rs['clinicname'];



//$txt = 'ตั้งแต่วันที่ '.showdateTH($sdat).'  ถึงวันที่  '.showdateTH($edate);


//$sdat = date('Y-m-d',strtotime($sdat) -1);
//$edat = date('Y-m-d',strtotime($edat) -1);



//if(empty($did)){
//	$sql  = "select *  from drugelog   where (dat between '$sdat' and '$edat') order by did,dat  ";
//} else {
//	$sql  = "select *  from drugelog   where (dat between '$sdat' and '$edat') and (did = '$did') order by did,dat  ";
//}

$sql = "select a.*,b.fname efname,b.lname elname ,c.fname cfname,c.lname clname,d.fname ckfname ,d.lname cklname from tb_totalcash a,tb_staff b,tb_staff c,tb_staff d where a.empname = b.staffid and a.cashier = c.staffid and a.cashier_check = d.staffid and (a.date between '$sdat%' and '$edat%') ";

$str = mysql_query($sql) or die($sql);


?>
<BODY>
<TABLE  x:str BORDER="1">
<TR><TD colspan="8" align="center"><b>รายงานสรุปบันทึกยอดเงินสดประจำวัน</b></TD></TR>
<TR><TD colspan="8" align="center"><b><?=$txt1?></b></TD></TR>


<TR >


        <td align="center" style="background:#CCCCCC">ลำดับ</td>
        <td align="center" style="background:#CCCCCC">วันที่</td>
        <td align="center" style="background:#CCCCCC">ยอดยกมา</td>
        <td align="center" style="background:#CCCCCC" >ยอดขาย</td>
        <td align="center" style="background:#CCCCCC" >ค่าใช้จ่าย</td>
        <td align="center" style="background:#CCCCCC">แพทย์เบิก</td>
        <td align="center" style="background:#CCCCCC">ฝากธนาคาร</td>
        <td align="center" style="background:#CCCCCC">หมายเหตุ</td>
        <td align="center" style="background:#CCCCCC">คงเหลือ</td>

        <td align="center" style="background:#CCCCCC">ผู้บันทึก</td>
        <td align="center" style="background:#CCCCCC">แคชเขียร์ประจำวัน</td>
        <td align="center" style="background:#CCCCCC">พนักงานตรวจ</td>
        <td align="center" style="background:#CCCCCC">เวลาบันทึก</td>


</TR>



<?
$n = 1;  $total = 0;  $sd='';
while($rs = mysql_fetch_array($str)){
$t1 = ''; $t2 = ''; $t3 = ''; $t4 = ''; $t5 = ''; $t6 = ''; $t7 = ''; $t8 = '';
$t9 = ''; $t10 = ''; $t11 = ''; $t12 = ''; $t13 = ''; $t14 = ''; $t15 = '';
$dat = substr($rs['date'],8,2).'-'.substr($rs['date'],5,2).'-'. (substr($rs['date'],0,4)+543);


             $did = $rs['dname'];
        	//if($sd!=$dat){ $sd=$dat; $dd= $dat; } else { $dd='-';  }
		//	if ($di!=$did ) {$di=$did; $dname=$did;} else {$dname='-';}

		//	$t1 = $m;
			$t2 = $rs['date'];
			$t3 = $rs['cash_yes'];
			$t4 = $rs['today_total'];
			$t5 = $rs['coste'];
			$t6 = $rs['doctor_cos'];
			$t7 = $rs['bank'];
			$t8 = $rs['mem'];
			$t9 = $rs['total'];

			$t12 = $rs['efname'].'    '.$rs['elname'];
			$t13 = $rs['cfname'].'    '.$rs['clname'];
			$t14 = $rs['ckfname'].'    '.$rs['cklname'];
			$t15 = $rs['datenow'];





?>
<TR>
    <TD align="center" ><?=$n?></TD>
    <TD align = "right" ><?=$t2?></TD>
    <TD align = "right" ><?=number_format($t3,0,'.',','); ?></TD>
    <TD align = "right" ><?=number_format($t4,0,'.',','); ?></TD>
    <TD align = "right" ><?=number_format($t5,0,'.',','); ?></TD>
    <TD align = "right" ><?=number_format($t6,0,'.',','); ?></TD>
    <TD align = "right" ><?=number_format($t7,0,'.',','); ?></TD>
    <TD align="left" ><?=$t8?></TD>
    <TD align = "right" ><?=number_format($t9,0,'.',','); ?></TD>

    <TD align="left" ><?=$t12?></TD>
    <TD align="left" ><?=$t13?></TD>
    <TD align="left" ><?=$t14?></TD>
    <TD align="left" ><?=$t15?></TD>


</TR>

<? $n++; }?>




</TABLE>
</BODY>
</HTML>
