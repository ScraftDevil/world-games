<?php
//path for require uploader
require(dirname(__FILE__) . '..\Uploader.php');
$upload_dir = $_GET['pathUpload'];
if (!file_exists($upload_dir)) {
 	mkdir($upload_dir, 0777, true);
}
$uploader = new FileUpload('uploadfile');
$ext = $uploader->getExtension(); // Get the extension of the uploaded file
$uploader->newFileName = 'avatar.'.$ext;
$result = $uploader->handleUpload($upload_dir);
if (!$result) {
  exit(json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg())));  
}
echo json_encode(array('success' => true));