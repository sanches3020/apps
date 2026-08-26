<?php

$mem_id = get_required(mem_id);
$user_hash = get_required(user_hash);

$liker = row(users,[$user_hash => $user_hash]);
if ($liker === null) {
    error("не найден");
}

$mem = row(mems,[$mem_id => $mem_id]);
if ($mem === null) {
    error("мем не найден");
}

$owner_id = $mem['user_id'];
$liker_id = $liker['user_id'];

update(users, [user_id => $owner_id], [
    balance => sql("balance + 1")
]);

update(users, [user_id => $liker_id], [
    balance => sql("balance + 1")
]);