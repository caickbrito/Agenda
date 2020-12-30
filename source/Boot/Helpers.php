<?php

//SANITIZE STRIPPED
function sanitize_stripped($data)
{
    if (is_array($data))
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        return $data;
    }
    $data = filter_var($data, FILTER_SANITIZE_STRIPPED);
    return $data;
}

//VALIDATION
function is_email($email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return false;
    }
    return true;
}

//ASSET
function asset(string $path): string
{
    $path = "http://localhost/projetos/phpstorm/shared/assets/{$path}";
    return $path;
}

function assetAgenda(string $path): string
{
    $path = "http://localhost/projetos/phpstorm/shared/views/agenda/{$path}";
    return $path;
}

//PASSWORD
function passwd_hash(string $passwd)
{
    return password_hash($passwd, PASSWORD_DEFAULT);
}