<?php

    include('../systems/msFunction.php');
	$code = $_POST['code'];
	for($i=0;$i<count($_FILES["filUpload"]["name"]);$i++)
	{	   
		if($_FILES["filUpload"]["name"][$i] != "")
		{
		    $img = $_FILES["filUpload"]["name"][$i];
			if(copy($_FILES["filUpload"]["tmp_name"][$i],"../content_img/".$_FILES["filUpload"]["name"][$i]))
			{
				$data = array(	
				"id" => NULL,	
				"code" => $code,
				"img" => $img,			
				);	
				$add = $db->add_db("imgdetail",$data);	
				
				
				
				
				
				
				
			}
			
			/*
			$pic = $hn.".jpg";
			imagejpeg($img, "images/pt/".$pic, 300);
			imagejpeg($img, "", 300);
			
			
			$sql  = "select * from tb_img where hn='$hn ";
			$str  = mysql_query($sql);
			$num = mysql_num_rows($str);
			if(empty($num)){
				$sql = "insert into tb_img  values('$hn','$pic')";
				mysql_query($sql);
			} else {
				$sql = "update tb_img set img='$pic' where hn='$hn' ";
				mysql_query($sql);
			}			
						
			*/
			
			
			
			
		}
	}


?>