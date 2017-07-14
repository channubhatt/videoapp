<?php
include_once('autoload.php');
$find_folder_value=get_folder_name_by_value();
$Files = glob($find_folder_value."/*.mp4");
foreach ( $Files as $file ) { 
    echo "$file<br>" ;
}
//echo "</div>";

function get_folder_name_by_value(){
	$videoType=$_GET['type'];			
	if($videoType=='1')
	{
	$videoLang=$_GET['val'];
	switch ($videoLang) {
		case '1'://echo "Hindi";
			return UPLOAD_PATH."hindi";
			break;
		case '2':
			//echo "Tamil";
			return UPLOAD_PATH."tamil";
			break;
		case '3':
			//echo "Kannada";
			return UPLOAD_PATH."kannada";
			break;
		case '4':
			//echo "Malaylam";
			return UPLOAD_PATH."malayalam";
			break;
		case '5':
			//echo "Telgu";
			return UPLOAD_PATH."telugu";
			break;
		case '6':
			return UPLOAD_PATH."other";
			break;
		}
	}
	else
	{
		return UPLOAD_PATH."advs";
	}
}
?>