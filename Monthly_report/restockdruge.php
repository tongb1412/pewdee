<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main_monthly" class="tmain h-100">
  <div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานยา</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
    <div class="line" style="margin-top:5px; width:50%;">

      <div class="line-item title">เลือกยา : </div>
      <?
				$sql = "select * from tb_druge where status='IN'  ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>

      <div class="line-item">
        <select name="select" id="repempid" style="width:90px;">
          <option value="">ทั้งหมด</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?= $rs['did'] ?>"> <?= $rs['tname'] ?></option>
          <? } ?>
        </select>
      </div>

      <?php
      if ($_SESSION['company_data'] == "1") {
      ?>
        <div class="line-item title">เลือกสาขา : </div>
        <div class="line-item">
          <?php
          $sql = "select branchid,branchname from tb_branch ";
          $result = mysql_query($sql) or die("Error Query [" . $sql . "]");
          ?>
          <select name="select" id="branchid" style="width:117px;">
            <option value="00">ทั้งหมด</option>
            <?php while ($rs = mysql_fetch_array($result)) {  ?>
              <option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
            <?php } ?>
          </select>
        </div>
      <?php
      }
      ?>
    </div>
    <div style="width:50%; float:left;margin-top:10px;">
      <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mdrug('Monthly_report/restockdruge_list.php','d_list')" value="แสดงรายงาน" />
      <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printdrug('Monthly_report/re_stockdruge.php?')" value="พิมพ์รายงาน" />
      <?php
        if($_SESSION['company_data'] == "1"){
          ?>
          <a href="Monthly_report/Rep_Druge_Total.csv" target="_blank">Export File To Excel (ทุกสาขา)</a>
          <?php
        }
      ?>
    </div>
  </div>
  <div style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?= $tabcolor ?> 1px solid;">

    <div id="d_list" style=" width: 100%; margin-top:5px;  text-align:center; height:310px; ">
      <?  require("restockdruge_list.php");	 ?>
    </div>

  </div>
</div>