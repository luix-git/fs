<?php

include(__DIR__ . '/../CommonFunctions/HttpVerifications.php');

checkHttpMethod(['GET', 'POST']);
auth();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userInfo = getUsers()[$_SERVER['PHP_AUTH_USER']];
    $userInfo['user_name'] = $_SERVER['PHP_AUTH_USER'];

    echo json_encode($userInfo);
} elseif (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $postData = json_decode(file_get_contents("php://input"), true);
    $users = getUsers();

    setUser($_SERVER['PHP_AUTH_USER'], $postData);
}