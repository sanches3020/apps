<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

$mems = select("mems", [], "ORDER BY mem_id DESC");

$result = [];

$user_hash = $_GET["user_hash"] ?? null;
$user = $user_hash ? row("users", ["user_hash" => $user_hash]) : null;
$user_id = $user ? $user["user_id"] : null;

foreach ($mems as $mem) {

    $likes_count = scalar(
        "likes",
        "COUNT(*)",
        ["mem_id" => $mem["mem_id"]]
    );

    $user = row("users", ["user_id" => $mem["user_id"]]);

    $liked = $user_id ? row("likes", ["mem_id" => $mem["mem_id"], "user_id" => $user_id]) !== null : false;

    $result[] = [
        "mem_id"      => $mem["mem_id"],
        "mem_title"   => $mem["mem_title"],
        "mem_price"   => $mem["mem_price"],
        "user_id"     => $mem["user_id"],
        "mem_image"   => $mem["mem_image"],
        "likes_count" => $likes_count,
        "user_name"   => $user ? $user["user_email"] : "",
        "liked"       => $liked,
    ];
}

success($result);
