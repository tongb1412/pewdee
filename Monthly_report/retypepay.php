<?php
include('../class/config.php');


$branch_id = "";
if (!empty($_SESSION['branch_id'])) {
  $branch_id = $_SESSION['branch_id'];
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main_monthly" class="tmain h-100">
  <div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานรายได้แยกตามการชำระ</div>
  <?php
  if ($_SESSION['company_data'] == "1") {
  ?>
    <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:16%; border:<?= $tabcolor ?> 1px solid; background-color: #FFD1A4;">
      <div class="line" style="margin-top:5px; width:95%;">
        <div class="line-item title">ระหว่างวันที่ : </div>
        <div class="line-item">&nbsp;<input type="text" id="sdate" size="9" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
        <div class="line-item">
          <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
          <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>

        <div class="line-item title">ถึง : </div>
        <div class="line-item">&nbsp;<input type="text" id="edate" size="9" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
        <div class="line-item">
          <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
          <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>
        <div class="line-item title">เลือกสาขา : </div>
        <div style="width:20%; float:left; margin-top:1%; font-size:14px; ">&nbsp;&nbsp;
          <?php
          $sql = "select branchid,branchname from tb_branch ";
          $result = mysql_query($sql) or die("Error Query [" . $sql . "]");
          ?>
          <select name="select" id="branchid" style="width:117px;" onchange="doctor_list(this)">
            <option value="00">ทั้งหมด</option>
            <?php while ($rs = mysql_fetch_array($result)) {  ?>
              <option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="line line-item" style="width:95%; float:left; margin-left:2%; margin-top:20px;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpatient('Monthly_report/retypepay_list.php','d_list')" value=" แสดงรายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonth('Monthly_report/re_typepay.php?')" value=" พิมพ์รายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value=" Excel " />
      </div>
    </div>
  <?php
  } else {
  ?>
    <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; border:<?= $tabcolor ?> 1px solid; background-color: #FFD1A4;">
      <div class="line" style="margin-top:5px; width:60%;">
        <div class="line-item title">ระหว่างวันที่ : </div>
        <div class="line-item">&nbsp;<input type="text" id="sdate" size="9" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
        <div class="line-item">
          <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
          <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>

        <div class="line-item title">ถึง : </div>
        <div class="line-item">&nbsp;<input type="text" id="edate" size="9" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
        <div class="line-item">
          <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
          <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>
      </div>
      <div style="width:40%; float:left;margin-top:10px;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mpatient('Monthly_report/retypepay_list.php','d_list')" value=" แสดงรายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonth('Monthly_report/re_typepay.php?')" value=" พิมพ์รายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="" value=" Excel " />
      </div>
    </div>
  <?php
  }
  ?>

  <div style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?= $tabcolor ?> 1px solid;">
    <div id="d_list" style=" width: 100%; margin-top:5px;  text-align:center; height:310px; ">
      <?  require("retypepay_list.php");	 ?>
    </div>
  </div>

</div>