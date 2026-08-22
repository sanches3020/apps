<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/mems/utils/php/db.php';  



$data = $_FILES['file']['tmp_name'];
$hash = sha1_file($data);

$filename = "/mems/file/$hash.png";
$filepath = $_SERVER['DOCUMENT_ROOT'] . $filename;
move_uploaded_file($data, $filepath);


//mysqli-> wefwefwefw
echo json_encode(['success' => true, 'filename' => $filename]);