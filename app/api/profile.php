<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/auth.php';

$user_hash = get_required("user_hash");

$user = row("users", ["user_hash" => $user_hash]);

success($user);