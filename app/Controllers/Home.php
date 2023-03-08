<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class Home extends Controller
{
    public function index(){
        $page = 'php';
        
    $this->view('layouts/app',compact('page'));
        
    }
}