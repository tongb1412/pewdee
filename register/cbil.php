<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$sql = "select pdate from tb_payment  where vn='$vn'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$rs=mysql_fetch_array($result);
?>

<div style="width:100%; height:40px; line-height:40px; font-size:18px; background:#f5fffa; border-bottom:#CCCCCC 1px dotted;">
	<div style="width:40%; text-align:right; float:left;">ยกเลิกใบเสร็จ</div>

</div>
<input type="hidden" id="cvn" value="<?=$vn?>" />

<?
if(substr($rs['pdate'],0,10) == date('Y-m-d') ){
?>
<div style="width:100%; height:100px;">
	<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
		<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">ผู้ยกเลิก : &nbsp;</div>
		<div style="width:75%; float:left; line-height:30px; height:30px;">
        <input type="text" id="empid" size="45" />
		<!--<select id="empid" style="width:300px; font-size:16px;">
		<?
		$sql = "select * from tb_staff where typ<>'D' order by fname  ";
		$result = mysql_query($sql) or die ("Error Query [".$sql."]");
		while($rs=mysql_fetch_array($result)){
		?>
		<option value="<?=$rs['staffid']?>"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></option>
		<? } ?>
		</select>-->&nbsp;
		</div>
    </div>

	<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
		<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">ผู้ตรวจสอบ : &nbsp;</div>
		<div style="width:75%; float:left; line-height:30px; height:30px;">
		<input type="text" id="pname" size="45" />&nbsp;

		</div>
    </div>


	<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
		<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">หมายเหตุ : &nbsp;</div>
		<div style="width:75%; float:left; line-height:30px; height:30px;">
		<input type="text" id="pmem" size="45" />&nbsp;
		</div>
    </div>



</div>
<div style="width:100%; height:49px; text-align:right;">
	<input type="button" value="  ตกลง  " style="font-size:14px; font-weight:bold; height:35px;" onclick="cbil('<?=$vn ?>')" />&nbsp;
	<input type="button" value="  ยกเลิก  "  style="font-size:14px; font-weight:bold; height:35px;" onclick="cancelsend()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<? } else { ?>
<div style="width:100%; height:100px; color:red; text-align:center;">
	<h1>ยกเลิกบิลข้ามวันไม่ได้</h1>
</div>
<div style="width:100%; height:49px; text-align:right;">
	<input type="button" value="  ยกเลิก  "  style="font-size:14px; font-weight:bold; height:35px;" onclick="cancelsend()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<? } ?>
