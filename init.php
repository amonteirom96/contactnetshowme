<?php
$params = parse_ini_file('database.ini');
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

$sqlCreateTableContact = "CREATE TABLE contacts (
	id serial PRIMARY KEY,
	name VARCHAR ( 255 ) NOT NULL,
	email VARCHAR ( 255 ) NOT NULL,
	telephone VARCHAR ( 255 ),
    message TEXT,
    file VARCHAR ( 255 ) NOT NULL,
    ip_client VARCHAR ( 14 ),
	created TIMESTAMP NOT NULL
);";
$stmt = $pdo->prepare($sqlCreateTableContact);
$create = $stmt->execute();

if($create)
    echo "Finishing process";
else
    echo "Error in create contact table";

die;