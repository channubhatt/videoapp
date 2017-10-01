<?php
include_once('../autoload.php');
$type = array("Unknown","Removable");
$srcPath = SOURCE_FOLDER;
$destPath = FILE_PATH;

$srcDir = opendir($srcPath);
$i=1;
while($readFile = readdir($srcDir))
{
    if($readFile != '.' && $readFile != '..')
    {
        if (!file_exists($readFile)) 
        {
			$data=pathinfo($readFile, PATHINFO_EXTENSION);

			if($data=="mp4")
			{
				$allfiles[]=array('index'=>$i, 'files'=>$readFile, 'source' =>$srcPath . $readFile, 'filename' => $readFile);
				
				//print_r($allfiles);
				// if(copy($srcPath . $readFile, $destPath . $readFile))
	   //          {
	   //              echo "Copy file";
	   //          }
	   //          else
	   //          {
	   //              echo "Canot Copy file";
	   //          }	
			}	

        }
    }
    $i++;
}
closedir($srcDir);

$requestfiles=explode(',', $_POST['ids']);
$request=array();
for($i=0;$i<count($requestfiles);$i++)
{
	///echo $requestfiles[$i];
	array_push($request,$requestfiles[$i]);
}
get_folder_name_by_value($request, $allfiles);

//echo "<pre>";
//print_r($allfiles);
//print_r($request);

//header('Content-type: application/json');
//echo json_encode($posts);


function get_folder_name_by_value($request, $allfiles){
	$videoType=1;			
	if($videoType=='1')
	{
	$videoLang=$_POST['buttonvalue'];
	$data=array();
	switch ($videoLang) {
		case '1'://echo "Hindi";
			for($i=0;$i<count($allfiles);$i++){
				/*print_r($request);
				print_r($allfiles[$i]['index']);
				exit;*/
				if (in_array($allfiles[$i]['files'], $request))
				{
					/*
					echo "source~~~~".$allfiles[$i]['source'];
					echo "<br>";
					echo "destination~~~~".UPLOAD_PATH."hindi/".$allfiles[$i]['filename'];
					echo "<br>";
					*/
					if(copy($allfiles[$i]['source'], UPLOAD_PATH."hindi/".$allfiles[$i]['filename']))
					{
					echo "<p>File copied Successfully. ".$allfiles[$i]['filename']."</p>";
					echo "<p>Destination:<b>".UPLOAD_PATH."hindi/".$allfiles[$i]['filename']."</b></p>";
					}
					else
					{
					echo "Canot Copy file";
					}	
				}
			}
			break;
		case '2':
			//echo "Tamil";
			for($i=0;$i<count($allfiles);$i++){
				if (in_array($allfiles[$i]['files'], $request))
				{
					if(copy($allfiles[$i]['source'], UPLOAD_PATH."tamil/".$allfiles[$i]['filename']))
					{
					echo "<p>File copied Successfully. ".$allfiles[$i]['filename']."</p>";
					echo "<p>Destination:<b>".UPLOAD_PATH."tamil/".$allfiles[$i]['filename']."</b></p>";
					echo "<br>";
					}
					else
					{
					echo "Canot Copy file";
					}	
				}
			}
			break;
		case '3':
			//echo "Kannada";
			for($i=0;$i<count($allfiles);$i++){
				if (in_array($allfiles[$i]['files'], $request))
				{
					if(copy($allfiles[$i]['source'], UPLOAD_PATH."kannada/".$allfiles[$i]['filename']))
					{
					echo "<p>File copied Successfully. ".$allfiles[$i]['filename']."</p>";
					echo "<p>Destination:<b>".UPLOAD_PATH."kannada/".$allfiles[$i]['filename']."</b></p>";
					}
					else
					{
					echo "Canot Copy file";
					}	
				}
			}
			break;
		case '4':
			//echo "Malaylam";
			for($i=0;$i<count($allfiles);$i++){
				if (in_array($allfiles[$i]['files'], $request))
				{
					if(copy($allfiles[$i]['source'], UPLOAD_PATH."malayalam/".$allfiles[$i]['filename']))
					{
					echo "<p>File copied Successfully. ".$allfiles[$i]['filename']."</p>";
					echo "<p>Destination:<b>".UPLOAD_PATH."malayalam/".$allfiles[$i]['filename']."</b></p>";
					}
					else
					{
					echo "Canot Copy file";
					}	
				}
			}
			break;
		case '5':
			//echo "Telgu";
		//print_r($request);
				//print_r($allfiles[$i]['index']);
				//exit;

			for($i=0;$i<count($allfiles);$i++){
				if (in_array($allfiles[$i]['files'], $request))
				{

					
					// echo "source~~~~".$allfiles[$i]['source'];
					// echo "<br>";
					// echo "destination~~~~".UPLOAD_PATH."hindi/".$allfiles[$i]['filename'];
					// echo "<br>";
					

					if(copy($allfiles[$i]['source'], UPLOAD_PATH."telugu/".$allfiles[$i]['filename']))
					{
					echo "<p>File copied Successfully. ".$allfiles[$i]['filename']."</p>";
					echo "<p>Destination:<b>".UPLOAD_PATH."telugu/".$allfiles[$i]['filename']."</b></p>";
					}
					else
					{
					echo "Canot Copy file";
					}	
				}
			}
			break;
		case '6':
				for($i=0;$i<count($allfiles);$i++){
				if (in_array($allfiles[$i]['files'], $request))
				{
					// echo "source~~~~".$allfiles[$i]['source'];
					// echo "<br>";
					// echo "destination~~~~".UPLOAD_PATH."hindi/".$allfiles[$i]['filename'];
					// echo "<br>";
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
					
					if(copy($allfiles[$i]['source'], UPLOAD_PATH."advs/".$allfiles[$i]['filename']))
					{
					//@chmod($dir,0777);
					echo "<p>File copied Successfully. ".$allfiles[$i]['filename']."</p>";
					echo "<p>Destination:<b>".UPLOAD_PATH."advs/".$allfiles[$i]['filename']."</b></p>";
					}
					else
					{
					echo "Canot Copy file";
					}	
				}
			}
			//return UPLOAD_PATH."other";
			break;
		}
	}
}
?>
