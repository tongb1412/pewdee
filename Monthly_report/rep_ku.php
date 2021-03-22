<?
include('../class/config.php');
include('../class/permission_user.php');

$sdat = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2)+1, substr($_GET['edate'],6,4)));
$edate  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2), substr($_GET['edate'],6,4)));
$endLine = 33;

$txt1 = 'ตั้งแต่วันที่ '.showdateTH($sdat).'  ถึงวันที่  '.showdateTH($edate); 

if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

$sqlC .="select clinicname from tb_clinicinformation where cn = '$branch_id'";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs = mysql_fetch_array($strc);
$cname = $rs['clinicname'];

$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql  = "select a.vn,b.pname,b.fname,b.lname,b.new,c.*,d.cn, d.clinicname from tb_vst a,tb_patient b,tb_payment c, tb_clinicinformation d where (a.hn=b.hn) and (a.vn=c.vn) and (a.status IN('COM')) ";
$sql .= " and (c.total > 0) and (c.ku > 0) and (c.pdate between '$sdat' and '$edat') and c.branchid = d.cn $where_branch_id  order by a.branchid ,a.vn asc  ";


$str  = mysql_query($sql);
$num = mysql_num_rows($str);

$branch_name = "( สาขา ";
if ($branch_id == "00") {
	$branch_name .=  "ทั้งหมด";
} else {
	$branch_name .=  $cname;
}
$branch_name .= " )";

// echo $sql;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานคูปอง</title>
</head>
<style type="text/css">
body {
	font: 12px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	background:#FFFFFF;
	padding: 0;
	margin: 0;
	text-align:center;
}
.txt1 { font-size:14px; font-weight:bold; height:25px; line-height:25px; }
.lineH { border-bottom:#999999 1px solid; font-size:12px; font-weight:bold; line-height:20px; height:20px; overflow:hidden; }
.line { border-bottom:#999999 1px dotted; line-height:20px; height:20px; }
.lineT { border-bottom:#999999 1px dotted; line-height:20px; height:20px; font-weight:bold; }
.lineName { line-height:20px; height:20px; font-weight:bold; }
</style>
<body>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td align="center" class="txt1">รายงานคูปอง</td></tr>
	<tr><td align="center" class="txt1"><?php echo $branch_name; ?></td></tr>
	<tr><td align="center" class="txt1"><?=$txt1;?></td></tr>
    <tr>
    <td align="center">
    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" >
		<? 			
		$showLine = 1;
		$flag_branch = "";
		showHeader(); 		
        $n=0; $sd = ''; $m=1; 	
        while($rs  = mysql_fetch_array($str)){
		    $showLine++;
			if ($branch_id == "00") {
				if($flag_branch != $rs['branchid']){
					showHeaderBranch($rs['clinicname']);
					$flag_branch = $rs['branchid'];
				}
			}
			if($showLine > $endLine ){
				showHeader(); 
				$showLine = 1; 
			}			
        	$dat = substr($rs['pdate'],8,2).'-'.substr($rs['pdate'],5,2).'-'.substr($rs['pdate'],0,4);
        	if($sd!=$dat){ $sd=$dat; $dd= $dat; } else { $dd='-';  }  			
			$t1 = $m;
			$t2 = $dd;
			$t3 = $rs['pname'].$rs['fname'].'  '.$rs['lname'];
			$t4 = $rs['kno'];  
			$t5 = $rs['total'] - $rs['ku']  ;
			if($rs['new']=='O') { $t6 = 'เก่า'; } else { $t6 = 'ใหม่'; }
			if($rs['ktype']=='K') { $t7 = 'คูปอง'; } 
			if($rs['ktype']=='B') { $t7 = 'โอนเงิน'; } 
			if($rs['ktype']=='P') { $t7 = 'ไปรษณีย์'; } 
			$t8 = $rs['ku'] ;
			showDetail($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8);       
         	$n++; $m++;
		} 
		 ?>
    </table> 
    </td>
    </tr>       
</table>
<?
function showdateTH($txt){   
    $dat = explode('-',$txt);
    $d = $dat[2];
	$m = $dat[1];
	$y = $dat[0] + 543;
	$tt = '0';
	//$thmonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษาคม","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$thmonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	for($i=0;$i<12;$i++){
	    $x = explode($thmonth[$i],$txt);
		if( count($x) == 2){ $tt='563'; }
		
	}
	
	$m=$m-1;
	 
	if($tt=='563'){
    	return $txt;
	} else {
		return $d." ".$thmonth[$m]." ".$y;
	}
	
}
function showHeader(){
?>
    	<tr valign="top" >
        <td align="center" class="lineH" width="40">ลำดับ</td>
        <td align="center" class="lineH" width="80" >วันที่</td>        
        <td align="center" class="lineH" width="200" >ชื่อ</td>
        <td align="center" class="lineH" >เลขที่บัตร / รายละเอียด</td>
        <td align="center" class="lineH" width="80">ประเภทบัตร</td>
        <td align="center" class="lineH" width="80">ยอดส่วนลด</td> 
        <td align="center" class="lineH" width="80">ยอดหลังลด</td> 
        <td align="center" class="lineH" width="80">ประเภทคนไข้</td>               
    	</tr> 
<?
}

function showHeaderBranch($branch_name){
	?>
		<tr valign="top" >
			<td align="center" class="lineH" width="200"><?php echo $branch_name; ?></td>
		</tr> 
	<?
}
function showDetail($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8){
?>
        <tr valign="top">
        <td align="center" class="line" ><?=$t1?></td>
        <td align="center" class="line" ><?=$t2?></td>      
        <td align="left" class="line" ><?=$t3?></td>
        <td align="left" class="line"><?=$t4?>&nbsp;&nbsp;</td>
        <td align="center" class="line"  ><?=$t7?></td>
        <td align="right" class="line"><?=number_format($t8,0,'.',','); ?>&nbsp;&nbsp;</td>
        <td align="right" class="line"><?=number_format($t5,0,'.',','); ?>&nbsp;&nbsp;</td>
        <td align="center" class="line"><?=$t6?>&nbsp;&nbsp;</td>
    	</tr>  
<?
}

?>
</body>
</html>


