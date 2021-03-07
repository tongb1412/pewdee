<?
session_start();
include('../class/config.php');
$lno = 'ADJ'. date('YmdHis');

if($_SESSION['branch_id'] !="") {	
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
	$branch_id = $_SESSION['branch_id'];
}else if ($_SESSION['branch_id'] =="") {	
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
	$branch_id = $_SESSION['branch_id'];
}


$sql1 = "select did from tb_temp_drugecutstock where lno='NO' " . $where_branch_id;

$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
$n = mysql_num_rows($result);
if(!empty($n)){
    $empid = $SYS_EID;
    $mem = $_POST['cmem'];
    
	$dat = date('Y-m-d',time());

    $sql = "insert into tb_cutstock  values('$lno','$empid','$dat','$mem','$branch_id')";
    mysql_query($sql) or die ("Error Query ".$sql);	 
	

	$sql1 = "select * from tb_temp_drugecutstock where lno='NO' " . $where_branch_id;
	// echo $sql1;exit();
	$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
    while($rs = mysql_fetch_array($result)){

       $typ = $rs['typ'];
	   $did = $rs['did'];
	   $dname = $rs['dname'];
	   $unit = $rs['unit'];
	   $qty = $rs['qty'];
	   $branchid = $rs['branchid'];

		$sql = "select sprice from tb_druge where did='$did'";
	    $str = mysql_query($sql) or die ("Error Query ".$sql); 	 
		$row=mysql_fetch_array($str);
		$price = intval($qty) * intval($row['sprice']);


       $sql = "insert into tb_drugecutstock  values('$lno','$typ','$did','$dname','$unit','$qty','$price','$branchid')";
       mysql_query($sql) or die ("Error Query ".$sql);
	   
	   if($typ=='I'){
	   	   //รับเข้า
	   		in_stock($vn,$did,$dname,$qty,$branchid);

		} else {
			//จ่ายออก
			cut_stock($lno,$did,$dname,$qty,$branchid);
		}	   
	   
	   $txt = 'ปรับสต็อคเรียบร้อยแล้ว'; $con ='Y';
	}
} else {
	$txt = 'ไม่สามารถรับยาเข้าคลังได้ เนื่องจากไม่มีรายการยา'; $con ='N';
}

echo '||stock/cutstock.php'.'||ADJSTOCK||'.$lno.'||'.$txt.'||'.$con;

function in_stock($vn,$did,$dname,$qty,$branchid){
	$iqty = $qty;
    $sql = "select total from tb_druge where did='$did'";
    $str = mysql_query($sql) or die ("Error Query ".$sql); 	 
    $row = mysql_fetch_array($str);
    $dtotal = intval($qty) + intval($row['total']);
   
   	$sql = "Update tb_druge Set total='$dtotal' Where did='$did'";
    mysql_query($sql) or die ("Error Query ".$sql);

	$sql1 = "select lno,qty from tb_drugeinstock  where did='$did' and total = 0 " . $where_branch_id ." order by lno desc ";
	echo $sql1;exit();
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
	while(($rs1=mysql_fetch_array($str1)) && ($qty > 0) ){
		$lno = $rs1['lno']; 
		if($rs1['qty'] < $qty ){
			$qty = $qty - $rs1['qty'];
			$dqty = $rs1['qty'];
		   	$sql2 = "Update tb_drugeinstock Set total='$dqty' Where did='$did' and lno='$lno' " . $where_branch_id;
		    mysql_query($sql2) or die ("Error Query ".$sql2);	

		} else {
		   	$sql2 = "Update tb_drugeinstock Set total='$qty' Where did='$did' and lno='$lno' " . $where_branch_id;
		    mysql_query($sql2) or die ("Error Query ".$sql2);	
			$qty = 0;
		}
	}

    $dat = date('Y-m-d H:i:s');
    $pname = $eid.' ปรับสต็อค||รับยาเข้าคลัง';
	$sql = "insert into drugelog (vn, lno, did, dname, qty, total, pname, dat, typ, branchid) values('-','$lno','$did','$dname','$iqty','$dtotal','$pname','$dat','I','$branch_id')";
	mysql_query($sql);	

}

function cut_stock($vn,$did,$dname,$qty,$branchid){

	$dat = date('Y-m-d H:i:s');
	$pname = $eid.' ปรับสต็อค||จ่ายออก';

	$sql1 = "select sum(total) as total from tb_drugeinstock  where did='$did' and total > 0 and branchid = '$branchid' group by did ";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");		
	$rs1 = mysql_fetch_array($str1);
	$dtotal = $rs1['total']; // จำนวน total ของ ยา จาก tb_drugeinstock หรือ ยาในคลัง ตาม สาขา
	$stotal = $dtotal - $qty;
	if($stotal < 0){ $stotal = 0;  }
	
	$sql1 = "select sum(total) as total from tb_druge where did='$did' and total > 0 group by did ";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");		
	$rs1 = mysql_fetch_array($str1); // จำนวน total ของ ยา จาก tb_drugeinstock หรือ ยาในคลังทั้งหมด
	$d_all_total = $rs1['total'];
	$s_all_total = $d_all_total - $qty;
	if($s_all_total < 0){ $s_all_total = 0;  }


	$sql = "update tb_druge set total='$s_all_total'  where did='$did' "; // อัตเดต จำนวนของ ยา ใน คลังยา ทั้งหมด
	mysql_query($sql);
	
	$sql1 = "select * from tb_drugeinstock where did='$did' and total > 0 and branchid = '$branchid' order by lno asc ";
	$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
	while(($rs1 = mysql_fetch_array($str1)) && ($qty > 0) ){
	    $lno = $rs1['lno'];;

		if($rs1['total'] >= $qty){			    
			$total = $rs1['total'] - $qty;//  $total = (จำนวน total ในสต็อค) - (จำนวน ที่ต้องการจ่ายออก)
		    $dtotal = $dtotal - $qty;			
			$sql = "insert into drugelog (vn, lno, did, dname, qty, total, pname, dat, typ, branchid) values('$vn','$lno','$did','$dname','$qty','$dtotal','$pname','$dat','P','$branchid')";
			mysql_query($sql);				
			$qty = 0;				
		} else {
			$qty = $qty - $rs1['total'];// 
			$sqty = $rs1['total'];
			// $dtotal = $dtotal - $rs1['total'];
			$dtotal = $dtotal - $qty;
			$sql = "insert into drugelog (vn, lno, did, dname, qty, total, pname, dat, typ, branchid) values('$vn','$lno','$did','$dname','$sqty','$dtotal','$pname','$dat','P','$branchid')";
			mysql_query($sql);					
			$total = 0;			
		}

		$sql2 = "update tb_drugeinstock set total='$total'  where did='$did' and branchid = '$branchid' and lno='$lno' ";
		mysql_query($sql2);							
		
	}	
}

?>