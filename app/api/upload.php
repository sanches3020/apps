<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

$data = file_get_contents('php://input');


$hash = hash('sha1', $data);

$filename = "file/$hash.png";
$filepath = $_SERVER['DOCUMENT_ROOT'] . $filename;

if (file_put_contents($filepath, $data) === false) {
    error("Ошибка загрузки файла");
}

//mysqli-> wefwefwefw

echo json_encode(['success' => true, 'filename'  => $filename]);