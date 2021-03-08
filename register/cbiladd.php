<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$eid = $_POST['eid'];
$mem = $_POST['mem'];
$pname = $_POST['pname'];


$sql = "select a.billno,a.pdate,a.hn,a.total,b.pname,b.fname,b.lname from tb_payment a,tb_patient b where a.hn=b.hn and  a.vn='$vn'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$rs=mysql_fetch_array($result);
$bno = $rs['billno'];
$hn = $rs['hn'];
$cname = $rs['pname'].$rs['fname'].'   '.$rs['lname'];
$total = $rs['total'];



$dat = date('Y-m-d H:i:s');

$sql = "select * from drugelog where vn='$vn'";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
while($rs=mysql_fetch_array($str)){
	$did = $rs['did'];
	$dname = $rs['dname'];
    $lno = $rs['lno'];
	$qty = $rs['qty'];

	$sql1 = "select total from tb_druge where did='$did'";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
	$rs1=mysql_fetch_array($str1);
	$dtotal = $rs1['total'] + $qty;

	$sql = "update tb_druge set total='$dtotal'  where did='$did' ";
	mysql_query($sql);



	$tname = 'รับยาคืนจาก'.$cname;

	$sql = "insert into drugelog values('NULL','-','$lno','$did','$dname','$qty','$dtotal','$tname','$dat','I') ";
	mysql_query($sql)or die ("Error Query ".$sql) ;


	$sql1 = "select total from tb_drugeinstock  where did='$did' and lno='$lno' ";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
	$rs1=mysql_fetch_array($str1);
	$dtotal = $rs1['total'] + $qty;

	$sql = "update tb_drugeinstock set total='$dtotal'  where did='$did' and lno='$lno' ";
	mysql_query($sql);

//	$sql_delete="delete from drugelog where lno= '$lno' and vn='$vn' and did = '$did' ";
//	mysql_query($sql_delete);






}

$sql = "update tb_pctrec set total='0'  where hn='$hn' and vn='$vn' ";
mysql_query($sql);


$sql = "select qty,vn,ftyp,pid from tb_pctuse  where uvn='$vn' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
while($rs=mysql_fetch_array($str)){
	$qty = $rs['qty']; $pvn=$rs['vn']; $ftyp=$rs['ftyp']; $pid=$rs['pid'];

	$sql1 = "select total from tb_pctrec  where vn='$pvn' and tid='$pid' and typ='$ftyp' ";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
	$rs1=mysql_fetch_array($str1);
    $total = $rs1['total'] + $qty;

	$sql = "update tb_pctrec set total='$total'  where vn='$pvn' and tid='$pid' and typ='$ftyp' ";
	mysql_query($sql);

}

$sql = "delete from tb_pctlist  Where vn='$vn' and hn='$hn' ";
mysql_query($sql) or die ("Error Query [".$sql."]");

$sql = "delete from tb_pctuse  Where uvn='$vn' and hn='$hn' ";
mysql_query($sql) or die ("Error Query [".$sql."]");



$sql = "update tb_patient set stayin='REG',vn='-'  where hn='$hn' ";
mysql_query($sql);

$dat = date('Y-m-d');
$tim = date('H:i:s');

$sql = "update tb_vst set status='CANCEL',ctime ='$dat'  where vn='$vn' ";
mysql_query($sql);

$sql = "insert into cbil  values('$bno','-','$mem','$vn','$eid','$cname','$pname','$total','$dat','$tim')";
mysql_query($sql);

echo '||register/register.php'.'||'.$vn.'||C||ยกเลิกใบเสร็จเรียบร้อยแล้ว';



?>
