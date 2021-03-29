<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['hn'];
$mem = $_POST['mem'];
$vn = $_POST['vn'];
$dat = date('Y-m-d H:i:s',time());
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];

$where_company = "and company_code = '$company_code' ";

$sql = "select tb_patient.* from tb_patient,tb_vst where tb_patient.hn = tb_vst.hn and tb_patient.hn = '$hn' and tb_patient.vn = '$vn' and tb_vst.status = 'DOC' ";
// echo $sql;
// echo '||doctor/wait_list.php'.'||--||D||ส่งคนไข้กลับเวชระเบียนเรียบร้อยแล้ว' . $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$Num_Rows = mysql_num_rows($result);
if($Num_Rows == 1) {

    $rs = mysql_fetch_array($result);
    $patient_branch_id = "and branchid = '" . $rs['branchid'] . "' ";
    $hn_vst = $rs['hn'];
    $where_branch = "and branchid = '$branch_id' ";
    

    $sql = "update tb_patient set vn='-',stayin='REG'  where hn='$hn' and vn='$vn' " . $patient_branch_id . $where_company;
    // echo $sql;exit();
    $rs = mysql_query($sql);
        
    $sql = "update tb_vst set status='CANCEL',ctime='$dat',mem='$mem'  where vn='$vn' " . $where_branch . $where_company;
    mysql_query($sql);
    
    $sql = "delete from tb_pctrec  Where vn='$vn' and hn = '$hn_vst' ". $where_company;
    mysql_query($sql);
    
    $sql = "delete from tb_pctuse  Where vn='$vn' and hn = '$hn_vst' " . $where_branch . $where_company;
    mysql_query($sql);
    
    echo '||doctor/wait_list.php'.'||--||D||ส่งคนไข้กลับเวชระเบียนเรียบร้อยแล้ว';

} else if($Num_Rows < 1){
    echo '||doctor/wait_list.php'.'||--||D||ไม่สามารถส่งคนไข้กลับเวชระเบียนได้ (Code Error #2)';

} else {

    $sql = "select * from tb_patient,tb_vst where tb_patient.hn = tb_vst.hn and tb_patient.hn = '$hn' and tb_patient.vn = '$vn' and tb_patient.branchid = '$branch_id' and tb_vst.status = 'DOC' ";
    $result = mysql_query($sql) or die ("Error Query [".$sql."]");
    $Num_Rows = mysql_num_rows($result);
    if($Num_Rows == 1){
        $sql = "update tb_patient set vn='-',stayin='REG'  where hn='$hn' " . $where_branch . $where_company;
        $rs = mysql_query($sql);
            
        $sql = "update tb_vst set status='CANCEL',ctime='$dat',mem='$mem'  where vn='$vn' " . $where_branch . $where_company;
        mysql_query($sql);
        
        $sql = "delete from tb_pctrec  Where vn='$vn' " . $where_branch . $where_company;
        mysql_query($sql);
        
        $sql = "delete from tb_pctuse  Where vn='$vn' " . $where_branch . $where_company;
        mysql_query($sql);
        
        echo '||doctor/wait_list.php'.'||--||D||ส่งคนไข้กลับเวชระเบียนเรียบร้อยแล้ว';
    } else {
        echo '||doctor/wait_list.php'.'||--||D||ไม่สามารถส่งคนไข้กลับเวชระเบียนได้' . $sql;
    }
}


?>