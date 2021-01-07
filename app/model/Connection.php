<?php 
$params = parse_ini_file('../../database.ini');
if ($params === false) {
    throw new \Exception("Error reading database configuration file");
}
// connect to the postgresql database
$conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
        $params['host'], 
        $params['port'], 
        $params['database'], 
        $params['user'], 
        $params['password']);

$pdo = new \PDO($conStr);

$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);