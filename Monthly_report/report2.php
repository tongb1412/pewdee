<?php
	include('../class/config.php');
	ini_set('max_execution_time', 36000);
	header("content-type: application/vnd.ms-excel");
	header('content-disposition: attachment; filename="report2.xls"');
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/tr/rec-html40">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<style>
		  td {
			font-size: 13px;
		  }
		</style>
	</head>

<?php
	$sqlc ="SELECT clinicname FROM tb_clinicinformation";
	$rs = mysql_fetch_array(mysql_query($sqlc));
	$cname = $cname1 = $rs['clinicname'];
	$sempid = $_POST['sempid'];
	$sdat = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2);
	$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_POST['edate'],3,2)  , substr($_POST['edate'],0,2)+1, substr($_POST['edate'],6,4)));
	$txt1 = ' วันที่ '.$_POST['sdate'].'  ถึง  '.$_POST['edate'].' '.$rs['clinicname'];
	
	$n = 0;
	$static_cols = 6;
	$percent_drg_total = 1;	// % ค่ายา
	$percent_med_proc_total = 1;	// % ค่าทำหัตถการ

	$sql = "SELECT * FROM tb_treatment ORDER BY tgroup, tname DESC";
	$str = mysql_query($sql);
	while($rs = mysql_fetch_array($str))
	{
		$gname[$n] = $rs['tname'];
		$gid[$n] = $rs['tid'];
		$gratio[$n] = 0;
		$num_cols += 3;
		$n++;
	}
?>

<body>
	<table border="1">
		<tr>
			<td colspan="<?php print $num_cols + $static_cols; ?>" align="center"><b>รายงานการใช้ทรีทเม้นท์</b></td>
		</tr>
		<tr>
			<td colspan="<?php print $num_cols + $static_cols; ?>" align="center"><b><?php print $txt1; ?></b></td>
		</tr>
		<tr valign="bottom">
			<td align="center" valign="top" rowspan="2"><b>สาขา</b></td>
			<td align="center" valign="top" rowspan="2"><b>ชื่อแพทย์</b></td>
			<td align="center" valign="top" rowspan="2"><b>วันที่</b></td>
			<? for($i=0; $i<count($gname); $i++){ ?> 
				<td align="center" valign="top" colspan="3"><b><?php print $gname[$i]; ?></b></td> 
			<? } ?>			
			<td align="center" valign="top" rowspan="2"><b>ค่ายา</b></td>
			<td align="center" valign="top" rowspan="2"><b>ค่า<br />หัตถการ</b></td>
			<td align="center" valign="top" rowspan="2"><b>รวม<br />รายได้</b></td>
		</tr>
		<tr>
			<?php
				for($i=0; $i<count($gname); $i++) 
				{ 
				print "<td align=\"center\"><b>#ครั้ง</b></td>";
				print "<td align=\"center\"><b>ใช้คอร์ส</b></td>";
				print "<td align=\"center\"><b>เป็นครั้ง</b></td>";
				}
			?>
		</tr>

		<?php

			$sql = "SELECT DATE(vdate) vdate, a.empid, a.empname,
			SUM(lp) med_proc_total,
			SUM(dp) drg_total,
			(SUM(ku) + SUM(discount)) discount, 
			SUM(c.total) grand_total
			FROM tb_vst a LEFT JOIN tb_staff b ON (a.empid = b.staffid) LEFT JOIN tb_payment c ON (a.vn = c.vn)	
			WHERE a.status = 'COM' AND (a.vdate between '$sdat%' and '$edat%') " . ($sempid!=""?" AND a.empid = '$sempid'":"") . "
			GROUP BY a.empname, a.empid, DATE(vdate) ORDER BY a.empname, a.empid, DATE(vdate)"; 

			//print $sql;
			$str  = mysql_query($sql);
			while($rs = mysql_fetch_array($str))
			{		
				$doc_name = $rs['empname'];
				$doc_id = $rs['empid'];
				$vdate = $rs['vdate'];	
				$drg_total = round($rs['drg_total'] * $percent_drg_total, 2);
				$med_proc_total = round($rs['med_proc_total'] * $percent_med_proc_total, 2);	
				$gran_total = $drg_total + $med_proc_total;
		?>
			<tr valign="top" >
				<td align="left"><?php print $cname1; ?></td> 
				<td align="left"><?php print $doc_name; ?></td> 	
				<td align="center"><?php print date_format(date_create($vdate), "d/m/Y"); ?></td>
		<?php
			for($i=0; $i<count($gname); $i++)
			{
				$tgid = $gid[$i] ;  
				$no_of_times = $course_amount = $times_amount = 0; 
				
				//ทรีทเม้น, เลเซอร์ ทำเป็นครั้ง
				$sl = "SELECT SUM(a.totalprice) tprice, COUNT(a.tid) tqty FROM tb_pctrec a LEFT JOIN tb_treatment b ON (a.tid=b.tid) LEFT JOIN tb_vst c ON (a.vn = c.vn) WHERE a.typ IN ('L','T') AND (c.status='COM') AND b.tid ='$tgid' AND c.empid = '$doc_id' AND DATE(c.vdate) = '$vdate' GROUP BY b.tid";
				//print $sl;
				$rc = mysql_fetch_array(mysql_query($sl));
				$times_amount = round($rc['tprice'], 2); 
				$no_of_times = $rc['tqty'] ; 
				
				//ทรีทเม้น, เลเซอร์ ใช้คอร์ส 	
				$sl  = "SELECT SUM(a.qty) tqty, SUM(((b.totalprice / b.qty) * a.qty)) price FROM tb_pctuse a LEFT JOIN tb_pctrec b ON (a.vn = b.vn AND a.cid=b.tid) LEFT JOIN tb_treatment c ON (a.tid=c.tid) LEFT JOIN tb_vst d ON (a.uvn = d.vn) WHERE a.ftyp='C' AND c.tid ='$tgid' AND d.empid = '$doc_id' AND DATE(d.vdate) = '$vdate' AND (d.status='COM') GROUP BY c.tid";				
				$rc = mysql_fetch_array(mysql_query($sl));
				$course_amount = round($rc['price'], 2);
				$no_of_times += $rc['tqty'];
				$gran_total += $course_amount + $times_amount;
				
				print "<TD align=\"right\">" . number_format($no_of_times, 0) . "</TD>";
				print "<TD align=\"right\">" . number_format($course_amount, 2) . "</TD>";
				print "<TD align=\"right\">" . number_format($times_amount, 2) . "</TD>";	
				
			}				
			print "<td align=\"right\">" . number_format($drg_total, 2) . "</TD>";
			print "<td align=\"right\">" . number_format($med_proc_total, 2) . "</TD>";
			//print "<td align=\"right\">" . number_format($discount, 2) . "</TD>";	
			print "<td align=\"right\">" . number_format($gran_total, 2) . "</TD>";
			print "</tr>";
		}
		?>
	</table>
</body>
</html>