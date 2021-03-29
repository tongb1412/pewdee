<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');

//$vn = $_GET['mode'];
$hn = $_POST['hn'];

/*
$sql = "select * from tb_patient,tb_vst where tb_patient.hn=tb_vst.hn and  tb_vst.vn='$vn'";
$str = mysql_query($sql) or die ("Error Query ".$sql); 
$row=mysql_fetch_array($str);
$hn = $row['hn'];

*/

?>

<div style="width:99%; margin:auto;  height:25px; display:none;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
		<img src="images/icon/group.png" align="absmiddle" />&nbsp;ประวัติทรีทเม้นท์
	</div>

</div>
<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
	<div class="littleDD" style="font-size:18px; font-weight:bold; height:50px;">
		<div style="width:30%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ : <?= $hn; ?></div>
		<div style="width:65%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;"><?= $row['pname'] . $row['fname'] . '    ' . $row['lname']; ?></div>
	</div>
	<div style="width:100%; height:auto; margin-top:10px; text-align:left;">
		<div style="width:47%; margin-left:15px; margin-right:10px; float:left; height:auto;">
			<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
				ประวัติการซื้อทรีทเม้นท์
			</div>
			<div style="width:99%; height:382px; float:left; border:#CCCCCC 1px solid;">
				<div class="line" style="height:25px; line-height:20px; margin-top:5px;">
					<div style="width:10%; float:left; text-align:right; line-height:20px; font-weight:bold;">วันที่ :&nbsp;</div>
					<div style="width:70%; float:left; text-align:left; line-height:20px;">
						<select id="sdate" onchange="loadmodule('p_list','doctor/dochis_spct.php','hn=<?= $hn ?>&dat='+this.value)">
							<?php
				if($_SESSION['cross_branch_data'] == "1") {
					$where_branch_id = "";
				} else {
					$branch_id = $_SESSION['branch_id'];
					$company_data = $_SESSION['company_data'];
					$company_code = $_SESSION['company_code'];
					$where_data = set_where_user_data("a", $branch_id, $company_code, $company_code);
					$where_branch_id .= $where_data['where_branch_id'];
					$where_branch_id .= $where_data['where_company_code'];
				}

				$sql = "select DISTINCT(a.dat),a.dat from tb_pctrec a,tb_vst b where a.vn=b.vn and b.status='COM' and a.hn='$hn' order by a.dat asc";
				$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				$n = mysql_num_rows($str);
				if($n){
				$dat = '00';
				?>
							<option value="00">แสดงทั้งหมด</option>
							<? while($rs=mysql_fetch_array($str)){ ?>
							<option value="<?= $rs['dat'] ?>"><?= $rs['dat'] ?></option>
							<? } } else { 
				$dat='-';
				?>
							<option value="-">ไม่พบประวัติการซื้อ</option>
							<? } ?>
						</select>
					</div>
				</div>
				<div style="width:98%; height:20px;padding-top:5px;margin-left:5px; color:#000000; font-weight:bold; float:left; font-size:13px;background:<?= $tabcolor ?>;">
					<div style="width:20%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
					<div style="width:30%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
					<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จน.ซื้อ</div>
					<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคา</div>
					<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
				</div>
				<div id="p_list" style=" width:99%; margin-left:5px; float:left; height:320px; overflow:auto;">
					<? include('dochis_spct.php'); ?>


				</div>
			</div>
		</div>
		<div style="width:48%; margin-left:10px; margin-right:10px; float:left; height:auto;">
			<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
				รายละเอียด
			</div>
			<div style="width:99%; height:382px; float:left; border:#CCCCCC 1px solid;  ">
				<div id="d_list" style=" width:99%; margin-left:5px; float:left; height:350px; overflow:auto;">
				</div>
			</div>
		</div>
	</div>
</div>



</div>