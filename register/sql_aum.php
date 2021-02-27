<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
$cl = $color1;
$txt = $_GET['txt'];

if(! empty($txt) ){

$sql = "select * from tb_gernaral where typ='AM' and name like '%$txt%' order by name asc   limit 8";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n = mysql_num_rows($result);
while($rs=mysql_fetch_array($result)){ 
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}
$xx= 'Yes';
if($n==1){
	if (trim($rs['name'])== trim($txt) ){ $xx='No'; }
}

if($xx=='Yes'){
?>
<div  style="width:90%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#666666 1px dotted;background:#CCCCCC; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'#CCCCCC')" onclick="returtxt('aum','<?=trim($rs['name'])?>','aumz','txt=','register/sql_aum.php')"  >   
   <span ><?=$rs['name']?></span> 
</div>
<? 
 }
 } 
 } 
 
 ?>

