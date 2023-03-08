<?php



global $base_url;
global $auth;
global $projecto;


$base_url = getenv('BASE_URL')? getenv('BASE_URL'):'http://localhost:8080/refeitorio/';
$auth = getenv('AUTH_SESSION_KEY')? getenv('AUTH_SESSION_KEY'):'AUTH_USER';
$projecto = getenv('APP_NAME')? getenv('APP_NAME'):'Projecto';


define('URL',$base_url);
define('AUTH_SESSION_KEY',$auth);
define('APP_NOME',$projecto);
define('APP', dirname(__FILE__));

define('DB',[
    'HOST'=>getenv('DB_HOST'),
    'PORT'=>getenv('DB_PORT'),
    'USER'=>getenv('DB_USEER'),
    'PASS'=>getenv('DB_PASS'),
    'DBNAME'=>getenv('DB_NAME'),
    'SGBD'=>getenv('DB_SGBD')
]);



