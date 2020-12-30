<?php

namespace Source\Core;

class Connect
{
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance))
        {
            self::$instance = new \PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWD
            );
        }
        return self::$instance;
    }
}

