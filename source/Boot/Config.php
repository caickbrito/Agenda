<?php
//DATABASE
define("DB_HOST", "localhost");
define("DB_NAME", "agenda");
define("DB_USER", "root");
define("DB_PASSWD", "");

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "agenda",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

//PATH ROOT
define("ROOT", "http://localhost/projetos/phpstorm");

//VIEW
define("CONF_VIEW_EXT", "php");


/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.gmail.com");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "EMAIL_USER");
define("CONF_MAIL_PASS", "EMAIL_PASSWD");
define("CONF_MAIL_SENDER", ["name" => "Equipe CB Developer", "address" => "cbdeveloper3@gmail.com"]);
define("CONF_MAIL_SUPPORT", "cbdeveloper3@gmail.com");


define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");



