<?php

function checkHttpMethod(array $allowedMetgodes)
{
    if (!in_array($_SERVER['REQUEST_METHOD'], $allowedMetgodes)) {
        http_response_code(405);
        exit;
    }
}

function auth()
{
    if (!checkUser()) {
        $usersPasswords = [];
        foreach (getUsers() as $userName => $values) {
            if (!isset($_SERVER['PHP_AUTH_PW'])) {
                $usersPasswords[$userName] = $values['password'];
            }
        }

        http_response_code(401);
        header('WWW-Authenticate: Basic realm="My Realm"');
        echo 'Users: ' . json_encode($usersPasswords) . PHP_EOL;
        echo 'Use: var_dump(base64_encode(\'user_name:password\')); or echo -n "user_name:password" | base64';
        exit;
    }
}

function getUsers(): array
{
    return json_decode(file_get_contents(__DIR__ . '/../DataFiles/users.json'), true);
}

function checkUser(): bool
{
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        return false;
    }

    if (!isset($_SERVER['PHP_AUTH_PW'])) {
        return false;
    }

    if (getUsers()[$_SERVER['PHP_AUTH_USER']]['password'] != $_SERVER['PHP_AUTH_PW']) {
        return false;
    }

    return true;
}

function setUser($userName, array $userData) {
    $users = getUsers();

    foreach ($userData as $valueName => $value) {
        $users[$userName][$valueName] = $value;
    }

    file_put_contents(__DIR__ . '/../DataFiles/users.json', json_encode($users));
}