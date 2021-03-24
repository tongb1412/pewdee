<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <div id="t_main" class="tmain" style="width:100%; margin:auto; height:495px; overflow:hidden;  "> -->
<div id="t_main_monthly" class="tmain h-100">
	<?php 
        if ($_SESSION['company_data'] == "1" ) {
          ?>

          <div class="littleDD" style="width:24%; float:left;text-align:right; line-height:20px; font-size:14px;"></div>
          <div class="littleDD" style="width:40%; float:left;font-weight:bold;text-align:center; line-height:20px; font-size:14px;">ยานอกระบบ</div>
          <div class="littleDD" style="width:10%; float:left;text-align:right; line-height:20px; font-size:14px;">เลือกสาขา : </div>
        
          <div class="littleDD" style="width:20%; float:left;">&nbsp;&nbsp;
          <?php
            $sql = "select branchid,branchname from tb_branch ";
          $result = mysql_query($sql) or die("Error Query [".$sql."]"); ?>
          <select name="select" id="branchid" style="width:117px;height: 21px;" onchange="mdrug2('daily_report/din_list.php','d_list')">
            <option value="00">ทั้งหมด</option>
            <?php while ($rs=mysql_fetch_array($result)) {  ?>
            <option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
            <?php } ?>
          </select>
          </div>

	<?php
        }else { 
			echo '<div class="littleDD" style="font-size:14px; font-weight:bold;">ยานอกระบบ </div>';
			echo " <input type='hidden' id='branchid' value ='' />";
        }
	?>   

	<div style="width:47%; height:90%;  float:left; margin-left:10px; margin-top:10px; margin-right:10px;  border:<?= $tabcolor ?> 1px solid;">
		<div class="littleDD" style="font-size:14px; font-weight:bold; background:<?= $tabcolor ?>;">ยาในระบบ</div>
		<div id="content" style=" width:100%; margin-top:5px; text-align:center; height:auto;">

			<div class="txt_serch">
				<input class="input_serch" type="text" id="txts" size="41" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('daily_report/din_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','stock/druge_list.php','txt=','p_list')" />
			</div>

			<div style="width:99%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
				<div style="width:25%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัสยา</div>
				<div style="width:40%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>

			</div>
			<div id="p_list" style=" width:95%; margin-top:5px; text-align:center; height:auto;">
				<?  require("din_list.php");	 ?>
			</div>

		</div>
	</div>






	<div style="width:47%; height:90%;  float:left; margin-left:5px; margin-top:10px;  margin-right:10px; border:<?= $tabcolor ?> 1px solid;">
		<div class="littleDD" style="font-size:14px; font-weight:bold; background:<?= $tabcolor ?>;">ยานอกระบบ</div>
		<div id="content1" style=" width:100%; margin-top:5px; text-align:center; height:auto;">

			<div class="txt_serch">
				<input class="input_serch" type="text" id="txts" size="41" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('daily_report/dout_list.php','p_list1',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','stock/druge_list.php','txt=','p_list')" />
			</div>

			<div style="width:99%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
				<div style="width:25%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัสยา</div>
				<div style="width:40%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>

			</div>
			<div id="p_list1" style=" width:95%; margin-top:5px; text-align:center; height:auto;">
				<?  require("dout_list.php");	 ?>
			</div>

		</div>
	</div>
</div>