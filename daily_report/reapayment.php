<?php
  include('../class/config.php');
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<!-- <div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;"> -->
<div id="t_main_monthly" class="tmain h-100">
  <div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานคนไข้ค้างชำระ</div>
  <?php
  if ($_SESSION['company_data'] == "1") {
  ?>
    <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
      <div class="line" style="margin-top:5px">
        <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่ : </div>
        <div style="width:20%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?= date('d/m/Y'); ?>
        </div>
        <div style="width:15%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">เลือกสาขา : </div>
        <div style="width:20%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?php
          $sql = "select branchid,branchname from tb_branch ";
          $result = mysql_query($sql) or die("Error Query [" . $sql . "]"); ?>
          <select name="select" id="branchid" style="width:117px;">
            <option value="00">ทั้งหมด</option>
            <?php while ($rs = mysql_fetch_array($result)) {  
              if($rs['branchid'] == $_SESSION['branch_id']){
                ?>
                <option value="<?= $rs['branchid'] ?>" selected> <?= $rs['branchname'] ?></option>
                <?php
              } else {
                ?>
                <option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
                <?php
              }
              ?>
              
            <?php } ?>
          </select>
        </div>
        <div style="width:30%; float:left; margin-top: 0.9%;">
          <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="showReapayment()" value=" แสดงรายงาน " />
          <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printapayment()" value="  พิมพ์รายงาน  " />
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; overflow:auto; border:<?= $tabcolor ?> 1px solid; background-color: #FFD1A4;">
      <div class="line" style="margin-top:5px">
        <div style="width:20%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่่ : </div>
        <div style="width:30%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?= date('d/m/Y', time()); ?>
        </div>
        <div style="width:30%; float:left; margin-top: 0.9%;">
          <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printapayment()" value="  พิมพ์รายงาน  " />
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <div style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?= $tabcolor ?> 1px solid;">
    <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
      <?  require("reapayment_list.php");	 ?>
    </div>
  </div>
</div>