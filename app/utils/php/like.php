<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'mems');

$params = json_decode(file_get_contents('php://input'), true);

$mem_id = $params['mem_id'];

$mem_id = $mysqli->real_escape_string($mem_id);
$user_hash = $mysqli->real_escape_string($user_hash);

$result = $mysqli->query("INSERT INTO likes (mem_id, user_hash) VALUES ('$mem_id', '$user_hash')");


header('Content-type: application/json');
echo json_encode(['success' => true, 'message' => 'Лайк поставлен']);
    
