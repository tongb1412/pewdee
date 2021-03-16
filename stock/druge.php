<?php 
session_start();
include('../class/config.php');
include('../class/permission_user.php');

$where_user_data = set_where_user_data('',$_SESSION['branch_id'], $_SESSION['company_code'], $_SESSION['company_data']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="branch_id_val" name="branch_id_val" value="<?php echo $_SESSION['branch_id'] ?>" />
<div style="width: 99%; display:inline-flex;">
<div style="width:35%; height:30px; text-align:left; padding-left:5px;">
	<div class="txt_serch">
		<input class="input_serch" type="text" id="txts" size="41" value="" placeholder="ค้นหา" onkeyup="serchtxtStock('stock/druge_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="serchtxtStock('stock/druge_list.php','p_list',this)" />
	</div>
</div>
<div style="width: 49%; height: auto; text-align: left;padding-left: 5px;">
		<?php
		if($_SESSION['company_data'] == "1"){
			if ($_SESSION['branch_id'] != "") {
				$branch_id = $_SESSION['branch_id'];
				include('../class/config.php');
				$sql = "";
				$sql = "select * from tb_branch where (branchid IS NOT NULL and branchid != '') " . $where_user_data['where_company_code'] . " order by branchid";
				$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
				$Num_Rows = mysql_num_rows($result);
			?>
				<span>
					สาขา
					&nbsp;
				</span>
				<select name="sel_branchid_stock" id="sel_branchid_stock" onchange="serchsel('stock/druge_list.php','p_list',this)">
					<?php
					if ($Num_Rows > 0) {
						$flag = 0;
					?>
							<option value="00">ทั้งหมด</option>
							<?php
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
				mysql_close($dblink);
				// ajaxLoad('get','stock/druge_list.php','txt=','p_list');
			} 
		}
		?>
	</div>
</div>


<?php
if ($_SESSION['company_data'] == "1") {
?>
	<div style="width:99%; height:20px; margin-top:15px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
		<div style="width:15%;text-align:left; float:left; line-height:20px;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:30%;text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
		<div style="width:14%;text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;กลุ่มยา</div>
		<div style="width:15%;  text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ(ทั้งหมด)</div>
		<div style="width:14%;  text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ(สาขา)</div>
		<div style="width:10%;  text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
		<!-- <div style="width:10%;text-align:left; float:left; line-height:20px;">&nbsp;</div> -->
	</div>
<?php
} else {
	?>
	<div style="width:99%; height:20px; margin-top:15px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
		<div style="width:15%;text-align:left; float:left; line-height:20px;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:30%;text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
		<div style="width:20%;text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;กลุ่มยา</div>
		<div style="width:10%;  text-align:left; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
		<div style="width:15%;  text-align:center; float:left; line-height:20px;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
		<div style="width:10%;text-align:left; float:left; line-height:20px;">&nbsp;</div>
	</div>
<?php
}
?>



<div id="p_list" style=" width:100%; margin-top:5px; text-align:center; height:auto;">
	<?php  
	
	require("druge_list.php");	 
	
	?>

</div>