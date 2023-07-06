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


