<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="id"  value="">
<!-- <div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;"> -->
<div id="t_main_monthly" class="tmain h-100">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานการจ่ายยาประจำวัน</div>
  <?php
		$css_height = "10";
		$margin_left = "";
		if ($_SESSION['company_data'] == "1") {
		$css_height = "18";
		$margin_left = "margin-left:55px;"; 
		}
	?>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:<?=$css_height?>%; background-color:#FFCC99; overflow:auto; border:<?=$tabcolor?> 1px solid;">
    <div class="line" style="margin-top:5px">
      <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่  : </div>
      <div style="width:20%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?= date('d/m/Y');?>
      </div>
		  <div style="width:17%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">เลือกยา : </div>
		  <?
				$sql = "select * from tb_druge where status='IN' order by did ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
      ?>
      <div style="width:22%; float:left; margin-top:10px; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
        <select name="select" id="empid" style="width:140px;">
		    <option value="">ทั้งหมด</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['did']?>"> <?=$rs['tname']?></option>
          <? } ?>
        </select>
      </div>

      <div style="width:30%; float:left; margin-top:9px;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="loadmodule('d_list','daily_report/redrugerec_list.php','did='+document.getElementById('empid').value)" value=" แสดงรายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printdrec()" value=" พิมพ์รายงาน " />
      </div>
    </div>
    <?php 
      if ($_SESSION['company_data'] == "1" ) {
        ?>
        <div style="width:10%; float:left; margin-top:16px;margin-left:34px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">เลือกสาขา : </div>
      
        <div style="width:20%; float:left; margin-top:16px;  ">&nbsp;&nbsp;
        <?php
          $sql = "select branchid,branchname from tb_branch ";
        $result = mysql_query($sql) or die("Error Query [".$sql."]"); ?>
        <select name="select" id="branchid" style="width:117px;height: 21px;">
          <option value="00">ทั้งหมด</option>
          <?php while ($rs=mysql_fetch_array($result)) {  ?>
          <option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
          <?php } ?>
        </select>
        </div>
    <?php
      }else { 
        echo " <input type='hidden' id='branchid' value ='' />";
      }
    ?>      
  </div>
  <div   style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?=$tabcolor?> 1px solid;">


	
    <div id="d_list" style=" width: 98%; margin-top:5px; text-align:center; height:290px; ">
      <?  require("redrugerec_list.php");	 ?>
    </div>
	
  </div>
</div>
