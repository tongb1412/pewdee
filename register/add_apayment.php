<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$hn = $_POST['hn'];
$total = $_POST['total'];
$recive = $_POST['recive'];
$mode = $_POST['mode'];
$cash = $_POST['cash'];
$credit = $_POST['credit'];
$bank = $_POST['bank'];
$ctype = $_POST['ctype'];
$rmoney = $_POST['rmoney'];




$sql = "select * from tb_autonumber where typ='BILL'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = explode('-',$rs['number']);
$n = strlen($x[1]);
$bno = $x[0].'-' ;
$txt = explode('-',$rs['last']);
$num = intval($txt[1]) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$bno .= $t;  
 
$sum = $cash + $credit;
if($total < $sum){
	$cash = $total - $credit;
} 
 
$vn = 'AR'.date('ymdHis');
 
$dat = date('Y-m-d H:i:s');
$sql = "insert into tb_payment  values('$bno','$vn','$hn','$sum','$recive','$dat','$cash','$credit','$ctype','$bank','','','0','0','0','0','0','0','')";
mysql_query($sql);	   		



$sql  = "update tb_autonumber set last='$bno' where typ='BILL'";
mysql_query($sql) or die ("Error Query [".$sql."]");


$sql = "select * from tb_apayment where hn='$hn'  ";
$str = mysql_query($sql);
while(($rs=mysql_fetch_array($str)) && ($sum > 0)){
    $bil = $rs['billno'];
	if($rs['total'] <= $sum){	    
		$sum = $sum - $rs['total'];	
		$sql_delete="delete from tb_apayment where hn= '$hn' and billno='$bil' ";
		mysql_query($sql_delete) or die ("Error Query [".$sql_delete."]");			
	} else {
		$sum = $rs['total'] - $sum;
		$sql_update  = "update tb_apayment set total='$sum',pdate='$dat' where hn='$hn' and billno='$bil' ";
		mysql_query($sql_update) or die ("Error Query [".$sql_update."]");			
		$sum =0;
	}
}

$txt = 'ชำระเงินเรียบร้อยแล้ว';

echo '||register/register.php'.'||'.$bno.'||ADD||'.$txt.'||RG';

?>