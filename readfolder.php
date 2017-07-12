<?php
// $dir    = dirname(__FILE__).'/videosapp';
// $files1 = scandir($dir);
// print_r($files1);

$video_array = glob('*.mp4', GLOB_BRACE);
print_r($video_array);
// $directory = "../videosapp";
// echo "<div id='images'><p>$directory ...<p>";
// $Files = glob("videosapp/*.mp4");
// foreach ( $Files as $file ) { 
//     echo "$file<br>" ;
// }
// echo "</div>";

$videos = array();
$dir = '../videos';
$files = scandir($dir);
foreach($files as $file) {
   $filepath = $dir . '/' . $file;
   if(is_file($filepath)) {
       $contentType = mime_content_type($filepath);
       if(stripos($contentType, 'video') !== false) {
           $videos[] = $file;
       }
   }
}



// $directories = scandir('../videosapp');
// foreach($directories as $directory){
//     if($directory=='.' or $directory=='..' ){
//         echo 'dot';
//     }else{
//             if(is_dir($directory)){
//                   echo $directory .'<br />';
//             }
//     }
// } 
// $dir = new DirectoryIterator(dirname(__FILE__));
// foreach ($dir as $fileinfo) {
//     if (!$fileinfo->isDot()) {
//         var_dump($fileinfo->getFilename());
//     }
// }
?>