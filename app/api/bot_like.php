<?php
$_SERVER['DOCUMENT_ROOT'] = "/app";
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/request.php';


$random = rand(0, 100000000);
$response = post_json("http://app/api/login.php", [
    "user_email" => "user$random@gmail.com",
    "user_hash" => $random,
]);


for ($i = 0; $i < rand(1, 5); $i++) {
    sleep(1);

    $mem_id = scalarSql("SELECT mem_id FROM mems ORDER BY RAND() LIMIT 1");

    $response = post_json("http://app/api/like.php", [
        'mem_id' => $mem_id,
        'user_hash' => $random,
    ]);

    println("bot like", $response);
}

println("bot success end");

sleep(1);
