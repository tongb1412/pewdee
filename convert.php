<?
include('class/config.php');


$sql = "select * from tb_vst ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
while($rs=mysql_fetch_array($result)){ 
	$dat1 = substr($rs['vdate'],0,4).'-'.substr($rs['vdate'],8,2).'-'.substr($rs['vdate'],5,2).' '.substr($rs['vdate'],11,8);
	$dat2 = substr($rs['ctime'],0,4).'-'.substr($rs['ctime'],8,2).'-'.substr($rs['ctime'],5,2).' '.substr($rs['ctime'],11,8);
    $vn = $rs['vn'];
	$sql_update = "update tb_vst set vdate='$dat1',ctime='$dat2' where vn='$vn'";
    mysql_query($sql_update);

}
echo 'update tb_vst complete.';
?>
<br>
<?
$sql = "select * from tb_pctrec ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
while($rs=mysql_fetch_array($result)){ 
	$dat1 = substr($rs['dat'],0,4).'-'.substr($rs['dat'],8,2).'-'.substr($rs['dat'],5,2);	
    $vn = $rs['vn']; $tid = $rs['tid'];
	$sql_update = "update tb_pctrec set dat='$dat1' where vn='$vn' and tid='$tid'";
    mysql_query($sql_update);

}
echo 'update tb_pctrec complete.';
?>
<br>
<?
$sql = "select * from tb_pctuse ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
while($rs=mysql_fetch_array($result)){ 
	$dat1 = substr($rs['dat'],0,4).'-'.substr($rs['dat'],8,2).'-'.substr($rs['dat'],5,2);	
    $id = $rs['id'];
	$sql_update = "update tb_pctuse set dat='$dat1' where id='$id'";
    mysql_query($sql_update);

}
echo 'update tb_pctuse complete.';
?>