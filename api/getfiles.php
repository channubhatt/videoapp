<?php
include_once('../autoload.php');
$find_folder_value=get_folder_name_by_value();
$dir = $find_folder_value[0];
$site_folder=$find_folder_value[1];
// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
    	$data=pathinfo($file, PATHINFO_EXTENSION);
    	if("mp4"==$data)
    	{
    	$posts[]=array("FilePath"=>$site_folder.$file, "FileName"=>$file );
    	}
      //echo "filename:" . $file . "<br>";
    }
    closedir($dh);
  }
}

header('Content-type: application/json');
echo json_encode($posts);


function get_folder_name_by_value(){
	$videoType=$_GET['type'];			
	if($videoType=='1')
	{
	$videoLang=$_GET['val'];
	$data=array();
	switch ($videoLang) {
		case '1'://echo "Hindi";
			$data=array(UPLOAD_PATH."hindi", UPLOAD_SITE_PATH."hindi/");
			return $data;
			break;
		case '2':
			//echo "Tamil";
			$data=array(UPLOAD_PATH."tamil", UPLOAD_SITE_PATH."tamil/");
			return $data;
			//return UPLOAD_PATH."tamil";
			break;
		case '3':
			//echo "Kannada";
			$data=array(UPLOAD_PATH."kannada", UPLOAD_SITE_PATH."kannada/");
			return $data;
			//return UPLOAD_PATH."kannada";
			break;
		case '4':
			//echo "Malaylam";
			$data=array(UPLOAD_PATH."malayalam", UPLOAD_SITE_PATH."malayalam/");
			return $data;
			//return UPLOAD_PATH."malayalam";
			break;
		case '5':
			//echo "Telgu";
			$data=array(UPLOAD_PATH."telugu", UPLOAD_SITE_PATH."telugu/");
			return $data;
			//return UPLOAD_PATH."telugu";
			break;
		case '6':
			return UPLOAD_PATH."other";
			break;
		}
	}
	else
	{
		$data=array(UPLOAD_PATH."advs", UPLOAD_SITE_PATH."advs/");
		return $data;
		//return UPLOAD_PATH."advs";
	}
}
?>