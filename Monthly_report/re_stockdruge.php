<?
include('../class/config.php');

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>รายงานยาทั้งหมด </title>
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
			<td align="center" class="txt1">รายงานยาทั้งหมด </td>
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
				<td class="tline" width="70">กลุ่มยา</td>
				<td class="tline" width="45">คงเหลือ</td>
				<td class="tr" width="45">หน่วย</td>
			</tr>
			<?php
			include('../class/config.php');

			$did = $_GET['did'];
			if(!empty($_REQUEST['branchid'])){
				$branch_id = $_REQUEST['branchid'];
			} else {
				$branch_id = $_SESSION['branch_id'];
			}
			$company_code = $_SESSION['company_code'];
			$company_data = $_SESSION['company_data'];

			$n = 1;
			$sql = "select did,tname,total,unit,sprice,status,dgroup from tb_druge where status = 'IN' order by dgroup,typname,tname asc  LIMIT $Page_Start , $Per_Page";
			$str = mysql_query($sql);			
			while($rs  = mysql_fetch_array($str)){
				$did = $rs['did'];
				if($branch_id == '00'){
					$sql1 = "select sum(total) as total from tb_drugeinstock where did='$did' and total > 0 and company_code = '$company_code' ";
				} else {
					$sql1 = "select sum(total) as total from tb_drugeinstock where did='$did' and total > 0 and branchid = '$branch_id' and company_code = '$company_code' ";
				}
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
					<td class="tlineD" width="70" style="text-align:left"><?= $rs['dgroup'] ?></td>
					<td class="tlineD" width="30" style="text-align:right"><?php if($company_data == "1"){ echo $rss['total']; } else { echo $rs['total']; } ?>&nbsp;</td>
					<td class="trD" width="45" style="text-align:left">&nbsp;<?= $rs['unit'] ?></td>
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