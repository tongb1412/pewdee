<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? include('../class/config.php'); ?>

<div style="width:99%; height:auto;  text-align:left; padding-left:5px;">
	<div style="left: 35%;top: 15.1%;margin: 0.5% 0.5% 0.5% 0.5%">
		<?php
			if($_SESSION['company_data'] == "1"){
				if ($_SESSION['branch_id'] != "") {
					$branch_id = $_SESSION['branch_id'];
					$sql = "";
					if ($branch_id == "00" || $branch_id == "07") {
						$sql = "select * from tb_branch order by branchid";
					} else {
						$sql = "select * from tb_branch where branchid = '$branch_id' order by branchid";
					}
					$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
					$Num_Rows = mysql_num_rows($result);
				?>
					<span>
						สาขา
						&nbsp;
					</span>
					<select name="sel_branchid_ptt_sys" id="sel_branchid_ptt_sys" onchange="serchsel('register/patientinsys_list.php','p_list',this)">
						<?php
						if ($Num_Rows > 0) {
							$flag = 0;
							if ($branch_id == "00" || $branch_id == "07") {
						?>
								<option value="00">ทั้งหมด</option>
								<?php
							} 
							while ($rs = mysql_fetch_array($result)) {
								if($branch_id == $rs['branchid']){
									?>
									<option value="<?php echo $rs['branchid'] ?>" selected><?php echo $rs['branchname'];?></option>
									<?php
								}
								else{
									?>
									<option value="<?php echo $rs['branchid'] ?>"><?php echo $rs['branchname'];?></option>
								<?php
								}
							}
						}
						?>
					</select>
				<?php
					
					// ajaxLoad('get','stock/druge_list.php','txt=','p_list');
				} 
			}
		?>

	</div>
</div>

<div style="width:99%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
    <div style="width:20%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;VN</div>
	<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัสคนไข้</div>
	<div style="width:30%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ - สกุล</div>
	<div style="width:25%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพทย์ผู้ตรวจ</div>
	<div style="width:10%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;สถานะ</div>
</div>
<div id="p_list" style=" width:100%; margin-top:5px; text-align:center; height:auto;">
	<?php  require("patientinsys_list.php");	 ?>
</div>
