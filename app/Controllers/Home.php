<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class  Home  extends Controller
{
  private $Food;
  public function __construct()
  {
   
    // $this->Food = $this->model("client\Home");
  }
  public function index($id=null)
  {
    // if (Sessao::nivel2()) : 
    //   Url::redireciona('client');
    // endif;
    // echo "oit";
    // $allFood = $this->Food->getFood();
    // $refresh = $this->Food->getRefrigerante();
    // var_dump($refresh);
    // exit;

var_dump($id);
    $file = 'homepage';
    return $this->view('layouts/client/app', compact('file'));
  }
  public function about()
  {
     echo "ABOUT";
  }
}
