<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Report1_new.xls"');# ????????
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
$charset = "SET NAMES 'utf8'";
ini_set('max_execution_time',36000);

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
$branchname = get_branch_name($branchid,$_SESSION['company_code']);

// $where_branch_id2 = "";
// if($branchid == "") {
// 	$where_branch_id2 = " where cn = '".$_SESSION["branch_id"] ."' and company_code ='".$_SESSION['company_code']."'  ";
// } else {
// 	$where_branch_id2 = " where cn = '".$branchid ."' and company_code ='".$_SESSION['company_code']."' ";
// }
// $sqlC ="select clinicname from tb_clinicinformation $where_branch_id2";
// // echo $sqlC;
// $strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
// $rs=mysql_fetch_array($strc);

// $cname = $rs['clinicname'];

// $cname = $rs['clinicname'];
// if($cname =="") {
// 	$cname = "ทั้งหมด";
// }
// $cname1 = $cname;

$sdat = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_POST['edate'],3,2)  , substr($_POST['edate'],0,2)+1, substr($_POST['edate'],6,4)));
$txt1 = ' วันที่ '.$_POST['sdate'].'  ถึง  '.$_POST['edate'].' '.$rs['clinicname'];

$sql = "select * from tgroup where typ= 'GTR' order by no ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
$n=0;
while($rs = mysql_fetch_array($str)){
		$gname[$n] = $rs['name'];
		$gid[$n] = $rs['id'];
		$n++;
}
$gnum = $n ;
$sn = ($gnum*3) + 9 + 24;

$sql = "select * from tgroup where typ= 'GTC' order by no ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
$n=0;
while($rs = mysql_fetch_array($str)){
    $cname[$n] = $rs['name'];
	$cid[$n] = $rs['id'];
	$n++;
}
$cnum = $n ;
$sn = $sn + ($cnum * 2);


