<?php 
include_once('../autoload.php');
$video_folder_location = "advs"; 
$dir=UPLOAD_PATH.$video_folder_location;
$assets_path="assets/uploads/advs/";
$file_type="video/mp4";
if (is_dir($dir)){
	if ($dh = opendir($dir)){
	while (($file = readdir($dh)) !== false){
		$data=pathinfo($file, PATHINFO_EXTENSION);
			if("mp4"==$data)
			{
			$posts[]=array("src"=>$assets_path.$file, "type"=>$file_type );
			}
		//echo "filename:" . $file . "<br>";
		}
	$value=json_encode($posts);
	$fp=fopen($dir."/inventory.json","w+");
	fwrite($fp,$value);
	closedir($dh);
	}
}
?>
