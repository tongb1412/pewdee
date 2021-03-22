<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Report1.xls"'); # ????????
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<HTML>

<HEAD>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');

$charset = "SET NAMES 'utf8'";

ini_set('max_execution_time',36000);

// $sqlC .="select clinicname from tb_clinicinformation ";
// $strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]");
// $rs=mysql_fetch_array($strc);

// $cname = $rs['clinicname'];
// $cname1 = $rs['clinicname'];


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

$where_branch_id2 = "";
if($branchid == "") {
	$where_branch_id2 = " where cn = '".$_SESSION["branch_id"] ."' and company_code ='".$_SESSION['company_code']."'  ";
}else {
	$where_branch_id2 = " where cn = '".$branchid ."' and company_code ='".$_SESSION['company_code']."' ";
}
$sqlC ="select clinicname from tb_clinicinformation $where_branch_id2";
// echo $sqlC;
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$cname = $rs['clinicname'];
if($cname =="") {
	$cname = "ทั้งหมด";
}
$cname1 = $cname;






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
$sn = ($gnum*3) + 5;

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
$sn += 4;
?>

<BODY>
	<TABLE x:str BORDER="1">
		<TR x:str BORDER="0">
			<TD colspan="<?= $sn ?>" align="center"><b>รายงานบัญชีแพทย์ <?php if ($branchname != "") {
																			echo " (สาขา $branchname)";
																		} ?></b></TD>

		</TR>
		<TR x:str BORDER="0">
			<TD colspan="<?= $sn ?>" align="center"><b><?= $txt1 ?></b></TD>

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
			<? for($i=0; $i<$gnum; $i++){ ?>
			<TD align="center" colspan="3" align="center"><b><?= $gname[$i] ?></b></TD>
			<? } ?>
			<? for($i=0; $i<$cnum; $i++){ ?>
			<TD align="center" colspan="2" align="center" bgcolor="#FFCC00"><b><?= $cname[$i] ?></b></TD>
			<? } ?>

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
		</TR>


		<?


$sql = "select distinct a.empid,a.empname ,branchname
	from tb_vst a
	left join tb_staff b on a.empid=b.staffid
	left join tb_branch c ON a.branchid = c.branchid
	where (a.status='COM') and (b.typ='D') and (a.vdate between '$sdat%' and '$edat%') $where_branch_id order by a.vn asc ";
