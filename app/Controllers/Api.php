<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class  Api  extends Controller
{

  private $Request;
  private $Notify;
  private $Count;
  public function __construct()
  {
    $this->Request = $this->model("client\Home");
    $this->Notify = $this->model("client\Request");
    $this->Count = $this->model("saler\Request");
  }

  public function index()
  {
    $data = $this->Request->getProducts();

    $products = [];

    foreach ($data as $key => $value) {

      $product = [
        "id" => $value['p_id'],
        "image" => $value['imagem'],
        "title" => $value['p_nome'],
        "price" => $value['preco'],
        "category_id" => $value['c_id'],
        "inCart" => 0
      ];

      array_push($products, $product);
    }

    echo json_encode($products);
  }
  public function getDishes()
  {
    $data = $this->Request->getFood();
    $dishes = [];

    foreach ($data as $key => $value) {

      $dish = [
        "id" => $value['id'],
        "image" => $value['imagem'],
        "title" => $value['nome'],
        "price" => $value['preco'],
        "inCart" => 0
      ];

      array_push($dishes, $dish);
    }

    echo json_encode($dishes);
  }
  public function post()
  {
    // URL da API
    $url = 'http://exemplo.com/api';

    // Dados que serão enviados na requisição
    $data = array('nome' => 'Clever', 'idade' => '30');

    // Inicializa a sessão cURL
    $ch = curl_init();

    // Define as opções da requisição
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executa a requisição e armazena a resposta em uma variável
    $resposta = curl_exec($ch);

    // Fecha a sessão cURL
    curl_close($ch);

    // Exibe a resposta da API
    echo $resposta;
  }

  public function countRequestSaler()
  {
    $total=$this->Count->totalRequest();
    // var_dump($total);
    echo json_encode($total);
  }
  public function notify($id)
  {
    
    $id=filter_var($id,FILTER_VALIDATE_INT);
    $notify=$this->Notify->getNotify($id);
    // var_dump($notify);

    echo json_encode($notify);
  }
}
