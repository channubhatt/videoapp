<?php 
include_once('../autoload.php');
header('Content-type: application/json');
$response = array();
$update_interval=(int) $_POST['video_interval'];
$myfile = fopen($upload_floder_path."interval.txt", "w") or die("Unable to open write file!");
fwrite($myfile, $update_interval);
fclose($myfile);
if($myfile==true)
{
	$response['status'] = 'success';
	$response['message'] = '<div class="success_interval">New Value Updated.</div>';
}
else{
		//echo "invalid File Type";
		$response['status'] = 'error'; // could not register
		$response['message'] = '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> &nbsp; could not upload, try again later</div>';
	}
echo json_encode($response);
?>
