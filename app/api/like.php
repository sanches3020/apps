<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/mems/utils/php/db.php';

$mem_id = get('mem_id');
$user_hash = get('user_hash');

if (!$mem_id || !$user_hash) {
    error(['success' => false, 'error' => 'Нет данных']);
}

$result = query("INSERT INTO likes (mem_id, user_hash) VALUES ('$mem_id', '$user_hash')");

success(['success' => true, 'message' => 'Лайк поставлен']);
?>