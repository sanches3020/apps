<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/mems/utils/php/db.php';

$email = get('email');
$hash  = get('hash');

if (!$email || !$hash) {
    error(['success' => false, 'error' => 'Нет данных в запросе']);
}

$result = query("SELECT password_hash FROM user WHERE email='$email'");

if (empty($result)) {
    error(['success' => false, 'error' => 'Пользователь не найден']);
}

$row = $result[0];

if ($row['password_hash'] !== $hash) {
    error(['success' => false, 'error' => 'Неверный пароль']);
}

$token = sha1($email . time());

success(['success' => true, 'token' => $token]);
?>