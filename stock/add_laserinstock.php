<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$lno = $_POST['lno'];

$sql1 = "select lid from tb_temp_laserinstock where lno='$lno'";
$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
$n = mysql_num_rows($result);
if(!empty($n)){
     $empid = 'ST-0000001';
     $sid = $_POST['sid'];
	 $sname = $_POST['sname'];
	 $dat = date('d-m-Y',time());
     $sql = "insert into tb_instock  values('$lno','$empid','$dat','$sid','$sname','L')";	
     mysql_query($sql) or die ("Error Querycc ".$sql);
	 
	 
	$sql1 = "select * from tb_temp_laserinstock where lno='$lno'";
	$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
    while($rs=mysql_fetch_array($result)){
	   $lid = $rs['lid'];
	   $lname = $rs['lname'];
	   $unit = $rs['unit'];
	   $qty = $rs['qty'];
	
	   
       $sql = "insert into tb_laserinstock  values('$lno','$lid','$lname','$unit','$qty','$qty')";	
       mysql_query($sql) or die ("Error Querycc ".$sql);
	   
	   
	   $sql = "select total from tb_laser where lid='$lid'";
	   $str = mysql_query($sql) or die ("Error Querycc ".$sql); 	 
	   $row=mysql_fetch_array($str);
	   $dtotal = intval($qty) + intval($row['total']);
	   
	   $sql = "Update tb_laser Set total='$dtotal' Where lid='$lid'";
	   mysql_query($sql) or die ("Error Querycc ".$sql);
	   
	   $sql  = "update tb_autonumber set last='$lno' where typ='LT'";
	   mysql_query($sql) or die ("Error Query [".$sql."]");	
	   
	   $txt = 'รับเลเซอร์เข้าคลังเรียบร้อยแล้ว';
	}
} else {
	$txt = 'ไม่สามารถรับยาเข้าคลังได้ เนื่องจากไม่มีเลเซอร์';
}

echo '||stock/laserinstock.php'.'||'.$lno.'||ADD||'.$txt;
?>