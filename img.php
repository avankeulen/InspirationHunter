<?php
session_start();
include_once("classes/Photo.class.php");

$photo = new Photo();
$user_img = $photo->getPhoto();

$finfo    = new finfo(FILEINFO_MIME);
$mimeType = $finfo->buffer($user_img);

header('Content-type: ' . $mimeType);
echo $user_img;
?>