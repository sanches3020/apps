<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'store');

$params = json_decode(file_get_contents('php://input'), true);

$mem_id = $params['mem_id'];

$mem_id = $mysqli->real_escape_string($mem_id);

$mysqli->query("INSERT INTO likes (mem_id, user_id) VALUES ('$mem_id', 1)");

header('Content-type: application/json');
echo json_encode(['success' => true]);
