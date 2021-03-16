

<?php 

function set_where_user_data($as ,$branch_id, $company_code, $company_data){

    $data = array();
    $data_array = array();
    $where_branch_id = "";
    $where_company_code = "";
    $table_as = "";

    if($as != ""){
        $table_as = $as . ".";
    }

    // $where_branch_id = "";
    // if($branchid != "") {
    //     if($branchid != "00"){ 
    //         $where_branch_id = " and (b.branchid ='".$branchid."' or b.branchid is null ) ";
    //     } 
    // }else if($_SESSION['branch_id'] != "") {	
    //     $where_branch_id = " and (b.branchid ='".$_SESSION['branch_id']."'  or b.branchid is null ) ";
    // }
    
    // echo "xx$branch_id";
    if($branch_id != "" ){
        if($branch_id != "00") {
            $where_branch_id = " and ( " . $table_as . "branchid ='".$branch_id."'  or " . $table_as . "branchid is null )";
        }
    } else if($branch_id != "00"){
        if($_SESSION['branch_id'] !="" && $_SESSION['company_data'] !="1") {	
            $where_branch_id = " and (" . $table_as . "branchid ='".$_SESSION['branch_id']."' or " . $table_as . "branchid is null ) ";
            $branch_id = $_SESSION['branch_id'];
        }
    }
    else{
        if($_SESSION['branch_id'] !="") {	
            $branch_id = $_SESSION['branch_id'];
        }
    }

    if($company_code != ""){
        $where_company_code = " and " . $table_as . "company_code ='".$company_code."'  ";
    }
    else{
        if($_SESSION['company_code'] !="") {	
            $where_company_code = " and " . $table_as . "company_code ='".$_SESSION['company_code']."'  ";
            $company_code = $_SESSION['company_code'];
        }
    }

    if($company_data != ""){
        $where_company_data = " and " . $table_as . "company_data ='".$company_data."'  ";
    }
    else{
        if($_SESSION['company_data'] !="") {	
            $where_company_data = " and " . $table_as . "company_data ='".$_SESSION['company_data']."'  ";
            $company_data = $_SESSION['company_data'];
        }
    }


    $data['where_branch_id'] = $where_branch_id;
    $data['where_company_code'] = $where_company_code;
    $data['where_company_data'] = $where_company_data;

    // array_push($data_array, $data);
    $json_data = json_encode($data);
    // return $json_data;
    return $data;

    // EX to user func
    // $where_user_data = set_where_user_data('ตัวย่อ table','รหัสสาขา','รหัสบริษัท','เช็คสิทธิ์ user');
    // echo $where_user_data['where_branch_id'];
    // echo $where_user_data['where_company_code'];
    // echo $where_user_data['where_company_data'];

}


function get_branch_name($branchid, $company_code) {
    include('../class/config.php');
    $branchname = "";
    echo $branch_id;
    if($branchid != "" && $branchid != "00") {
        $sql2 = "select branchid,branchname from tb_branch where branchid = '$branchid' and company_code ='".$company_code."' ";
        $result = mysql_query($sql2) or die("Error Query [".$sql2."]"); 
        while ($rs=mysql_fetch_array($result)) {
            $branchname = $rs['branchname'];
        }
    }
    return $branchname;
}

?>