<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

$mems = select("mems", [], "ORDER BY mem_id DESC");

$result = [];

foreach ($mems as $mem) {

    $likes_count = scalar(
        "likes",
        "COUNT(*)",
        ["mem_id" => $mem["mem_id"]]
    );

    $user = row("users", ["user_id" => $mem["user_id"]]);

    $result[] = [
        "mem_id"      => $mem["mem_id"],
        "mem_title"   => $mem["mem_title"],
        "mem_price"   => $mem["mem_price"],
        "user_id"     => $mem["user_id"],
        "image"       => $mem["mem_image"],
        "likes_count" => $likes_count,
        "user_name"   => $user ? $user["user_email"] : "",
    ];
}

success($result);