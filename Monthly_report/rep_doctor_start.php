<meta http-equiv="Content-Type" content="text/html; charset=tis620"> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<?
include('../class/config.php');

if(empty($_POST['sdate'])){
	$sdate ='0000-00-00';
	$edate ='0000-00-00';
} else {
	$t0 = strtotime($_POST['sdate']);
	$t1 = strtotime($_POST['edate']); 
	$t2 = strtotime($_POST['edate']) + (1*24*3600); 
	
	$sdate = date("Y-m-d", $t0); 
	$edate = date("Y-m-d", $t1); 
	$edate1 = date("Y-m-d", $t2); 
}
mysql_query("SET NAMES tis620");
$sql = "select tid,tname from tb_treatment order by tname";
$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
$nTr = mysql_num_rows($str); 
$n = 1;
$tnid[0] = '';
$tname[0] = 'Doctor Name';
while ($rs=mysql_fetch_array($str)){
	$tnid[$n] = $rs['tid'];
	$tname[$n] = $rs['tname'];	
	$n++;
}


$sql = "select distinct a.empid,a.ename from tb_pctuse a,tb_staff b where (a.empid=b.staffid) and (b.typ='D') and (a.dat between '$sdate%' and '$edate%') ";
$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
$rd= mysql_num_rows($str);
$n=0;  
while($rs=mysql_fetch_array($str)){
	$dname[$n] = $rs['ename'];
	$did[$n] = $rs['empid'];
	$n++; 
}





$filName = "Rep_Doctor.csv";
$objWrite = fopen("Rep_Doctor.csv", "w");

fwrite($objWrite,"\"Doctor Name\",\"Date\"");



for($i = 1;$i <= $nTr; $i++){
	fwrite($objWrite,",\"$tname[$i]\"");
}
fwrite($objWrite,"\n");


for($i = 0;$i < $rd; $i++){
	$stotal[0] = 0;
	for($m = 1;$m <= $nTr; $m++){
		$stotal[$m] = 0;
	}
	$sum = 0;
    $empid = $did[$i];	
	
	$sql_mm  = "select a.totalprice,b.tid,b.pid,b.ftyp,b.typ,b.dat,b.tname,b.qty,b.empid,b.ename,c.cradno,";
	$sql_mm .= "c.pname,c.fname,c.lname,(a.totalprice / a.qty) priceunit,((a.totalprice / a.qty)*b.qty) price  ";
    $sql_mm .= "from tb_pctrec a,tb_pctuse b,tb_patient c  where (a.hn = c.hn) and  (b.dat  between '$sdate' and '$edate' )  ";
	$sql_mm .= "and (a.vn = b.vn) and (a.tid = b.pid)  and (b.empid='$empid') ";
	
	//$sql_mm  = "select   from tb_vst a,tb_pctuse b where (a.vn=b.uvn) and (a.status IN('COM')) and (b.dat  between '$sdate%' and '$edate%' ) and (b.empid='$empid') ";
	$str_mm  = mysql_query($sql_mm)or die ("Error Query [".$sql_mm."]");
	 
	
	while ($rs = mysql_fetch_array($str_mm)){	
	
	    
		fwrite($objWrite,"\"$dname[$i]\""); 
		fwrite($objWrite,",\"$rs[dat]\"");  
	
		for($j=1;$j<$nTr;$j++){
			$trid = $tnid[$j];               	
	        if($rs['tid']==$trid){	
					
				switch($rs['ftyp']){
				case 'PC' : $pid = $rs['pid']; $cid = $rs['tid'];   
							$t_sql = "select qty,typ,id from tb_package_detail where pid='$pid' ";
							$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
							$row=mysql_fetch_array($str);
							$qty = $row['qty']; 
							if($row['typ']=='C'){
								$tid = $row['id'];  
								$t_sql = "select b.qty from tb_package_detail a,tb_course_detail b where a.id=b.cid and a.pid='$pid'  and b.tid='$cid' ";
								$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
								
								$row=mysql_fetch_array($str);
								$qty = $qty * $row['qty'];
								if( $qty > 0){
								$price = ( $rs['totalprice'] / $qty ) * $rs['qty']; 
								} else {
								$price = $rs['totalprice'];
								}			
							} else {
								$t_sql = "select qty from tb_package_detail where pid='$pid' and id='$cid' ";
								$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
								$row=mysql_fetch_array($str);
								if($qty > 0){
								$price = ( $rs['totalprice'] / $qty ) * $rs['qty'];	
								} else {
								$price = $rs['totalprice'];
								}	
								//$price =  $rs['price']; 			
							}
							break;
				case 'C' :  $cid = $rs['pid']; $tid = $rs['tid']; 
				
							$t_sql = "select qty from tb_course_detail where cid='$cid' and tid='$tid' ";
							$str  = mysql_query($t_sql)or die ("Error Query [".$t_sql."]"); 
							$row=mysql_fetch_array($str);
							
							//$price = ( $rs['totalprice'] / $row['qty'] ) * $rs['qty']; 
							
							if($qty > 0){
								$price = ( $rs['totalprice'] / $qty ) * $rs['qty'];	
							} else {
								$price = $rs['totalprice'];
							}								
							
							//$price =  $rs['price']; 			
							break;
				case 'T' :  $price =  $rs['totalprice'];
									
							break;
				}
				//$price =  $rs['price']; 
       
			
			    $stotal[$j] = $stotal[$j] + $price;
			
			    $sum = $sum + $price;
			    $t1 = number_format($price,'0','.',',');
            	fwrite($objWrite,",\"$t1\"");	
	
	        } else { fwrite($objWrite,",\"\""); }
				
	
	
		}		
		
		
		
		
		
		fwrite($objWrite,"\n");
	
	}
	$t1 = number_format($sum,'1','.',',');
	$y = explode('.',$t1);
	$t1 = $y[0];
	

	fwrite($objWrite,"\"$t1\",\"Total\"");
	for($m = 1;$m <= $nTr; $m++){
	    $sxx = number_format($stotal[$m],'1','.',','); 
	    $y = explode('.',$sxx); 
	    $x = $y[0];
		fwrite($objWrite,",\"$x\"");
	}	
	fwrite($objWrite,"\n");	
}