?>
<BODY>
<TABLE  x:str BORDER="1">
	<TR x:str BORDER="0">
	    <!-- <TD colspan="<?=$sn?>" align="center"><b>รายงานบัญชีแพทย์</b></TD> -->
		<TD colspan="<?= $sn ?>" align="center"><b>รายงานบัญชีแพทย์ <?php if ($branchname != "") {
																			echo " (สาขา $branchname)";
																		} ?></b></TD>
	</TR>
	<TR x:str BORDER="0">
	    <TD colspan="<?=$sn?>" align="center"><b><?=$txt1?> </b></TD>
	</TR>
	<TR valign="bottom">
		<TD align="center" rowspan="2"><b>สาขา</b></TD>
	    <TD align="center" rowspan="2"><b>ลำดับ</b></TD>
	    <TD align="center" rowspan="2"><b>ชื่อแพทย์</b></TD>
	    <TD align="center" rowspan="2"><b>วันที่</b></TD>
	    <TD align="center" rowspan="2"><b>Billno</b></TD>
	    <TD align="center" rowspan="2"><b>รวมยอด</b></TD>
	    <TD align="center" rowspan="2"><b>ค่าตรวจ</b></TD>
	    <TD align="center" rowspan="2"><b>ส่วนลด</b></TD>
	    <TD align="center" rowspan="2"><b>KA</b></TD>
	    <? for($i=0; $i<$gnum; $i++){ ?>  <TD align="center" colspan="3" align="center"><b><?=$gname[$i]?></b></TD> <? } ?>
	    <? for($i=0; $i<$cnum; $i++){ ?>  <TD align="center" colspan="2" align="center" bgcolor="#FFCC00"><b><?=$cname[$i]?></b></TD> <? } ?>
		<TD align="center" rowspan="2" align="center"><b>รวมยอดรายวัน</b></TD>
		<TD align="center" rowspan="2" align="center"><b>ใช้ Course</b></TD>
		<TD align="center" rowspan="2" align="center"><b>รวมรายได้+COURSE</b></TD>
		<TD align="center" rowspan="2" align="center"><b>รวมค่าแพทย์</b></TD>
		<TD align="center" rowspan="2" align="center"><b>ค่าตรวจ</b></TD>
		<TD align="center" rowspan="2" align="center"><b>KA 50%</b></TD>

		<TD align="center" align="center"><b>CO2 (แพทย์เก่า50% ใหม่30%)</b></TD>
		<? // 0. ?>
	   <TD align="center" colspan="3" align="center"><b>30%-Made, Meso Fat, M Solution</b></TD>
        <? // 1. ?>
	    <TD align="center" colspan="3" align="center"><b>25%-เครื่องEmax LME HairRemoval</b></TD>
		<? // 2. ?>
		<TD align="center" colspan="3" align="center"><b>25%-MDL Cutera Helios CuBr Vbeam&อื่นๆ</b></TD>
		<? // 3. ?>
		<TD align="center"  align="center"><b>20% Botox Filler</b></TD>
		<? // 4. ?>
		<TD align="center" colspan="2" align="center"><b>20% Fraxel Golden S EMatrix </b></TD>
		<? // 5. ?>
		<TD align="center"  align="center"><b>20% Ulthera Thermage HIFUครั้ง</b></TD>
		<? // 6. ?>
		<TD align="center"  align="center"><b>10% Treatment Face</b></TD>
		<? // 7. ?>
		<TD align="center"  align="center"><b>10% Treatment Body</b></TD>
		<? // 10. ?>
		<TD align="center" colspan="2"  align="center"><b>10% Pico(15%)</b></TD>
		<? // 11. ?>
		<TD align="center"  align="center"><b>15% aura bright</b></TD>

		<? // 8. ?>
		<TD align="center"  align="center"><b>Course Treatment &HIFU 5%</b></TD>
		<? // 9. ?>
		<TD align="center"  colspan="2" align="center"><b>Course Laser  2%</b></TD>


	</TR>
	<TR>
	 	<? for($i=0; $i<$gnum; $i++){ ?>
	    <TD align="center" align="center"><b>ครั้ง</b></TD>
	    <TD align="center" align="center"><b>ใช้คอร์ส</b></TD>
	    <TD align="center" align="center"><b>ทำ</b></TD>
		<? } ?>
		<? for($i=0; $i<$cnum; $i++){ ?>
	    <TD align="center" align="center" bgcolor="#FFCC00"><b>ครั้ง</b></TD>
	    <TD align="center" align="center" bgcolor="#FFCC00"><b>ราคา</b></TD>
	    <? } ?>

		<TD align="center" align="center"><b>50%</b></TD>
		<? // 0.    ?>
			<TD align="center" align="center"><b>รวม...ครั้ง</b></TD>
			<TD align="center" align="center"><b>ใช้คอร์ส</b></TD>
			<TD align="center" align="center"><b>ทำเป็นครั้ง</b></TD>
		<? // 1.    ?>
	    <TD align="center" align="center"><b>รวม...ครั้ง</b></TD>
	    <TD align="center" align="center"><b>ใช้คอร์ส</b></TD>
	    <TD align="center" align="center"><b>ทำเป็นครั้ง</b></TD>
	    <? // 2.    ?>
	    <TD align="center" align="center"><b>รวม...ครั้ง</b></TD>
	    <TD align="center" align="center"><b>ใช้คอร์ส</b></TD>
	    <TD align="center" align="center"><b>ทำเป็นครั้ง</b></TD>
		<? // 3. ?>
		<TD align="center" align="center"><b>StemCell</b></TD>
	    <? // 4.    ?>
	    <TD align="center" align="center"><b>ใช้คอร์ส</b></TD>
	    <TD align="center" align="center"><b>ทำเป็นครั้ง</b></TD>
	    <? // 5. ?>
		<TD align="center" align="center"><b>รวม</b></TD>
		<? // 6. ?>
		<TD align="center" align="center"><b>เป็นครั้ง</b></TD>

		<? // 7. ?>
		<TD align="center" align="center"><b>เป็นครั้ง</b></TD>
		<? // 10. ?>
		<TD align="center" align="center"><b>ใช้คอร์ส</b></TD>
		<TD align="center" align="center"><b>ทำเป็นครั้ง</b></TD>
		<? // 11. ?>
		<TD align="center" align="center"><b>เป็นครั้ง</b></TD>

		<? // 8. ?>
		<TD align="center" align="center"><b>รวม</b></TD>
		<? // 9.    ?>
	    <TD align="center" align="center"><b>#คอร์ส</b></TD>
	    <TD align="center" align="center"><b>รวม</b></TD>

	</TR>
