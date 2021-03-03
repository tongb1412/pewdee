<?
include('../class/config.php');






?>

<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;">Stock Card</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:15%;  border:<?= $tabcolor ?> 1px solid; background-color: #FFD1A4;">

    <div class="line" style="margin-top:5px; width:60%;">

      <div style="width:15%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">วันที่ : </div>
      <div style="width:20%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="6.5" maxlength="10" value="<?= $dat ?>" /></div>
      <div style="width:3%; float:left; margin-top:10px;">
        <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
        <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
      </div>

      <div style="width:8%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">ถึง : </div>
      <div style="width:20%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="6.5" maxlength="10" value="<?= $dat ?>" /></div>
      <div style="width:3%; float:left; margin-top:10px;">
        <img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
        <div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
      </div>

      <div style="width:14%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">เลือกยา : </div>

      <?
				$sql = "select * from tb_druge where status='IN'  ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>

      <div style="width:15%; float:left; margin-top:10px; font-size:14px; ">
        <select name="select" id="repempid" style="width:70px;">
          <option value="">ทั้งหมด</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?= $rs['did'] ?>"> <?= $rs['tname'] ?></option>
          <? } ?>
        </select>


      </div>



    </div>

    <div style="width:25%; float:left;margin-top:10px;">






      <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthpayment('Monthly_report/rep_stockcard.php?')" value=" พิมพ์รายงาน " />
      <input type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printmonthpayment('Monthly_report/rep_stockcard_excel.php?')" value=" Excel" />

    </div>
  </div>

  <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">





  </div>


</div>