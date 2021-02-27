<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$hn = $_POST['hn'];
$tid = $_POST['tid'];
$eid = $_POST['eid'];
$type = $_POST['type'];

$txt = '';


$sql = "delete from tb_pctrec  Where vn='$vn' and tid='$tid' and typ='$type' ";
mysql_query($sql);



switch($type){
case "P" :  
			$sql = "delete from tb_pctuse  Where uvn='$vn' and tid='$tid' and ftyp='P' and empid='$eid' ";
			mysql_query($sql);		
			$sql = "delete from tb_drugerec  Where vn='$vn' and tid='$tid' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");
			break;
case "C" :  
			$sql = "delete from tb_pctuse  Where uvn='$vn' and tid='$tid' and ftyp='C' and empid='$eid' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");	
			break;

}	
$txt = 	'hn='.$hn.'&vn='.$vn;

echo '||register/doctor_form.php'.'||PCT||DEL||'.$txt;
?>