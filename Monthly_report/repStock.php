<?
include('../class/config.php');

?>
<div id="t_main_monthly" class="tmain h-100">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานยาคงคลัง</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%;  border:<?=$tabcolor?> 1px solid; background-color: #FFD1A4;">
    
	  <div class="line" style="margin-top:5px; width:95%;float:left;">
      <?php 
      if($_SESSION['company_data'] == "01"){
        ?>
        <div class="line-item title">เลือกสาขา : </div>
				<div class="line-item">
					<?php
					$sql = "select branchid,branchname from tb_branch ";
					$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
					?>
					<select name="select" id="branchid" style="width:100px;" onchange="sale_list(this)">
						<option value="00">ทั้งหมด</option>
						<?php while ($rs = mysql_fetch_array($result)) {  ?>
							<option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
						<?php } ?>
					</select>
				</div>


        <?php
      }
      ?>
        <div class="line-item">
					<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthD('Monthly_report/rep_stock.php?')" value=" พิมพ์รายงาน " />
          &nbsp;
          <input type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="repstock1('Monthly_report/rep_stock1.php?')" value=" Excel" />
				</div>

    </div>
</div>   

<div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
     
</div>	
