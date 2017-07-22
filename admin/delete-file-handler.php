<?php
if($_POST['FileName']!="")
{
$file = $_POST['FileName'];
if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }
}
  ?>