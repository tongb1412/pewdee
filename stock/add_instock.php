<?
session_start();
include('../class/config.php');
$lno = $_POST['lno'];

$sql1 = "select did from tb_temp_drugeinstock where lno='$lno'";
$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
$n = mysql_num_rows($result);
if(!empty($n)){
     $empid = $SYS_EID;
     $sid = $_POST['sid'];
	 $sname = $_POST['sname'];
	 $dat = date('Y-m-d',time());
     $sql = "insert into tb_instock  values('$lno','$empid','$dat','$sid','$sname','D')";	
     mysql_query($sql) or die ("Error Querycc ".$sql);
	 
	 
	$sql1 = "select * from tb_temp_drugeinstock where lno='$lno'";
	$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
    while($rs=mysql_fetch_array($result)){
	   $did = $rs['did'];
	   $dname = $rs['dname'];
	   $unit = $rs['unit'];
	   $qty = $rs['qty'];
	   $price = $rs['price'];
	   $totalprice = $rs['totalprice'];
	   $bdate = $rs['bdate'];
	   $edate = $rs['edate'];
	   
       $sql = "insert into tb_drugeinstock  values('$lno','$did','$dname','$unit','$qty','$price','$totalprice','$bdate','$edate','$qty')";	
       mysql_query($sql) or die ("Error Querycc ".$sql);
	   
	   
	   $sql = "select total from tb_druge where did='$did'";
	   $str = mysql_query($sql) or die ("Error Querycc ".$sql); 	 
	   $row=mysql_fetch_array($str);
	   $dtotal = intval($qty) + intval($row['total']);
	   
	   $sql = "Update tb_druge Set total='$dtotal' Where did='$did'";
	   mysql_query($sql) or die ("Error Querycc ".$sql);
	   
	   $sql  = "update tb_autonumber set last='$lno' where typ='LT'";
	   mysql_query($sql) or die ("Error Query [".$sql."]");	
	    $dat = date('Y-m-d H:i:s');
	    $pname = $eid.'  รับยาเข้าคลัง';
		$sql = "insert into drugelog  values('NULL','-','$lno','$did','$dname','$qty','$dtotal','$pname','$dat','I')";
		mysql_query($sql);		   
	   
	   
	   
	   $txt = 'รับยาเข้าคลังเรียบร้อยแล้ว'; $con ='Y';
	}
} else {
	$txt = 'ไม่สามารถรับยาเข้าคลังได้ เนื่องจากไม่มีรายการยา'; $con ='N';
}

echo '||stock/instock_show.php'.'||STOCK||'.$lno.'||'.$txt.'||'.$con;
?>