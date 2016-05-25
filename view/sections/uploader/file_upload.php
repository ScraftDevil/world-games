<?php
//path for require uploader
require(dirname(__FILE__) . '..\Uploader.php');
//
$upload_dir = 'uploads/';
$uploader = new FileUpload('uploadfile');
$result = $uploader->handleUpload($upload_dir);
if (!$result) {
  exit(json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg())));  
}
echo json_encode(array('success' => true));