<?
include('../class/config.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="id"  value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานรายได้การขายแพ็คเกจ</div>
  <div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99; overflow:auto; border:<?=$tabcolor?> 1px solid;">
    <div class="line" style="margin-top:5px">
      <div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">วันที่้  : </div>
      <div style="width:20%; float:left; margin-top:10px; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
          <?= date('d/m/Y');?>
      </div>
	  <div style="width:14%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:16px; font-weight:bold;">เลือกผู้ขาย : </div>
	  
      <?
				$sql = "select staffid,pname,fname,nickname from tb_staff  ";
				$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				?>
	  
      <div style="width:21%; float:left; margin-top:10px; font-size:16px; font-weight:bold; ">&nbsp;&nbsp;
        <select name="select" id="empid" style="width:140px;">
		  <option value="">ทั้งหมด</option>
          <? while($rs=mysql_fetch_array($result)){  ?>
          <option value="<?=$rs['staffid']?>"> <?=$rs['pname'].$rs['fname'].'  ['.$rs['nickname'].']'?></option>
          <? } ?>
        </select>
      </div>
      <div style="width:30%; float:left; margin-top:9px;"  >
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="loadmodule('d_list','daily_report/resalepg_list.php','did='+document.getElementById('empid').value)" value=" แสดงรายงาน " />
		<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="printpg()" value=" พิมพ์รายงาน " />
      </div>
    </div>
  </div>
  <div   style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?=$tabcolor?> 1px solid;">


	
    <div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">
      <?  require("resalepg_list.php");	 ?>
    </div>
	
  </div>
</div>
