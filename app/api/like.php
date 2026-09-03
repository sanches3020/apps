<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

$mem_id = $_POST["mem_id"];
$user_hash = $_POST["user_hash"];

$liker = row("users",["user_hash" => $user_hash]);

if ($liker === null) {
   error("не найден");
}

$mem = row("mems",["mem_id" => $mem_id]);
if ($mem === null) {
    error("мем не найден");
}

$owner_id = $mem['user_id'];
$liker_id = $liker['user_id'];

if($liker_id === $owner_id) {
    error("ты лайкаешь свой мем долбаеб");
}

$owner = row("users",["user_id" => $owner_id]);

update("users", ["user_balance" => $liker['user_balance'] + 1], ["user_id" => $liker_id]);
update("users", ["user_balance" => $owner['user_balance'] + 1], ["user_id" => $owner_id]);

success();