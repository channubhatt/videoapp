<?php
error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@session_start();
@ob_start("ob_gzhandler");
@date_default_timezone_set('Asia/Calcutta');
define(APP_FOLDER,"videosapp/");
//define("ADMIN_MODEL_FILE_PATH",FILE_PATH."admin/model/");
define("FILE_PATH",$_SERVER['DOCUMENT_ROOT']."/".APP_FOLDER);
//echo "</br>FILE_PATH~~".FILE_PATH."</br>";
define("ROOT_DIR",dirname(__FILE__)."");
//echo "</br>ROOT_DIR~~ ".ROOT_DIR."</br>";
$ROOT_DIR = str_replace('\\', '/', ROOT_DIR);
//echo "</br>new path_DIR~~ ".$npath."</br>";
$abspath = explode("/",$ROOT_DIR);
array_pop($abspath); 
define("ABSPATH",implode("/",$abspath));
//echo "</br>ABSPATH~~".ABSPATH."</br>";
$path = "http://".$_SERVER['SERVER_NAME']."/".APP_FOLDER; 
define("APP_PATH",$path);
$upload_floder_path=FILE_PATH."assets/uploads/";
define("UPLOAD_PATH",$upload_floder_path);
//echo "PATH~~".UPLOAD_PATH;
//define("SITE",$path."asset/");
define("IMG_PATH",$path."admin/images/");
//include_once(FILE_PATH.'common/function.php');
?>