<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/auth.php';

$mem_id = get_required("mem_id");
$user_hash = get_required("user_hash");

$buyer = row("users", ["user_hash" => $user_hash]);
if ($buyer === null)
    error("Нет пользователя");

$mem = row("mems", ["mem_id" => $mem_id]);
if ($mem === null) {
    error("мем не найден");
}

$owner = row("users", ["user_id" => $mem['user_id']]);
if ($mem['user_id'] == $buyer["user_id"])
    error('Это твой мем дебил');

if ($buyer['user_balance'] < $mem['mem_price'])
    error('Ты нищеброд');

update("users", ["user_balance" => $buyer['user_balance'] - $mem["mem_price"]], ["user_id" => $buyer['user_id']]);
update("users", ["user_balance" => $owner['user_balance'] + $mem["mem_price"]], ["user_id" => $owner['user_id']]);
update("mems", ["user_id" => $buyer['user_id']], ["mem_id" => $mem['mem_id']]);


success();
