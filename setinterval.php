<?php
include('autoload.php');
//echo $upload_floder_path."interval.txt";
$myfile = fopen($upload_floder_path."interval.txt", "r") or die("Unable to open file!");
$interval=fgets($myfile);
fclose($myfile);
$interval=(int) $interval;
define('VIDEO_INTERVAL',$interval);
//echo VIDEO_INTERVAL; 
?>