fclose($objWrite);


$filName1 = "Rep_DF.csv";
$objWrite = fopen("Rep_DF.csv", "w");
fwrite($objWrite,"\"Doctor Name\",\"Date\",\"Druge total\",\"DF total\"");
fwrite($objWrite,"\n");	



$sql = "select distinct a.empid,a.empname from tb_vst a,tb_staff b where (a.empid=b.staffid) and (a.empid<>'00') and (a.status='COM') and (b.typ='D') and (a.vdate between '$sdate%' and '$edate1%') order by a.vn asc ";
$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
$number= mysql_num_rows($str);
$n=0;  
while($rs=mysql_fetch_array($str)){
	$dname[$n] = $rs['empname'];
	$did[$n] = $rs['empid'];
	
	//echo $rs['empname'].'--';
	$n++; 
}


//distinct vn,distinct vdate

for($i = 0;$i < $number; $i++){
    
    $empid = $did[$i];
	$sql = "select distinct vn,vdate,hn from tb_vst where (empid='$empid')   and (vdate between '$sdate%' and '$edate1%')";
	$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
	
	
	$rd= mysql_num_rows($str);
    $dtotal = 0;
	$dat = '';  $dp = 0; $lp = 0;
	while($rs=mysql_fetch_array($str)){
		$vn = $rs['vn'];  
		$pdate = substr($rs['vdate'],0,10);
		
		if($pdate!=$dat){
		    if(!empty($dat)){
				$d1 = number_format($dp,'1','.',',');
				$y = explode('.',$d1);
				$d1 = $y[0];
				  $eid  = $empid.' - '.$dat;
				$l1 = number_format($lp,'1','.',',');
				$x = explode('.',$l1);
				$l1 = $x[0];
				
								
				fwrite($objWrite,"\"$dname[$i]\""); 
				fwrite($objWrite,",\"$dat\"");			
				fwrite($objWrite,",\"$d1\"");
				fwrite($objWrite,",\"$l1\"");
				fwrite($objWrite,"\n");		
			}
			$dat = $pdate;			
			$s1 = "select dp,lp from tb_payment where vn='$vn'  ";
			$tr  = mysql_query($s1)or die ("Error Query [".$s1."]");
			$row = mysql_fetch_array($tr);
			$dp = $row['dp'];
			$lp = $row['lp'];	
			
		
			

	    } else if(!empty($dat)){

			$s1 = "select dp,lp from tb_payment where vn='$vn'  ";
			$tr  = mysql_query($s1)or die ("Error Query [".$s1."]");
			$row = mysql_fetch_array($tr);
			$dp = $dp + $row['dp'];
			$lp = $lp + $row['lp'];
		}
		
		

	}
	
	
	if((!empty($dp)) || (!empty($lp)) ){
		$d1 = number_format($dp,'1','.',',');
		$y = explode('.',$d1);
		$d1 = $y[0];
		
		$l1 = number_format($lp,'1','.',',');
		$x = explode('.',$l1);
		$l1 = $x[0];		
		

		fwrite($objWrite,"\"$dname[$i]\""); 
		fwrite($objWrite,",\"$pdate\"");			
		fwrite($objWrite,",\"$d1\"");
		fwrite($objWrite,",\"$l1\"");
		fwrite($objWrite,"\n");	
	}
	
}

fclose($objWrite);

?>
<div style="width:100%; height:100px; text-align:center; font-size:20px; margin-top:100px;">
เตรียมข้อมูลเรียบร้อยแล้ว
<br />
<a href="Monthly_report/<?=$filName?>" target="_blank">Export File To Excel บัญชีแพทย์</a>
<br />
<a href="Monthly_report/<?=$filName1?>" target="_blank">Export File To Excel DF</a>
</div>

