<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
?>

<div style="width:100%; height:50px; line-height:50px; font-size:18px; background:#f5fffa; border-bottom:#CCCCCC 1px dotted;">
	<div style="width:40%; height:50px; line-height:50px; text-align:right; float:left;">พิมพ์ใบเสร็จย้อนหลัง</div>

</div>
<input type="hidden" id="vn" value="<?=$vn?>" />
<div style="width:100%; height:100px;">
	<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
		<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">ผู้พิมพ์ : &nbsp;</div>
		<div style="width:75%; float:left; line-height:30px; height:30px; padding-top:15px;">
		<select id="empid" style="width:330px; font-size:16px;">		
		<?
		$sql = "select * from tb_staff where typ<>'D' order by fname  ";
		$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		while($rs=mysql_fetch_array($result)){
		?>
		<option value="<?=$rs['staffid']?>"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></option>
		<? } ?>		
		</select>&nbsp;
		</div>
    </div>
	
	<div class="line" style="margin-top:10px; height:30px; font-size:16px;">
		<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">หมายเหตุ : &nbsp;</div>
		<div style="width:75%; float:left; line-height:30px; height:30px; padding-top:15px;">&nbsp;
		<input type="text" id="pmem" size="52" />

		</div>
    </div>	
	
	
	
</div>
<div style="width:100%; height:49px; text-align:right;">
	<input type="button" value="  พิมพ์ใบเสร็จ  " style="font-size:14px; font-weight:bold; height:35px;" onclick="preprint('<?=$vn ?>')" />&nbsp;
	<input type="button" value="  ยกเลิก  "  style="font-size:14px; font-weight:bold; height:35px;" onclick="cancelsend()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
