<?php

/* DISPLAY_MODE:
	0: show all tables
	1: show all tables except tables in BLACKLIST 
	2: show only tables in WHITELIST
*/
define('DISPLAY_MODE', 0);
define('BLACKLIST', []);
define('WHITELIST', []);
$time_start = microtime(true);
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('DEBUG', true);


$sql_details = [
	"type" => "Mysql",
	"user" => "root",
	"pass" => "",
	"host" => "127.0.0.1",
	"port" => "",
	"db"   => "content_manager_better",
	"dsn"  => "charset=utf8"
];

// db const
define('DB_CONN', 'mysql:host=' . $sql_details['host'] . ';dbname=' . $sql_details['db']);
define('DB_USER', $sql_details['user']);
define('DB_PASS', $sql_details['pass']);



define('SESSION_LIFETIME', 28800); //8 hours in seconds
define('COOKIE_LIFETIME', 2592000); //30 days in seconds
define('AUTH_TOKEN_ALIVE_DAYS', 7);

ini_set("session.gc_maxlifetime", SESSION_LIFETIME);
session_start();


try {
    $pdo = new PDO(DB_CONN, DB_USER, DB_PASS, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode='STRICT_ALL_TABLES'"
    ]);
} catch (PDOException $e) {
    die("db connection exception: " . addslashes($e->getCode() . ' ' . var_dump($e)));
}
