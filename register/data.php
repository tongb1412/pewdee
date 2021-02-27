<? include('../class/config.php');
	$select_id = $_GET["select_id"];
	$result = $_GET["result"];
?>

<? if($result=='amphur'){ ?>
	<option value="">เลือกอำเภอ</option>

<?
	$rstTemp=mysql_query("select * from amphur Where PROVINCE_ID ='".$select_id."' Order By AMPHUR_ID ASC");
	while($arr_2=mysql_fetch_array($rstTemp)){
?>
	<option value="<?=$arr_2['AMPHUR_ID']?>"><?=$arr_2['AMPHUR_NAME']?></option>
<? }}?>

<? if($result=='district'){ ?>

<select name='district' id='district'>
	<option value="">เลือกเขต</option>
	<?
	$rstTemp=mysql_query("select * from district Where AMPHUR_ID ='".$select_id."'  Order By DISTRICT_ID ASC");
	while($arr_2=mysql_fetch_array($rstTemp)){
	?>
	<option value="<?=$arr_2['DISTRICT_ID']?>"><?=$arr_2['DISTRICT_NAME']?></option>
	<? }?>
</select>
<? }?>

<? if($result=='zipcode'){ ?>

<select name='zipcode' id='zipcode'>
	<?
	$rstTemp=mysql_query("select * from zipcode Where DISTRICT_ID ='".$select_id."'  Order By ZIPCODE_ID ASC");
	while($arr_2=mysql_fetch_array($rstTemp)){
			?>
	<option value="<?=$arr_2['ZIPCODE_ID']?>"><?=$arr_2['ZIP_NAME']?></option>
<? }?>
</select>
<? }?>