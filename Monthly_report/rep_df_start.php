<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<?
include('../class/config.php');
mysql_query("SET NAMES tis620");


$sdat = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_POST['edate'],3,2)  , substr($_POST['edate'],0,2)+1, substr($_POST['edate'],6,4)));




$txt1 = $_POST['sdate'].'  to  '.$_POST['edate']; 




$filName1 = "Rep_DDF.csv";
$objWrite = fopen("Rep_DDF.csv", "w");

fwrite($objWrite,"\" \",\" \",\" \",\" \"");

$sql = "select * from tb_gernaral where typ= 'GTR' order by discount desc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n=0;
while($rs = mysql_fetch_array($str)){
    $gname = $rs['name']; 
	fwrite($objWrite,",\"$gname\""); 
	fwrite($objWrite,",\" \""); 
	fwrite($objWrite,",\" \""); 
	$gid[$n] = $rs['id'];
	$n++;
}
$gnum = $n ;

$sql = "select * from tb_gernaral where typ= 'GTC' order by discount desc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n=0;
while($rs = mysql_fetch_array($str)){
    $gname = $rs['name']; 
	fwrite($objWrite,",\"$gname\""); 
	fwrite($objWrite,",\" \""); 
	$cid[$n] = $rs['id'];
	$n++;
}
$cnum = $n ;
fwrite($objWrite,"\n");	



fwrite($objWrite,"\"Doctor Name\",\"Date\",\"Amount\",\"DF\"");

$sql = "select * from tb_gernaral where typ= 'GTR' order by discount desc";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n=0;
while($rs = mysql_fetch_array($str)){
    
	fwrite($objWrite,",\"Qty\""); 
	fwrite($objWrite,",\"Use\""); 
	fwrite($objWrite,",\"Make\""); 

}
$sql = "select * from tb_gernaral where typ= 'GTC' order by discount desc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n=0;
while($rs = mysql_fetch_array($str)){
	fwrite($objWrite,",\"Use\""); 
	fwrite($objWrite,",\"Price\""); 
	$n++;
}

fwrite($objWrite,"\n");	




$sql = "select distinct a.empid,a.empname from tb_vst a,tb_staff b where (a.empid=b.staffid) and (a.empid<>'00') and (a.status='COM') and (b.typ='D') and (a.vdate between '$sdat%' and '$edat%') order by a.vn asc ";


$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
$number = mysql_num_rows($str);
$n=0;  
while($rs=mysql_fetch_array($str)){    
	$dname[$n] = $rs['empname'];
	$did[$n] = $rs['empid'];
	$n++; 
}


//distinct vn,distinct vdate

for($i = 0;$i < $number; $i++){
    
    $empid = $did[$i]; 
	$sql = "select distinct vn,vdate,hn from tb_vst where (empid='$empid')   and (vdate between '$sdat%' and '$edat%')";
	$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
	
	
	$rd= mysql_num_rows($str);
    $dtotal = 0;
	$dp = 0; $lp = 0; $total = 0;  $t1 = 0; $t2 = 0; $t3 = 0;
	while($rs=mysql_fetch_array($str)){
		$vn = $rs['vn'];  
		$dat = substr($rs['vdate'],0,10);
		
		$s1 = "select dp,lp,total from tb_payment where vn='$vn'  ";
		$tr  = mysql_query($s1)or die ("Error Query [".$s1."]");
		$row = mysql_fetch_array($tr);
		$total = $row['total'];
		$dp = $row['dp'] + $row['lp'];		
			
		$d1 = number_format($dp,'1','.',',');
		$y = explode('.',$d1);
		$d1 = $y[0];		
		
		$t1 = number_format($total,'1','.',',');
		$x = explode('.',$t1);
		$t1 = $x[0];
								
		fwrite($objWrite,"\"$dname[$i]\""); 
		fwrite($objWrite,",\"$dat\"");	
		fwrite($objWrite,",\"$t1\"");		
		fwrite($objWrite,",\"$d1\"");		
		
		for($j = 0;$j < $gnum; $j++){
		   
			$tgid = $gid[$j] ; 
			//ขายทรีทเม้น / เลเซอร์
			$sl = "select a.totalprice from tb_pctrec a,tb_treatment b,tb_vst c where a.vn = c.vn and a.tid=b.tid and a.typ in ('L','T') and b.tgroup ='$tgid' and a.vn='$vn' ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$row = mysql_fetch_array($tr);
			$num = mysql_num_rows($tr);
			
			
			
			$t1 = 0; $t2 = 0; $t3 = 0;
			if($row['totalprice'] > 0){ $t3 = $row['totalprice']; $t1++; } 	
		
		    	
				
			//ใช้ course
			$sl  = "select a.qty,(b.totalprice / b.qty) price,a.tid  from tb_pctuse a,tb_pctrec b,tb_treatment c ";
			$sl .= "where a.vn = b.vn and a.cid=b.tid and a.ftyp='C' and a.tid=c.tid and c.tgroup ='$tgid' and a.uvn='$vn'  ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$num = mysql_num_rows($tr);
			if(!empty($num)){
			    $t2= 0; 
				while($row = mysql_fetch_array($tr)){
					$t2 = $t2 + $row['price'] * $row['qty'];							
				    $t1 = $t1 + $row['qty'];
				}		
			} else { $t2 = ''; }
			if(empty($t1)){ $t1 =' '; }
			if(empty($t3)){ $t3 =' '; }
			
			fwrite($objWrite,",\"$t1\"");		
			fwrite($objWrite,",\"$t2\"");		
			fwrite($objWrite,",\"$t3\"");			
				
        }
			
		for($j = 0;$j < $cnum; $j++){	
			$cgid = $cid[$j] ; 
			//ขายทรีทเม้น / เลเซอร์
			$sl = "select a.totalprice from tb_pctrec a,tb_course b,tb_vst c where a.vn = c.vn and a.tid=b.cid and a.typ = 'C' and b.cgroup ='$cgid' and a.vn='$vn' ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$row = mysql_fetch_array($tr);
			$num = mysql_num_rows($tr);
						
			$t1 = 0; $t2 = 0; $t3 = 0;
			if($row['totalprice'] > 0){ $t2 = $row['totalprice']; $t1++; } 	
			if(empty($t1)){ $t1 =' '; }
			if(empty($t2)){ $t2 =' '; }
			fwrite($objWrite,",\"$t1\"");		
			fwrite($objWrite,",\"$t2\"");					
			
		}	
			
		
			

		fwrite($objWrite,"\n");		

	}
	

	
}

fclose($objWrite);
?>
<div style="width:300px; height:100px; margin:auto; text-align:center; font-size:20px; margin-top:100px;">
เตรียมข้อมูลเรียบร้อยแล้ว
<br />
<a href="Monthly_report/<?=$filName?>" target="_blank">Export File To Excel</a>

</div>

