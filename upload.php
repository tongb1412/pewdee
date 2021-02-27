<?
include('class/config.php');
$hn = $_POST['phn'];
	
if(trim($_FILES["filUpload"]["tmp_name"]) != "")
{
$images = $_FILES["filUpload"]["tmp_name"];
$new_images = $hn.$_FILES["filUpload"]["name"];



copy($_FILES["fileUpload"]["tmp_name"],"images/".$_FILES["fileUpload"]["name"]);
$width=100; //*** Fix Width & Heigh (Autu caculate) ***//
$size=GetimageSize($images);
$height=round($width*$size[1]/$size[0]);
$images_orig = ImageCreateFromJPEG($images);
$photoX = ImagesX($images_orig);
$photoY = ImagesY($images_orig);
$images_fin = ImageCreateTrueColor($width, $height);
ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
ImageJPEG($images_fin,"ptImg/".$new_images);
ImageDestroy($images_orig);
ImageDestroy($images_fin);


				$sql  = "select * from tb_img where hn='$hn'  ";
				$str  = mysql_query($sql);
				$num = mysql_num_rows($str);
				if(empty($num)){
					$sql = "insert into tb_img  values('$hn','$new_images')";
					mysql_query($sql);
				} else {
					$sql = "update tb_img set img='$new_images' where hn='$hn' ";
					mysql_query($sql);
				}	
$dir    = 'thump.php?size=100&file=ptImg/'.$new_images; 

?>
<div style="width:100%; height:100%;">
<img src="<?=$dir?>" align="absmiddle" />
</div>


<?

}	
	



?>

