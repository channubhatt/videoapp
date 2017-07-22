<?php 
include_once('../autoload.php');
header('Content-type: application/json');
$response = array();
$allowedExts= array();
//define(UPLOAD_LIMIT, "800000");
$video_upload_size=800000000; //800 mb
$allowedExts = array("mp4");
$extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
//  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
// 	        echo "Type: " . $_FILES["file"]["type"] . "<br>";
// 	        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
// 	        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
// echo $extension;
if ((($_FILES["file"]["type"] == "video/mp4") && ($_FILES["file"]["size"] < $video_upload_size) && in_array($extension, $allowedExts)))
	{
	    if ($_FILES["file"]["error"] > 0) {
	        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	    } 
	    else {
	        $filename = $_FILES["file"]["name"];
	        // echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	        // echo "Type: " . $_FILES["file"]["type"] . "<br>";
	        // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	        // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
	        $video_folder_location=move_folder_location();
	        //if()
	        //echo $video_folder_location;
	        if (file_exists(UPLOAD_PATH.$video_folder_location."/" . $filename)) {
	           // echo $filename . " already exists. ";
	            $response['status'] = 'error'; // could not register
		$response['message'] = '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Warning!</strong> &nbsp;'. $filename . ' already exists.</div>';
	        } 
	        else {
	            move_uploaded_file($_FILES["file"]["tmp_name"], UPLOAD_PATH.$video_folder_location."/" . $filename);

	            if($video_folder_location=="advs")
	            {
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
	            }

	            $response['status'] = 'success';
				$response['message'] = '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  <strong>Success!</strong>&nbsp;'.$filename.' <br>Upload Sucessfully.</div>';

	            //echo "Stored in: " . "uploads/".$video_folder_location."/" . $filename;
	        }
	    }
	}
	else{
		//echo "invalid File Type";
		$response['status'] = 'error'; // could not register
		$response['message'] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> &nbsp; could not upload, try again later</div>';
	}

	echo json_encode($response);
		

	function move_folder_location(){
			$videoType=$_POST['videoType'];			
			if($videoType=='1')
			{
			$videoLang=$_POST['videoLang'];
			switch ($videoLang) {
				case '1'://echo "Hindi";
					return "hindi";
					break;
				case '2':
					//echo "Tamil";
					return "tamil";
					break;
				case '3':
					//echo "Kannada";
					return "kannada";
					break;
				case '4':
					//echo "Malaylam";
					return "malayalam";
					break;
				case '5':
					//echo "Telgu";
					return "telugu";
					break;
				default:
					return "other";
					break;
				}
			}
			else
			{
				return "advs";
			}
	}
?>
