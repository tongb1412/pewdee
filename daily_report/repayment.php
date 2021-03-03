<?
include('../class/config.php');



?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;">รายงานรายได้ทั้งหมด</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
    <div class="line" style="margin-top:5px">
      <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่ : </div>
      <div style="width:20%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
        <?= date('d/m/Y'); ?>
      </div>
      <div style="width:15%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">เลือกแพทย์ : </div>

      <?
				$sql = "select staffid,pname,fname from tb_staff where typ='D' ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>

      <div style="width:20%; float:left; margin-top:1%; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
        <select name="select" id="repempid" style="width:117px;">
          <option value="">ทั้งหมด</option>
          <option value="00">ไม่ระบุแพทย์</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?= $rs['staffid'] ?>"> <?= $rs['pname'] . $rs['fname'] ?></option>
          <? } ?>
        </select>
      </div>
      <div style="width:30%; float:left; margin-top: 0.9%;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="showpayment();" value=" แสดงรายงาน " />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" value=" พิมพ์รายงาน " onclick="printpaytotal()" />
      </div>
    </div>
  </div>
  <div style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?= $tabcolor ?> 1px solid;">



    <div id="d_list" style=" width: 98%; margin-top:5px; text-align:center; height:290px; ">
      <?  require("repayment_list.php");	 ?>


    </div>



  </div>



</div>