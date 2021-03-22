<?php
include('../class/config.php');
$branch_id = $_SESSION['branch_id'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main_monthly" class="tmain h-100">
  <div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานคูปอง</div>
  <?php
  if ($_SESSION['company_data'] == "1") {
  ?>
    <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:16%; background-color:#FFCC99; border:<?= $tabcolor ?> 1px solid;">
      <div class="line" style="margin-top:5px; width:100%;">
        <div class="line-item title">วันที่ : </div>
        <div class="line-item">&nbsp;<input type="text" id="sdate" size="6" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
        <div class="line-item">
          <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
          <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>

        <div class="line-item title">ถึง : </div>
        <div class="line-item">&nbsp;<input type="text" id="edate" size="6" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
        <div class="line-item">
          <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
          <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>
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
      </div>
      <div class="line" style="width:95%;float:left;margin-top:20px; margin-left:2%;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonth('Monthly_report/rep_ku.php?')" value=" พิมพ์รายงาน " />
        <input type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="repKU('Monthly_report/rep_ku_start.php','d_list')" value=" เตรียมข้อมูลของ Excel" />
      </div>
    </div>



  <?php
  } else {
    ?>
      <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:15%;  border:<?= $tabcolor ?> 1px solid; background-color: #FFD1A4;">

        <div class="line" style="margin-top:5px; width:60%;">

          <div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">ระหว่างวันที่ : </div>
          <div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="9.5" maxlength="10" value="<?= $dat ?>" /></div>
          <div style="width:3%; float:left; margin-top:10px;">
            <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
            <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
          </div>

          <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">ถึง : </div>
          <div style="width:25%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="9.5" maxlength="10" value="<?= $dat ?>" /></div>
          <div style="width:3%; float:left; margin-top:10px;">
            <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
            <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
          </div>

        </div>
        <div style="width:15%; float:left;margin-top:10px; line-height:15px; color:#FF0000;">
          ตัวอย่าง<br />
          01-02-2012
        </div>
        <div style="width:25%; float:left;margin-top:10px;">
          <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonth('Monthly_report/rep_ku.php?')" value=" พิมพ์รายงาน " />
          <input type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="repKU('Monthly_report/rep_ku_start.php','d_list')" value=" เตรียมข้อมูลของ Excel" />
        </div>
      </div>
  </div>
  
  <?php
  }

?>
  <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
    </div>