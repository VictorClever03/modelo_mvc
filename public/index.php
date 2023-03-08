<?php
session_start();
ob_start();
use App\Helpers\Sessao;
use App\Libraries\Router;
include '../app/config/phperror.php';
include '../vendor/autoload.php';
include '../app/config/config.php';
// use App\Libraries\Conexao;
// $db= new conexao;
// $db->query("INSERT INTO usuarios (nome,email,senha) VALUES('victor','clever','123')");
// $db->executa();
$rota = new Router;





