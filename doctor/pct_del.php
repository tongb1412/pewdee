<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$tid = $_POST['tid'];
$type = $_POST['type'];
$con = 'DEL';
$txt = '';


$sql = "delete from tb_pctrec  Where vn='$vn' and tid='$tid' and typ='$type' ";
mysql_query($sql);



switch($type){
case "P" :  
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' ";
			mysql_query($sql);		
			$sql = "delete from tb_drugerec  Where vn='$vn' and pid='$tid' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");
			break;
case "C" :  
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' and ftyp='C' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");	
			break;
default :   
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' and ftyp='T' ";
			mysql_query($sql) or die ("Error Query [".$sql."]");			
			break;	
}	






echo '||doctor/doctor_form.php'.'||'.$vn.'||'.$con.'||'.$txt;
?>