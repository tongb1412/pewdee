<?php 
    include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; margin:auto; height:25px;">
    <div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
        <img src="images/icon/group.png" align="absmiddle" />&nbsp;ตรวจรักษา
    </div>
    <div style="width:78%; text-align:right; float:left;">

    </div>
</div>
<div id="main" class="main" style="width:99%; margin:auto;  height:500px; overflow:hidden;">
    <div class="littleDD">
        <div id="tab1" class="tab" style="width:150px; background-color:#FFFFFF; display:;  line-height:30px;">
        รอตรวจรักษา
        </div>
        <div id="tab2" class="tab" style="width:150px; background-color:#FFFFFF; display:none; line-height:20px;">
            <a href="javascript: doctorClick('F','doctor/doctor_form.php','content')">การรักษา</a>
        </div>
        <div id="tab3" class="tab" style="width:150px;  display:none; line-height:20px;">
            <a href="javascript: doctorClick('T','doctor/doctor_history.php','content')">ประวัติการซื้อทรีทเม้นท์</a>
        </div>
    </div>
    <div id="content" style=" width:100%; margin-top:5px; text-align:center; height:auto;">
        <div class="txt_serch" style="margin-left:5px; margin-top:5px;">
            <input class="input_serch" type="text" id="txts" size="41" value="" placeholder="ค้นหา" onkeyup="serchtxtDoctor('doctor/wait_list.php','wlist','')" /><input type="button" class="btn_serch" onclick="serchtxtDoctor('doctor/wait_list.php','wlist','')" />
        </div>
        <div style="position: absolute;left: 35%;top: 14.5%;">
		<?php
			if($_SESSION['company_data'] == "1"){
				if ($_SESSION['branch_id'] != "") {
					$branch_id = $_SESSION['branch_id'];
					$sql = "";
					$sql = "select * from tb_branch order by branchid";
					
					$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
					$Num_Rows = mysql_num_rows($result);
				?>
					<span>
						สาขา
						&nbsp;
					</span>
					<select name="sel_branch_id_doctor" id="sel_branch_id_doctor" onchange="serchtxtDoctor('doctor/wait_list.php','wlist',this)">
						<?php
						if ($Num_Rows > 0) {
							$flag = 0;
							if ($branch_id != "") {
						?>
								<!-- <option value="00">ทั้งหมด</option> -->
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
					// mysql_close($dblink);
					// ajaxLoad('get','stock/druge_list.php','txt=','p_list');
				} 
			}
		?>

	</div>
        <div id="wlist" style="width:100%; height:auto;">
            <?php  
                require("wait_list.php");	 
            ?>
        </div>
    </div>
</div>
