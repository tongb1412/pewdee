<?php
include('../class/config.php');
    $fn = $_POST['FN'];
    if($fn == "get_doctor_data"){
        $branch_id = "";
        if(!empty($_POST['branch_id'])){
            $branch_id = $_POST['branch_id'];
        }
        $data = array();
        if($branch_id == "00"){
            $sql = "select staffid,pname,fname from tb_staff where typ='D' ORDER BY fname";

        } else {
            $sql = "select staffid,pname,fname from tb_staff where typ='D' and branchid = '$branch_id' ORDER BY fname";
        }
        $result = mysql_query($sql) or die ("Error Query [".$sql."]");
        $Num_Rows = mysql_num_rows($result);
        if(!empty($Num_Rows)){
            while($rs = mysql_fetch_array($result)){ 
                $data[] = $rs;
            }
        }
        echo json_encode($data);
    }
    
?>