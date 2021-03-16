<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');

$sqlC .= "select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs = mysql_fetch_array($strc);

$cname = $rs['clinicname']; 

$sql  = "select * from tb_druge where status = 'IN' order by dgid,tname ";
$str  = mysql_query($sql);
$num = mysql_num_rows($str);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>รายงานยาคงคลัง</title>
</head>
<style type="text/css">
	body {
		font: 12px Tahoma, Verdana, Arial, Helvetica, sans-serif;
		background: #FFFFFF;
		padding: 0;
		margin: 0;
		text-align: center;
	}

	.txt1 {
		font-size: 12px;
		font-weight: bold;
		height: 25px;
		line-height: 25px;
	}

	.lineH {
		border-bottom: #999999 1px solid;
		font-size: 12px;
		line-height: 20px;
		height: 20px;
		overflow: hidden;
	}

	.line {
		border-bottom: #999999 1px dotted;
		line-height: 20px;
		height: 20px;
		overflow: hidden;
	}

	.lineT {
		border-bottom: #999999 1px dotted;
		line-height: 20px;
		height: 20px;
		font-weight: bold;
	}

	.lineName {
		line-height: 20px;
		height: 20px;
		font-weight: bold;
	}

	.tline {
		border: 1px solid #333333;
		border-right: none;
		overflow: hidden;
		text-align: center;
		height: 20px;
		line-height: 20px;
		font-size: 11px;
	}

	.tr {
		overflow: hidden;
		border: 1px solid #333333;
		text-align: center;
		height: 20px;
		line-height: 20px;
		font-size: 11px;
	}


	.tlineD {
		border: 1px solid #333333;
		border-right: none;
		border-top: none;
		overflow: hidden;
		text-align: center;
		height: 20px;
		line-height: 20px;
		font-size: 11px;
	}

	.trD {
		overflow: hidden;
		border: 1px solid #333333;
		border-top: none;
		text-align: center;
		height: 20px;
		line-height: 20px;
		font-size: 11px;
	}
</style>

<body>
	<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">

		<tr>
			<td align="center" class="txt1">
				<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="50">&nbsp;สาขา</td>
						<td width="300" style="border-bottom:#666666 1px dotted;"><?= $cname ?></td>
						<td width="90" align="right">check ครั้งที่&nbsp;</td>
						<td width="50" style="border-bottom:#666666 1px dotted;"></td>
						<td width="40" align="right">วันที่&nbsp;</td>
						<td width="150" style="border-bottom:#666666 1px dotted;"></td>

					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" class="txt1">
				<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="50" align="left">&nbsp;ผู้เช็ค1</td>
						<td width="150" style="border-bottom:#666666 1px dotted;"></td>
						<td width="50" align="center">&nbsp;ผู้เช็ค2</td>
						<td width="150" style="border-bottom:#666666 1px dotted;"></td>
						<td width="290" align="left">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" class="txt1">&nbsp;</td>
		</tr>

		<? 
	$j = 1; $st = 0; $m = 1;
	
	
	while($num > 0){
		if($j==1){
		    showHead();
			$num = $num - 48; 
			showDetail($st,48); 
			$st = $st + 48;
			if($num - 48 > 0){
				$num = $num - 48; 
				showDetail($st,48);
				$st = $st + 48;				
			} else {			 	
				$p = $num;
				$num = 0;
				showDetail($st,$p);  
			}
			showFoot();
		    $j = 10;
		} else {
			showHead();	  
			if($num - 51 > 0){		
		   		$num = $num - 51;		   		
				showDetail($st,51); 
				$st = $st + 51;				
				if($num - 51 > 0){
					$num = $num - 51; 
					showDetail($st,51);
					$st = $st + 51;				
				} else {			 	
					$p = $num;
					$num = 0;
					showDetail($st,$p);  
				}				
		    } else { 
				$p = $num;
				$num = 0;
				showDetail($st,$p);	
				showEmpty();		
			}
			showFoot();
		}
	}


	?>

	</table>
	<?
function showHead(){
?>
	<tr>
		<td align="center">
			<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
				<?
}

function showFoot(){
?>
			</table>
		</td>
	</tr>

	<?
}

function showDetail($Page_Start,$Per_Page){
?>
	<td align="center" width="50%" valign="top">
		<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">

			<tr>
				<td class="tline" width="50">รหัส</td>
				<td class="tline">ชื่อยา</td>
				<td class="tline" width="30">หน่วย</td>
				<td class="tline" width="30">ราคา</td>
				<td class="tline" width="30">ในCom</td>
				<td class="tline" width="30">นับจริง</td>
				<td class="tr" width="40">ขาดเกิน</td>
			</tr>
			<? 
			$branch_id = $_SESSION['branch_id'];
			$company_code = $_SESSION['company_code'];
			$company_data = $_SESSION['company_data'];
			$where_user = set_where_user_data('', $branch_id, $company_code, $company_data);

			$n = 1;
			$sql = "select did,tname,total,unit,sprice,status from tb_druge where status = 'IN'  order by dgid,tname asc  LIMIT $Page_Start , $Per_Page";
			$str = mysql_query($sql);			
			while($rs = mysql_fetch_array($str)){
			

				$did = $rs['did'];
				$sql1 = "select sum(total) as total from tb_drugeinstock where did = '$did' and total > 0 and branchid = '$branch_id' "  . $where_user['where_company_code'];
				// echo $sql1;exit();
				$rst = mysql_query($sql1) or die ("Error Query [".$sql1."]");
				$num  = mysql_num_rows($rst);
				$dtotal = 0;
				if(!empty($num)){
					$rss = mysql_fetch_array($rst);
					$dtotal = $rss['total'];
				}

			?>
			<tr>
				<td class="tlineD" width="50"><?= $rs['did'] ?></td>
				<td class="tlineD" style="text-align:left">&nbsp;<?= $rs['tname'] ?></td>
				<td class="tlineD" width="30" style="text-align:left"><?= $rs['unit'] ?></td>
				<td class="tlineD" width="30" style="text-align:right"><?= $rs['sprice'] ?>&nbsp;</td>
				<td class="tlineD" width="30" style="text-align:right"><?= $rss['total'] ?>&nbsp;</td>
				<td class="tlineD" width="30">&nbsp;</td>
				<td class="trD" width="40">&nbsp;</td>
			</tr>
			<? 
			$n++ ; } 			
			?>

		</table>
	</td>
	<?
}
function showEmpty(){
?>
	<td align="center" width="50%" valign="top">&nbsp;</td>
	<?
}
?>
</body>

</html>