<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

$mem_id = get_required("mem_id");
$user_hash = get_required("user_hash");

$user = row("users", ["user_hash" => $user_hash]);
$mem = row("mems", ["mem_id" => $mem_id]);

if ($mem['user_id'] != $user['user_id'])
    error("Это не твой мем обезьяна");

$new_price = round($mem['mem_price'] * 1.10, 2);

update("mems", ["mem_price" => $new_price], ["mem_id" => $mem_id]);

update("mems", ["mem_price" => $new_price], ["mem_id" => $mem_id]);

success(["new_price" => $new_price]);
