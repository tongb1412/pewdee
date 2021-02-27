<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$tid = $_POST['tid'];
$type = $_POST['type'];

$txt = '';


$sql = "delete from tb_pctrec  Where vn='$vn' and tid='$tid' and typ='$type' ";
mysql_query($sql);



switch($type){
case "P" :  
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' and ftyp='P' ";
			mysql_query($sql);		
			$sql = "delete from tb_drugerec  Where vn='$vn' and pid='$tid' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");
			break;
case "C" :  
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' and ftyp='C' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");	
			break;

}	

$txt = 	'hn='.$hn.'&vn='.$vn;




echo '||register/doctor_form.php'.'||PCT||DEL||'.$txt;
?>