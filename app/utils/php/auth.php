<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'mems');

$params = json_decode(file_get_contents('php://input'), true);

if (!$params || !isset($params['email']) || !isset($params['hash'])) {
    echo json_encode(['success' => false, 'error' => 'Нет данных в запросе']);
    exit;
}

$email = $mysqli->real_escape_string($params['email']);
$hash  = $mysqli->real_escape_string($params['hash']);

$result = $mysqli->query("SELECT password_hash FROM user WHERE email='$email'");

if (!$result) {
    echo json_encode(['success' => false, 'error' => 'Ошибка запроса']);
    exit;
}

$row = $result->fetch_assoc();

if (!$row) {
    echo json_encode(['success' => false, 'error' => 'Пользователь не найден']);
    exit;
}

if ($row['password_hash'] !== $hash) {
    echo json_encode(['success' => false, 'error' => 'Неверный пароль']);
    exit;
}

$token = sha1($email . time());

echo json_encode(['success' => true, 'token' => $token]);