echo $sql;
$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
$number = mysql_num_rows($str);
$n=0;
while($rs=mysql_fetch_array($str)){
    $con ='Y';
	for($i = 0;$i < $n; $i++){
		if($rs['empid']==$did[$i]){ $con='N';  }
	}

	if($con=='Y'){
		$dname[$n] = $rs['empname'];
		$did[$n] = $rs['empid'];
		$n++;
	}

}
$j = 0;
for($i = 0;$i < $n; $i++){

    $empid = $did[$i];
	$sql = "select distinct vn,vdate,hn,branchname 
		from tb_vst a
		left join tb_branch b ON a.branchid = b.branchid
		where (empid='$empid') and (status='COM')   and (vdate between '$sdat%' and '$edat%') $where_branch_id";
	$str  = mysql_query($sql)or die ("Error Query [".$sql."]");


	$rd= mysql_num_rows($str);
    $dtotal = 0;
	$dp = 0; $lp = 0; $total = 0; $dis = 0;  $t1 = 0; $t2 = 0; $t3 = 0; $tka =0;
	while($rs=mysql_fetch_array($str)){
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

		$k1 = number_format($tka,'1','.',',');
		$w = explode('.',$k1);
		$k1 = $w[0];




		$s1 = "select billno,dp,lp,ku,discount,total from tb_payment where vn='$vn'  ";
		$tr  = mysql_query($s1)or die ("Error Query [".$s1."]");
		$row = mysql_fetch_array($tr);




		$total = $row['total'];
		$dp = $row['dp'] + $row['lp'] - $tka;
		$dis = $row['ku'] + $row['discount'];

		$d1 = number_format($dp,'1','.',',');
		$y = explode('.',$d1);
		$d1 = $y[0];

		$t1 = number_format($total,'1','.',',');
		$x = explode('.',$t1);
		$t1 = $x[0];

		$c1 = number_format($dis,'1','.',',');
		$a = explode('.',$c1);
		$c1 = $a[0];

		$clinic_name = $rs['branchname'];

		?>
		<TR valign="top">

			<?php
			if ($branchid != "") {
			?>
				<TD align="center" align="left"><?= $clinic_name ?></TD>
			<?php
			} else {
			?>
				<TD align="center" align="left"><?= $cname1 ?></TD>
			<?php
			}
			?>

			<TD align="center" align="center"><?= $j ?></TD>
			<TD align="center" align="left"><?= $dname[$i] ?></TD>
			<TD align="center" align="center"><?= $dat ?></TD>
			<TD align="center" align="center"><?= $row['billno'] ?></TD>
			<TD align="center" align="center"><?= $t1 ?></TD>
			<TD align="center" align="center"><?= $d1 ?></TD>
			<TD align="center" align="center"><?= $c1 ?></TD>
			<TD align="center" align="center"><?= $k1 ?></TD>
			<?

		for($l = 0;$l < $gnum; $l++){

			$tgid = $gid[$l] ;  $t1 = 0; $t2 = 0; $t3 = 0;
			//ขายทรีทเม้น / เลเซอร์
			$sl = "select sum(a.totalprice) as tprice,count(a.tid) as tqty from tb_pctrec a,tb_treatment b,tb_vst c where a.vn = c.vn and a.tid=b.tid and a.typ in ('L','T') and (c.status='COM')  ";
			$sl .= "and b.tgroup ='$tgid' and a.vn='$vn' group by b.tgroup  ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$row = mysql_fetch_array($tr);
			$num = mysql_num_rows($tr);
			if(!empty($num)){ $t3 = $t3 + $row['tprice']; $t1 = $t1 + $row['tqty'] ;  }


			//while($row = mysql_fetch_array($tr)){
			//	if($row['totalprice'] > 0){ $t3 = $t3 + $row['totalprice']; $t1++; }
		    //}

			//ใช้ course

			$sl  = "select sum(a.qty) as tqty, sum((b.totalprice / b.qty) * a.qty) as price from tb_pctuse a,tb_pctrec b,tb_treatment c,tb_vst d ";
			$sl .= "where a.uvn = d.vn and a.vn = b.vn and a.cid=b.tid and a.ftyp='C' and a.tid=c.tid and c.tgroup ='$tgid' and a.uvn='$vn' and (d.status='COM') group by  c.tgroup ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$num = mysql_num_rows($tr);
			if(!empty($num)){
			   //$t2= 0;
			   $row = mysql_fetch_array($tr);
			   $t2 = $t2 + $row['price'];
			   $t1 = $t1 + $row['tqty'];
				//while($row = mysql_fetch_array($tr)){
				//    $i++;
				//	$t2 = $t2 + $row['price'] * $row['qty'];
				//    $t1 = $t1 + $row['qty'];
				//}
			} else { $t2 = ''; }

			if(empty($t1)){ $t1 =' '; }
			if(empty($t3)){ $t3 =' '; }
			?>
			<TD align="center" align="center"><?= $t1; ?></TD>
			<TD align="center" align="right"><?= $t2; ?></TD>
			<TD align="center" align="right"><?= $t3; ?></TD>
			<?
        }




		for($l = 0;$l < $cnum; $l++){
			$cgid = $cid[$l] ;
			//ขายทรีทเม้น / เลเซอร์
			$sl = "select a.totalprice from tb_pctrec a,tb_course b,tb_vst c where a.vn = c.vn and a.tid=b.cid and a.typ = 'C' and b.cgroup ='$cgid' and a.vn='$vn' and (c.status='COM')   ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			//$row = mysql_fetch_array($tr);
			$num = mysql_num_rows($tr);

			$t1 = 0; $t2 = 0; $t3 = 0;
			while($rs=mysql_fetch_array($tr)){

				if($rs['totalprice'] > 0){ $t2 = $t2 + $rs['totalprice']; $t1 = $t1 + 1; }

			}



			if(empty($t1)){ $t1 =' '; }
			if(empty($t2)){ $t2 =' '; }
			?>
			<TD align="center" align="center" bgcolor="#FFCC00"><?= $t1 ?></TD>
			<TD align="center" align="right" bgcolor="#FFCC00"><?= $t2 ?></TD>

			<?

		}

	?>
		</TR>
		<?
	}

}
?>




	</TABLE>
</BODY>

</HTML>