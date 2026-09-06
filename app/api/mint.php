<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

$mem_title = get_required("mem_title");
$mem_price = get_required("mem_price");
$mem_image = get_required("mem_image");
$user_hash = get_required("user_hash");

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/auth.php';

$user = row("users", ["user_hash" => $user_hash]);

if (!$user) {
    error("Пользователь не найден");
}

insert("mems", [
    "mem_title"  => $mem_title,
    "mem_price"  => $mem_price,
    "mem_image"  => $mem_image,
    "user_id"    => $user["user_id"],
]);

success();