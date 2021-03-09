<?
include('../class/config.php');
$an = $_POST['an'];
$hn = $_POST['hn'];
$cn = $_POST['cn'];
$pname = $_POST['pname'];
$atyp = $_POST['atyp'];
$pid = $_POST['pid'];

$stim = $_POST['stim'];
$etim = $_POST['etim'];
$atime = $_POST['atime'];
$mem = $_POST['mem'];
$flag = 0;

$branch_id = "";
if(!empty($_POST['bid'])){
	$branch_id = $_POST['bid'];
} else {
	if($_SESSION['branch_id'] != ""){
		$branch_id = $_SESSION['branch_id'];
		$where_branch_id = "and branchid = '$branch_id'";
	}
}



$dat = substr($_POST['dat'],6,4).'-'.substr($_POST['dat'],3,2).'-'.substr($_POST['dat'],0,2)  ;
$mod = 'Y';

$sql = "select stim,etim from tb_appointment where pid = '$pid' and dat = '$dat'   ";
// echo $sql;exit();
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
$n = mysql_num_rows($str);
if(!empty($n)){
	$rs = mysql_fetch_array($str);	
	if((strtotime($stim) > strtotime($rs['stim'])) and  (strtotime($stim) < strtotime($rs['etim']))){
		$mod = 'N'; 
	} else	if((strtotime($etim) > $rs['stim']) and  (strtotime($etim) < $rs['etim']) and (strtotime($stim) >= $rs['stim']) ){	   
		$mod = 'N'; 		
	}
}

echo $n.' '.$mod.' === '.strtotime($stim).' = '.strtotime($rs['stim']);

if($mod=='Y'){

	if($stim == ""){
		$stim = "00:00:00";
	}
	if($etim == ""){
		$etim = "00:00:00";
	}

	$sql = "select hn from tb_appointment where an = '$an'";
	$str = mysql_query($sql) or die ("Error Query [".$sql."]");
	$n = mysql_num_rows($str);
	if(empty($n)){
		$sql = "insert into tb_appointment  values('$an','$hn','$cn','$pname','$pid','$atyp','$dat','$stim','$etim','$atime','$mem','NONE','$branch_id')";
		$result = mysql_query($sql) or die ("Error Query [".$sql."]");
		if($result){
			$flag = 1;
		}
	} else {
		$sql = "Update tb_appointment Set atyp='$atyp',dat='$dat',stim='$stim',etim='$etim',atime='$atime',pid='$pid',mem='$mem' Where an='$an' " . $where_branch_id;
		$result = mysql_query($sql) or die ("Error Query [".$sql."]");
		if($result){
			$flag = 1;
		}
	}
	if($flag == 1){
		$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว';
	}
	else{
		$txt = 'ไม่สามารถบันทึกข้อมูลได้';
	}
	
} else {

$txt = 'ไม่สามารถบันทึกข้อมูลได้ เนื่องจากช่วงเวลานี้มีการจองในระบบแล้ว';

} 


echo '||appointment/new_form.php'.'||APP||ADD||'.$txt.'||'.$mod;
?>