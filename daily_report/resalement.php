<?php
include('../class/config.php');
$branch_id = $_SESSION['branch_id'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main_monthly" class="tmain h-100">
  <div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานรายได้การขายทรีทเมนท์/เลเซอร์</div>
  <?php
  if ($_SESSION['company_data'] == "1") {
  ?>
    <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:16%; background-color:#FFCC99; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
      <div class="line" style="margin-top:5px">
        <div class="line-item title bold">วันที่่ : </div>
        <div class="line-item title sel bold">
          <?= date('d/m/Y'); ?>
        </div>
        <div class="line-item title bold" style="margin-left: 5%;">เลือกสาขา : </div>
        <div class="line-item title sel bold">
          <?php
          $sql = "select branchid,branchname from tb_branch ";
          $result = mysql_query($sql) or die("Error Query [" . $sql . "]"); ?>
          <select name="select" id="branchid" style="width:117px;" onchange="sale_list(this)">
            <option value="00">ทั้งหมด</option>
            <?php while ($rs = mysql_fetch_array($result)) {
              if ($rs['branchid'] == $_SESSION['branch_id']) {
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

        <div class="line-item title bold" style="margin-left: 5%;">เลือกผู้ขาย : </div>
        <?
				$sql = "select staffid,pname,fname,nickname from tb_staff where branchid = '$branch_id'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
        <div style="width:21%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <select name="select" id="empid" style="width:140px;">
            <option value="">ทั้งหมด</option>
            <? while($rs = mysql_fetch_array($result)){  ?>
            <option value="<?= $rs['staffid'] ?>"> <?= $rs['pname'] . $rs['fname'] ?></option>
            <? } ?>
          </select>
        </div>
        <div>

        </div>
      </div>
      <div class="line" style="width:30%; float:left; margin-top: 20px; margin-left:2%;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="showResalement()" value=" แสดงรายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printsalement()" value=" พิมพ์รายงาน " />
      </div>
    </div>

  <?php
  } else {
  ?>
    <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
      <div class="line" style="margin-top:5px">
        <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่่ : </div>
        <div style="width:20%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?= date('d/m/Y'); ?>
        </div>
        <div style="width:14%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">เลือกผู้ขาย : </div>
        <?
				$sql = "select staffid,pname,fname,nickname from tb_staff where branchid = '$branch_id'";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>

        <div style="width:21%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <select name="select" id="empid" style="width:140px;">
            <option value="">ทั้งหมด</option>
            <? while($rs=mysql_fetch_array($result)){  ?>
            <option value="<?= $rs['staffid'] ?>"> <?= $rs['pname'] . $rs['fname'] . '  [' . $rs['nickname'] . ']' ?></option>
            <? } ?>
          </select>
        </div>
        <div style="width:30%; float:left;" class="center-line">
          <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="loadmodule('d_list','daily_report/resalement_list.php','did='+document.getElementById('empid').value)" value=" แสดงรายงาน " />
          <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printsalement()" value=" พิมพ์รายงาน " />
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <div style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?= $tabcolor ?> 1px solid;">
    <div id="d_list" style=" width: 98%; margin-top:5px; text-align:center; height:290px; ">
      <?  require("resalement_list.php");	 ?>
    </div>
  </div>
</div>