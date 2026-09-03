<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

$user_email = get_required("user_email");
$user_hash  = get_required("user_hash");

$user = row("users", ["user_email" => $user_email]);

if ($user != null) {
    if ($user["user_hash"] == $user_hash) {
        success();
    } else {
        error("Неверный пароль");
    }
} else {
    insert("users", [
        "user_email" => $user_email,
        "user_hash" => $user_hash,
    ]);

    success();
}