<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['vn'];

$sql = "select * from tb_patient where tb_patient.hn='$hn'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);
$total = 0;

$pt = $row['level'];
$vn = $row['vn'];

$sql5 = "select disdrug from tb_level where velname like '%$pt%' ";
$str5 = mysql_query($sql5) or die ("Error Query [".$sql5."]"); 
$rs5=mysql_fetch_array($str5);
$dis = $rs5['disdrug'];

$sql = "select qty,price from tb_drugerec where vn='$vn'";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
while($rs=mysql_fetch_array($str)){
	$total = $total + ($rs['price'] * $rs['qty']);
	$hn = $row['hn']; 
}
$sum = $total;
$discount =  ($total * $dis) / 100;
$total = $total - $discount;


?>
<div style="width:99%; margin:auto; height:25px; float:left;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left;">
	<img src="images/icon/group.png" align="absmiddle" />&nbsp;ชำระเงิน
	</div>
	<div style="width:80%; text-align:right; float:left;">
	<input type="button" value="  ซื้อยาเพิ่ม " onclick="loadmodule('home','register/sale_druge.php','hn=<?=$hn?>')" style="height:25px; font-size:13px; line-height:25px;" />
	<input type="button"  value="  ยกเลิกรายการ " onclick="loadmodule('home','register/register.php','vn=<?=$vn?>&hn=<?=$hn?>')"  style="height:25px; font-size:13px; line-height:25px;" />	
	</div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; height:500px; overflow:hidden; float:left;">
  <div class="littleDD" style="font-size:25px; font-weight:bold; height:50px;" >
    <div style="width:30%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ :
      <?=$row['hn']; ?>
    </div>
    <div style="width:65%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;">
      <?=$row['pname'].$row['fname'].'    '.$row['lname']; ?>
    </div>
  </div>
  <div style="width:100%; height:auto; margin-top:10px; text-align:left;">
    <input  type="hidden" id="hn" value="<?=$row['hn']?>" />
    <input  type="hidden" id="vn" value="<?=$vn?>" />
    <input  type="hidden" id="mode" value="P"  />
    <div class="line" style="height:30px; line-height:30px;  font-size:20px;">
      <div style="width:10%; float:left; text-align:right; line-height:30px; ">ค่ายา :&nbsp;</div>
      <div style="width:20%; float:left; text-align:left; line-height:30px;">
        <input name="text" type="text" id="total" style="text-align:right; font-size:18px;" value="<?=number_format($sum,'0','.',',')?>" size="10" readonly="true"  />
        &nbsp;&nbsp;บาท </div>
      <div style="width:10%; float:left; text-align:right; line-height:30px; ">ส่วนลด :&nbsp;</div>
      <div style="width:25%; float:left; text-align:left; line-height:30px;">
	    <input type="text" id="pndis" style="text-align:right; font-size:18px; width:30px;" value="0"  onkeyup="caldisper(this,<?=$discount?>,<?=$total?>)" />%&nbsp;
        <input name="text" type="text" id="discount" style="text-align:right; font-size:18px;" onkeyup="changediscount()" value="<?=number_format($discount,'0','.',',')?>" size="10"  />
        &nbsp;&nbsp;บาท </div>
      <div style="width:15%; float:left; text-align:right; line-height:30px; ">รวมทั้งหมด :&nbsp;</div>
      <div style="width:20%; float:left; text-align:left; line-height:30px;">
        <input name="text" type="text" id="sum" style="text-align:right; font-size:18px;" value="<?=number_format($total,'0','.',',')?>" size="10"   readonly="true" />
        &nbsp;&nbsp;บาท </div>
    </div>
    <div class="line" style="height:30px; line-height:30px; margin-top:30px;  font-size:18px;">
      <div style="width:40%; float:left; text-align:right; line-height:30px; ">เงินสด :&nbsp;</div>
      <div style="width:60%; float:left; text-align:left; line-height:30px;">
        <input name="text" type="text" id="cash" style="text-align:right; font-size:18px;" onkeyup="changemoney(1)" value="<?=number_format($total,'0','.',',')?>" size="10"  />
        &nbsp;&nbsp;บาท </div>
    </div>
    <div class="line" style="height:30px; line-height:30px; margin-top:10px;  font-size:18px;">
      <div style="width:40%; float:left; text-align:right; line-height:30px; ">บัตรเครดิต :&nbsp;</div>
      <div style="width:60%; float:left; text-align:left; line-height:30px;">
        <input name="text" type="text" id="credit" style="text-align:right; font-size:18px;" onkeyup="changemoney(2)" value="0" size="10" />
        &nbsp;&nbsp;บาท </div>
    </div>
    <?
	$sql = "select * from tb_gernaral where typ='BK'";
	$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	
	?>
    <div class="line" style="height:30px; line-height:30px; margin-top:5px;  font-size:18px;">
      <div style="width:40%; float:left; text-align:right; line-height:30px; ">ธนาคาร :&nbsp;</div>
      <div style="width:60%; float:left; text-align:left; line-height:30px;">
        <select name="select" id="bank" style="font-size:18px; width:200px;">
          <option value=""></option>
          <? while($rs=mysql_fetch_array($str)){ ?>
          <option value="<?=$rs['name']?>">
            <?=$rs['name']?>
          </option>
          <? } ?>
        </select>
      </div>
    </div>

    <div class="line" style="height:30px; line-height:30px; margin-top:5px;  font-size:18px; ">
      <div style="width:40%; float:left; text-align:right; line-height:30px; display:none; ">เลขบัตร :&nbsp;</div>
      <div style="width:60%; float:left; text-align:left; line-height:30px;">
		<input type="hidden" id="ctype" style="font-size:18px; width:200px;" />
      </div>
    </div>


	<div class="line" style="height:30px; line-height:30px;  font-size:18px; ">
			  <div style="width:40%; float:left; text-align:right; line-height:30px; ">
              <select id="ktype">
              <option value="K">คูปอง</option>
              <option value="B">โอนเงิน</option>
              <option value="P">ไปรษณีย์</option>
              </select>  :&nbsp;
              </div>
			  <div style="width:60%; float:left; text-align:left; line-height:30px;">
				<input name="kupong" type="text" id="kupong" style="text-align:right; font-size:18px;" onkeyup="changemoney(3)"  size="10" />
				&nbsp;&nbsp;บาท 
				</div>
	</div>
	<div class="line" style="height:30px; line-height:30px; margin-top:5px; font-size:18px; ">
			  <div style="width:40%; float:left; text-align:right; line-height:30px; ">หมายเลข :&nbsp;</div>
			  <div style="width:60%; float:left; text-align:left; line-height:30px;">
				<input name="text" type="text" id="kno" style="font-size:18px; width:200px;"  />	
				</div>
	</div>		
	<?
	$sql = "select staffid,pname,fname,lname from tb_staff  ";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	?>

	<div class="line" style="height:30px; line-height:30px; margin-top:10px; font-size:18px; ">
			  <div style="width:40%; float:left; text-align:right; line-height:30px; ">ผู้ขาย :&nbsp;</div>
			  <div style="width:60%; float:left; text-align:left; line-height:30px;">
                <select name="empid" id="empid" style="width:200px;">           
                  <option value="00">เลือกผู้ขาย</option>
                  <? while($rs=mysql_fetch_array($result)){  ?>
                  <option value="<?=$rs['staffid']?>"> <?=$rs['fname'].'   '.$rs['lname']?></option>
                  <? } ?>
                </select>	
				</div>
	</div>
	
	
    <div class="line" style="height:30px; line-height:30px; margin-top:20px; color:#FF0000 ; font-weight:bold;  font-size:20px;">
      <div style="width:40%; float:left; text-align:right; line-height:30px; "><span id="ptxt"></span>&nbsp;</div>
      <div style="width:60%; float:left; text-align:left; line-height:30px;">
        <input name="hidden2" type="hidden" id="rmoney"  value="0" size="10" readonly="true" />
        <span id="rtxt"></span>&nbsp;</div>
    </div>
    <div class="line" style="height:30px; line-height:30px; margin-top:30px;  font-size:18px;">
      <div style="width:40%; float:left; text-align:right; line-height:30px; ">&nbsp;</div>
      <div style="width:60%; float:left; text-align:left; line-height:30px;">
        <input name="button" type="button" style="font-size:14px; font-weight:bold; height:35px; " onclick="addsdpayment('register/add_payment.php','home')" value="  ชำระเงิน  " />
      </div>
    </div>
  </div>
</div>