<?
$sql = "select distinct a.empid,a.empname, b.typ,b.mode , c.cn, c.clinicname
		from tb_vst a,tb_staff b, tb_clinicinformation c
		where (a.empid=b.staffid) and (a.status='COM') and (b.typ='D') and (a.vdate between '$sdat%' and '$edat%') and a.branchid = c.cn
		" . $where_branch_id . "  
		order by a.vn asc ";
// echo $sql;exit();
$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
$number = mysql_num_rows($str);
$n=0;
while($rs = mysql_fetch_array($str)){
    $con ='Y';
	for($i = 0;$i < $n; $i++){
		if($rs['empid'] == $did[$i]){ $con='N';  }
	}
	if($con == 'Y'){
		$dname[$n] = $rs['empname'];
		$did[$n] = $rs['empid'];
		$dmode[$n] = $rs['mode'];
		$branch_name[$n] = $rs['clinicname'];
		$n++;
	}
}
$j = 0;
for($i = 0;$i < $n; $i++){
    $empid = $did[$i]; 
	$dcmode = $dmode[$i];
	$sql = "select distinct vn,vdate,hn from tb_vst where (empid='$empid') and (status='COM') and (vdate between '$sdat%' and '$edat%')";
	$str = mysql_query($sql)or die ("Error Query [".$sql."]");
	$rd = mysql_num_rows($str);
    $dtotal = 0;
	$dp = 0; $lp = 0; $total = 0; $dis = 0;  $t1 = 0; $t2 = 0; $t3 = 0; $tka =0;
	while($rs = mysql_fetch_array($str)){
	    $j++;
		$vn = $rs['vn'];
		$dat = substr($rs['vdate'],0,10);

		// add KA test

	    $ska = "select sum(price) price from tb_labrec where vn='$vn' and lid not in ('7176')";
		$tka  = mysql_query($ska)or die ("Error Query [".$ska."]");
		$num = mysql_num_rows($tka);

	   if(!empty($num)){
	   		$row=mysql_fetch_array($tka);
	     	$tka =  $row['price'];
		} else {
			$tka =0;
		}

		$k1 = number_format($tka,'1','.','');
		$w = explode('.',$k1);
		$k1 = $w[0]; //  KA

		$s1 = "select billno,dp,lp,ku,discount,total from tb_payment where vn='$vn'  ";
		$tr  = mysql_query($s1)or die ("Error Query [".$s1."]");
		$row = mysql_fetch_array($tr);

		$total = $row['total'];
		$dp = $row['dp'] + $row['lp'] - $tka;
		$dis = $row['ku'] + $row['discount'];

		$d1 = number_format($dp,'1','.','');
		$y = explode('.',$d1);
		$d1 = $y[0]; // ค่าตรวจ

		$t1 = number_format($total,'1','.','');
		$x = explode('.',$t1);
		$t1 = $x[0]; // รวมยอด
		$tt = $t1;

		$c1 = number_format($dis,'1','.','');
		$a = explode('.',$c1);
		$c1 = $a[0]; // ส่วนลด
		?>
        <TR valign="top" >
		<TD align="center" align="left" ><?=$branch_name[$i]?></TD>
        <TD align="center" align="center" ><?=$j?></TD>
        <TD align="center" align="left" ><?=$dname[$i]?></TD>
        <TD align="center" align="center" ><?=$dat?></TD>
        <TD align="center" align="center" ><?= $row['billno']?></TD>
        <TD align="center" align="center" ><?=$t1?></TD>
        <TD align="center" align="center" ><?=$d1?></TD>
        <TD align="center" align="center" ><?=$c1?></TD>
        <TD align="center" align="center" ><?=$k1?></TD>
		<?
		$sum_total = ($d1 * 0.15);
		$s0_1 = 0; $s0_2 = 0; $s0_3 = 0; $s0 = 0;
		$s1_1 = 0; $s1_2 = 0; $s1_3 = 0; $s1 = 0;
		$s2_1 = 0; $s2_2 = 0; $s2_3 = 0; $s2 = 0; $s3 = 0;
		$s4_2 = 0; $s4_3 = 0; $s4 = 0;
		$s5 = 0; $s6 = 0; $s7 = 0; $s8 = 0;
		$s9_1 = 0; $s9_2 = 0; $s9 = 0;
		$s10_1 = 0; $s10_2 = 0; $s10_3 = 0; $s10 = 0;
		$tu = 0; $ka =0; $s11 = 0;

		for($l = 0;$l < $gnum; $l++){
			$tgid = $gid[$l] ;  $t1 = 0; $t2 = 0; $t3 = 0;

			//ขายทรีทเม้น / เลเซอร์
			$sl = "select sum(a.totalprice) as tprice,count(a.tid) as tqty from tb_pctrec a,tb_treatment b,tb_vst c where a.vn = c.vn and a.tid=b.tid and a.typ in ('L','T') and (c.status='COM')  ";
			$sl .= "and b.tgroup ='$tgid' and a.vn='$vn' group by b.tgroup  ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$row = mysql_fetch_array($tr);
			$num = mysql_num_rows($tr);
			if(!empty($num)){ $t3 = $t3 + $row['tprice']; $t1 = $t1 + $row['tqty'] ;  }

			//ใช้ course
			$sl  = "select sum(a.qty) as tqty, sum((b.totalprice / b.qty) * a.qty) as price from tb_pctuse a,tb_pctrec b,tb_treatment c,tb_vst d ";
			$sl .= "where a.uvn = d.vn and a.vn = b.vn and a.cid=b.tid and a.ftyp='C' and a.tid=c.tid and c.tgroup ='$tgid' and a.uvn='$vn' and (d.status='COM') group by  c.tgroup ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$num = mysql_num_rows($tr);
			if(!empty($num)){
			   $row = mysql_fetch_array($tr);
			   $t2 = $t2 + $row['price'];
			   $t1 = $t1 + $row['tqty'];
			   $tu = $tu + $row['price'];
			} else { $t2 = ''; }
			if(empty($t1)){ $t1 =''; }
			if(empty($t3)){ $t3 =''; }

//  KA
	          $ka = $k1 * 0.5 ;

            // CO2


            if($tgid == '1000000'){
	            $co2 = 0;
	            if($dcmode=='N'){
	            	$x = 0.3;
	            } else {
	            	$x = 0.5;
	            }
            	if($t3 !='' ){ $co2 = $co2 + $t3; }
            	$co2 = $co2 * $x;
            	//$sum_total = $sum_total + $co2;
            }

			?>
            <TD align="center" align="center" ><?=$t1;?></TD>
            <TD align="center" align="right" ><?=$t2;?></TD>
            <TD align="center" align="right" ><?=$t3;?></TD>
            <?

            //0. 30%-Made, Meso Fat, M Solution
            if($tgid == '1000015'){
            	if($t1!=''){ $s0_1 = $s0_1 + $t1;  }
            	if($t2!=''){ $s0_2 = $s0_2 + ($t2 * 0.3);  }
            	if($t3!=''){ $s0_3 = $s0_3 + ($t3 * 0.3);  }

            	$s0 = $s0_2 +  $s0_3;
            	//$sum_total =  $sum_total + (floatval($s0_2) + floatval($s0_3)) ;
            }

            //1. 25%-เครื่องEmax LME HairRemoval
            if($tgid == '1000001' || $tgid == '1000002' || $tgid == '1000005'){
            	if($t1!=''){ $s1_1 = $s1_1 + $t1;  }
            	if($t2!=''){ $s1_2 = $s1_2 + ($t2 * 0.25);  }
            	if($t3!=''){ $s1_3 = $s1_3 + ($t3 * 0.25);  }
            	$s1 = $s1_2 + $s1_3;
            	//$sum_total =  $xxx ; //$sum_total+ $xxx ;
            }


            //2. 25%-MDL Cutera Helios CuBr Vbeam&อื่นๆ
            if($tgid == '1000003' || $tgid == '1000004'){
            	if($t1!=''){ $s2_1 = $s2_1 + $t1; }
            	if($t2!=''){ $s2_2 = $s2_2 + ($t2 * 0.25); }
            	if($t3!=''){ $s2_3 = $s2_3 + ($t3 * 0.25); }
            	$s2 = $s2_2 + $s2_3;
            	//$sum_total = $sum_total + $xxx;
            }

            //3. 20% Botox Filler (StemCell)
            if($tgid == '1000006'){
            	if($t2!=''){ $s3 = $s3 + $t2; }
            	if($t3!=''){ $s3 = $s3 + $t3; }
            	$s3 = $s3 * 0.2;
            	//$sum_total = $sum_total + $s3;
            }

            //4. 20% Fraxel Golden S EMatrix
            if($tgid == '1000007'){
            	if($t2!=''){ $s4_2 = $s4_2 + ($t2 * 0.20); }
            	if($t3!=''){ $s4_3 = $s4_3 + ($t3 * 0.20); }
            	$s4 = $s4_2 +  $s4_3;
            	//$sum_total = $sum_total +($s4_2 + $s4_3);
            }

            //5.  20% Ulthera Thermage HIFUครั้ง
            if($tgid == '1000008'){
            	if($t2!=''){ $s5 = $s5 + $t2; }
            	if($t3!=''){ $s5 = $s5 + $t3; }
            	$s5 = $s5 * 0.2;
            	//$sum_total = $sum_total + $s5;
            }

            //6. 10% Treatment Face
            if($tgid == '1000009'){

            	if($t3!=''){ $s6 = $s6 + $t3 ; }
            	$s6 = $s6 * 0.1;
            	//$sum_total = $sum_total + $s6;
            }

            //7. 10% Treatment Body
            if($tgid == '1000010'){
            	if($t3!=''){ $s7 = $s7 + $t3; }
            	$s7 = $s7 * 0.1;
            	//$sum_total = $sum_total +$s7;
            }

            //8. Course Treatment &HIFU 5%
            if($tgid == '1000011'){
            	if($t3!=''){ $s8 = $s8 + $t3; }
            }

            //8. Course Treatment &HIFU 5%
            if($tgid == '1000011'){
            	if($t3!=''){ $s8 = $s8 + $t3; }
            }

            //10. Pico-10%
            if($tgid == '1000016'){
            	if($t1!=''){ $s10_1 = $s10_1 + $t1;  }
            	if($t2!=''){ $s10_2 = $s10_2 + ($t2 * 0.15);  }
            	if($t3!=''){ $s10_3 = $s10_3 + ($t3 * 0.15);  }
              $s10 = $s10_2 +  $s10_3;

            	//$sum_total =  $sum_total + (floatval($s0_2) + floatval($s0_3)) ;
            }

						//11. aura bright 15%
            if($tgid == '1000018'){
            	if($t3!=''){ $s11 = $s11 + $t3; }
							 $s11 = $s11 * 0.15;
            }


		}

		//T & L
		for($l = 0;$l < $cnum; $l++){
			$cgid = $cid[$l] ; $t1 = 0; $t2 = 0;
			//ขายทรีทเม้น / เลเซอร์
			$sl = "select a.totalprice from tb_pctrec a,tb_course b,tb_vst c where a.vn = c.vn and a.tid=b.cid and a.typ = 'C' and b.cgroup ='$cgid' and a.vn='$vn' and (c.status='COM')   ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$num = mysql_num_rows($tr);
			while($rs=mysql_fetch_array($tr)){
				if($rs['totalprice'] > 0){ $t2 = $t2 + $rs['totalprice']; $t1 = $t1 + 1; }
			}
			if(empty($t1)){ $t1 =''; }
			if(empty($t2)){ $t2 =''; }

			//8. Course Treatment &HIFU 5%
			if($cgid == '1000013'){
				if($t2!=''){ $s8 = $s8 + $t2;  }
				$s8 = $s8 * 0.05;
				//$sum_total = $sum_total + $s8;
			}

			//9. Course Laser  2%
			if($cgid == '1000014'){
				if($t1!=''){ $s9_1 = $s9_1 + $t1;  }
				if($t2!=''){ $s9_2 = $s9_2 + $t2;  }
				$s9_2 = $s9_2 * 0.02;
				$s9 = $s9_2;
				//$sum_total = $sum_total + $s9_2;
			}



			?>
            <TD align="center" align="center" bgcolor="#FFCC00"><?=$t1?></TD>
            <TD align="center" align="right" bgcolor="#FFCC00"><?=$t2?></TD>
            <?
		}

		//รวมยอดรายวัน
		$sum_total = $sum_total + $co2 + $s0 + $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10+$ka+$s11;
		?>
		<TD align="center" align="right" ><?=$tt;?></TD>
		<?
		//ใช้ Course
		?>
		<TD align="center" align="right" ><?=$tu;?></TD>
		<?
		//รวมรายได้+COURSE
		?>
		<TD align="center" align="right" ><? echo $tt + $tu; ?></TD>
		<?

		//รวม
		?>
		<TD align="center" align="right" ><? echo $sum_total; ?></TD>
		<?
		//ค่าตรวจ
		?>
		<TD align="center" align="right" ><? echo $d1 * 0.15; ?></TD>
		<?

		//KA
		?>
		<TD align="center" align="right" ><? echo $ka; ?></TD>
		<?

		//CO2
		?>
		<TD align="center" align="right" ><? echo $co2; ?></TD>

		<?// 0. ?>
		<TD align="center" align="right" > <? if($s0_1 == 0){ echo ''; } else { echo $s0_1; } ?>  </TD>
		<TD align="center" align="right" ><? if($s0_2 == 0){ echo ''; } else { echo $s0_2; } ?>  </TD>
		<TD align="center" align="right" > <? if($s0_3 == 0){ echo ''; } else { echo $s0_3; } ?> </TD>

		<?// 1. ?>
				<TD align="center" align="right" ><? if($s1_1 == 0){ echo ''; } else { echo $s1_1; } ?></TD>
		<TD align="center" align="right" ><? if($s1_2 == 0){ echo ''; } else { echo $s1_2; } ?></TD>
		<TD align="center" align="right" ><? if($s1_3 == 0){ echo ''; } else { echo $s1_3; } ?></TD>
		<? // 2. ?>
		<TD align="center" align="right" ><? if($s2_1 == 0){ echo ''; } else { echo $s2_1; } ?></TD>
		<TD align="center" align="right" ><? if($s2_2 == 0){ echo ''; } else { echo $s2_2; } ?></TD>
		<TD align="center" align="right" ><? if($s2_3 == 0){ echo ''; } else { echo $s2_3; } ?></TD>
		<? // 3. ?>
		<TD align="center" align="right" ><? if($s3 == 0){ echo ''; } else { echo $s3; } ?></TD>
		<? // 4. ?>
		<TD align="center" align="right" ><? if($s4_2 == 0){ echo ''; } else { echo $s4_2; } ?></TD>
		<TD align="center" align="right" ><? if($s4_3 == 0){ echo ''; } else { echo $s4_3; } ?></TD>
		<? // 5. ?>
		<TD align="center" align="right" ><? if($s5 == 0){ echo ''; } else { echo $s5; } ?></TD>
		<? // 6. ?>
		<TD align="center" align="right" ><? if($s6 == 0){ echo ''; } else { echo $s6; } ?></TD>
		<? // 7. ?>
		<TD align="center" align="right" ><? if($s7 == 0){ echo ''; } else { echo $s7; } ?></TD>

		<? // 10. ?>
		<TD align="center" align="right" ><? if($s10_2 == 0){ echo ''; } else { echo $s10_2; } ?></TD>
		<TD align="center" align="right" ><? if($s10_3 == 0){ echo ''; } else { echo $s10_3; } ?></TD>

		<? // 11. ?>
		<TD align="center" align="right" ><? if($s11 == 0){ echo ''; } else { echo $s11; } ?></TD>

		<? // 8. ?>
		<TD align="center" align="right" ><? if($s8 == 0){ echo ''; } else { echo $s8; } ?></TD>

		<? // 9. ?>
		<TD align="center" align="right" ><? if($s9_1 == 0){ echo ''; } else { echo $s9_1; } ?></TD>
		<TD align="center" align="right" ><? if($s9_2 == 0){ echo ''; } else { echo $s9_2; } ?></TD>
		<?
	}
}
?>


</TABLE>
</BODY>
</HTML>

<?

function emptyvalue(){
	?>
	<TD align="center" align="right" >-</TD>
	<TD align="center" align="right" >-</TD>
	<TD align="center" align="right" >-</TD>
	<?
}

?>
