<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');
$vn = $_POST['vn'];
$tid = $_POST['tid'];
$type = $_POST['type'];
$con = 'DEL';
$txt = '';
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_data =  set_where_user_data('',$branch_id, $company_code, $company_data);


$sql = "delete from tb_pctrec  Where vn='$vn' and tid='$tid' and typ='$type' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
mysql_query($sql);



switch($type){
case "P" :  
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql);		
			$sql = "delete from tb_drugerec  Where vn='$vn' and pid='$tid' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql) or die ("Error Query [".$sql."]");
			break;
case "C" :  
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' and ftyp='C' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql) or die ("Error Query [".$sql."]");	
			break;
default :   
			$sql = "delete from tb_pctuse  Where vn='$vn' and pid='$tid' and ftyp='T' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql) or die ("Error Query [".$sql."]");			
			break;	
}	






echo '||doctor/doctor_form.php'.'||'.$vn.'||'.$con.'||'.$txt;
?>