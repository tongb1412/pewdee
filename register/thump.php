<?
$size = $_GET['size'];
define("THUMP_SIZE",$size);

$file = $_GET["file"];
$oldDimension = GetImageSize($file);
$oldWidth  = $oldDimension[0];
$oldHieght = $oldDimension[1];

if (oldWidth <= THUMP_SIZE && $oldHieght <= THUMP_SIZE ) {
	header("Location: $file");
	exit;
}

$newDimension = calculateNewDimension($oldDimension);

$newWidth  = $newDimension[0];
$newHieght = $newDimension[1];
if($oldWidth < $newWidth ){
	$newWidth  = $oldWidth;
	$newHieght = $oldHieght;
} 

$oldImage = loadImageFormFile($file);

$newImage = ImageCreateTrueColor($newWidth, $newHieght);

ImageCopyResampled($newImage, $oldImage, 0, 0, 0, 0, $newWidth, $newHieght, $oldWidth, $oldHieght);

ImageDestroy($oldImage);

ob_start();

ImageJPEG($newImage);

$imageDataLength = ob_get_length();

ImageDeatroy($newImage);

header("Content-Type: image/jpeg,image/GIF ");
header("Content-Length: ".$imageDataLength);

ob_end_flush();


function calculateNewDimension($oldDimension){
$oldWidth  = $oldDimension[0];
$oldHieght = $oldDimension[1];



if ($oldWidth > $oldHieght) {
	$newWidth = THUMP_SIZE;
	$scale = $oldWidth / THUMP_SIZE;
	$newHieght = (int) round($oldHieght / $scale);
} else {
    
	$newHieght = THUMP_SIZE;
	
	$scale = $oldHieght / THUMP_SIZE;

	$newWidth = (int) round($oldWidth / $scale);

}



return array($newWidth, $newHieght);

}


function  loadImageFormFile($file) {

$partPharts = pathinfo($file);
$ext = strtolower($partPharts["extension"]);
switch ($ext) {
	case "gif":   return ImageCreateFromGIF($file); break;
	case "jpg":   return ImageCreateFromJPEG($file); break;        
	case "jpeg":  return ImageCreateFromJPEG($file); break;
	case "png":   return ImageCreateFromPNG($file); break;	
}

}


?>