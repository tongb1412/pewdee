<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="id"  value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
	  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานยา</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; overflow:auto; border:<?=$tabcolor?> 1px solid;">
	 <div class="line" style="margin-top:5px; width:50%;">

		<div style="width:20%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">เลือกยา : </div>
		 <?
				$sql = "select * from tb_druge where status='IN'  ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
	  
      <div style="width:80%; float:left; margin-top:10px;  font-size:14px; ">&nbsp;&nbsp;
        <select name="select" id="repempid" style="width:90px;">
		  <option value="">ทั้งหมด</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['did']?>"> <?=$rs['tname']?></option>
          <? } ?>
        </select>
      </div>
     </div>

	 <div style="width:50%; float:left;margin-top:10px;">
	  <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="mdrug('Monthly_report/restockdruge_list.php','d_list')" value="แสดงรายงาน" />
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printdrug('Monthly_report/re_stockdruge.php?')" value="พิมพ์รายงาน" />
		<a href="Monthly_report/Rep_Druge_Total.csv" target="_blank">Export File To Excel</a>
      </div>
    </div>
  <div   style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?=$tabcolor?> 1px solid;">


	
    <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
      <?  require("restockdruge_list.php");	 ?>
    </div>
	
  </div>
</div>
