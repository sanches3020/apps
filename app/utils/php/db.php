<?php

error_reporting(1);

$DB_HOST = getenv('DB_HOST');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');
$DB_NAME = getenv('DB_NAME');

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

$params = json_decode(file_get_contents('php://input'), true);

function get($param_name) {
    return $GLOBALS['params'][$param_name];
}

function error($result)
{
    header("Content-type: application/json;charset=utf-8");
    http_response_code(500);
    die(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function query($sql) {
    global $mysqli;
    $response = [];
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc())
        $response[] = $row;
    return $response;
}


/*insert('users', [
    'user_email' => $params['email'],
    'user_email' => $params['email'],
]);*/


function success($response) {
    header('Content-type: application/json');
    die(json_encode($response));
}