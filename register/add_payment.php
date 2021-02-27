<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$hn = $_POST['hn'];
$total = $_POST['total'];
$recive = $_POST['recive'];
$mode = $_POST['mode'];
$cash = $_POST['cash'];
$credit = $_POST['credit'];
$bank = $_POST['bank'];
$ctype = $_POST['ctype'];
$rmoney = $_POST['rmoney'];
$dis = $_POST['discount'];
$ku = $_POST['ku'];
$kno = $_POST['kno'];
$ktype = $_POST['ktype'];

$eid = $_POST['eid'];

$sql = "select pname,fname,lname from tb_staff where staffid='$eid' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$ename = $rs['pname'].$rs['fname'].'   '.$rs['lname']; 



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
 
$sum = $cash + $credit + $ku;
if(($total-$dis) < $sum){
	$cash = $cash - $rmoney;
} 
 
 
$dat = date('Y-m-d H:i:s'); 

$sql = "insert into tb_vst  values('$vn','$hn','$dat','COM','$eid','$ename','99','','')";
mysql_query($sql);	 
 
 
 

$sql = "insert into tb_payment  values('$bno','$vn','$hn','$total','$recive','$dat','$cash','$credit','$ctype','$bank','$ku','$kno','$dis','$total','0','0','0','0','$ktype')";
mysql_query($sql);	   		
$total = $total - $dis; 		
$recive = $cash + $credit + $ku;
if($total > $recive ){
	$ar = $total - $recive;
	$sql = "insert into tb_apayment  values('$bno','$vn','$hn','$ar','$dat')";
	mysql_query($sql);

}

$sql  = "update tb_autonumber set last='$bno' where typ='BILL'";
mysql_query($sql) or die ("Error Query [".$sql."]");

$sql = "update tb_patient set vn='-',stayin='REG'  where hn='$hn' ";
mysql_query($sql);

$sql = "update tb_vst set status='COM',ctime='$dat'  where vn='$vn' ";
mysql_query($sql);

custstock($vn);


$txt = 'ชำระเงินเรียบร้อยแล้ว';

echo '||register/register.php'.'||'.$bno.'||ADD||'.$txt.'||RG||'.$hn.'||'.$vn;




function custstock($vn){
    $dat = date('Y-m-d H:i:s');
	$sql = "select * from tb_drugerec where vn='$vn'";
	$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	while($rs=mysql_fetch_array($str)){
		$did = $rs['did'];
		$qty = $rs['qty'];
		
		$sql1 = "select b.pname,b.fname,b.lname from tb_vst a,tb_patient b where a.hn=b.hn and a.vn='$vn'  ";
		$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
		$rs1=mysql_fetch_array($str1);
		$pname = $rs1['pname'].$rs1['fname'].'       '.$rs1['lname'];		
		
		
		
		$sql1 = "select total,tname from tb_druge where did='$did'";
		$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
		$rs1=mysql_fetch_array($str1);
		//$dtotal = $rs1['total'] - $qty;
		$dname = $rs1['tname'];
		
		
		$sql1 = "select sum(total) as total from tb_drugeinstock  where did='$did' and total > 0 group by did ";
		$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");		
		$rs1=mysql_fetch_array($str1);
		$dtotal = $rs1['total'];
		
		$stotal = $dtotal - $qty;
		
		$sql = "update tb_druge set total='$stotal'  where did='$did' ";
		mysql_query($sql);
		
		
		$sql1 = "select * from tb_drugeinstock  where did='$did' and total > 0 order by lno asc ";
		$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]");
		while(($rs1=mysql_fetch_array($str1)) && ($qty > 0) ){
		    $lno = $rs1['lno'];
			
			$sql = "insert into drugelog  values('$vn','$lno','$did','$qty')";
			mysql_query($sql);				
			
			if($rs1['total'] >= $qty){			    
				$total = $rs1['total'] - $qty;
			     $dtotal = $dtotal - $qty;				
				$sql = "insert into drugelog  values('NULL','$vn','$lno','$did','$dname','$qty','$dtotal','$pname','$dat','P')";
				mysql_query($sql);					
				$qty = 0;				
			} else {
				$qty = $qty - $rs1['total']; $sqty = $rs1['total'];
				$dtotal = $dtotal - $rs1['total'];	
				$sql = "insert into drugelog  values('NULL','$vn','$lno','$did','$dname','$sqty','$dtotal','$pname','$dat','P')";
				mysql_query($sql);					
				$total = 0;			
			}
			$sql2 = "update tb_drugeinstock set total='$total'  where did='$did' and lno='$lno'  ";
			mysql_query($sql2);	
			
						
			
		}	
		
		
		
		
		
			

	}
}

?>