<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

if (getenv('JAWSDB_URL') !== false){
    $dbparts = parse_url(getenv('JAWSDB_URL'));
    
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');
} else {
    $username = 'root';
    $password = '';
    $database ='test';
    $hostname = 'localhost';
}

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "connection failed: " .$e->getMessage();
}


$query = $pdo->prepare("INSERT INTO users (nom,age) VALUES (?,?)");
$query->execute(['Jonathan', 30]);

$query = $pdo->prepare("INSERT INTO users (nom,age) VALUES (?,?)");
$query->execute(['Celine', 27]);
