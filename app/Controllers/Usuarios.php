<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Helpers\Valida;
use App\Libraries\Controller;

class Usuarios extends Controller
{
    private $Data;
    public function __construct()
    {
        $this->Data = $this->model('Usuarios');
    }
    public function index(){
        $page = 'php';
        return $this->view('layouts/app',compact('page'));
        
    }
    public function cadastrar()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($formulario);
        if (isset($formulario)) :
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'c_senha' => trim($formulario['c_senha']),
                'data' => trim($formulario['data']),
                'erro_nome'=>'',
                'erro_senha'=>'',
                'erro_email'=>'',
                'erro_c_senha'=>'',
                'erro_data'=>''
            ];
            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados['erro_nome'] = "preencha o campo nome";
                endif;

                if (empty($formulario['email'])) :
                    $dados['erro_email'] = "preencha o campo email";
                endif;

                if (empty($formulario['senha'])) :
                    $dados['erro_senha'] = "preencha o campo senha";
                endif;

                if (empty($formulario['c_senha'])) :
                    $dados['erro_c_senha'] = "Repita a senha";
                endif;

                if (empty($formulario['data'])) :
                    $dados['erro_data'] = "preencha o campo data de nascimento";
                endif;

            else :
                if (Valida::email($formulario['email'])) :
                    $dados['erro_email'] = "preencha corretamente o email";
                    
                elseif ($this->Data->checaemail($formulario['email'])) :
                    $dados['erro_email'] = "Email ja cadastrado";

                elseif (Valida::senhatamanho($formulario['senha'])) :
                    $dados['erro_senha'] = "preencha no maximo 8 digitos";

                elseif (Valida::samepass($formulario['senha'], $formulario['c_senha'])) :
                    $dados['erro_c_senha'] = "Senhas diferentes";


                else :

                    $dados['senha'] = Valida::pass_segura($formulario['senha']);
                    $cadastrar=$this->Data->armazena($dados);
                    if ($cadastrar) :
                        Sessao::mensagem('usuario','Cadastrado com sucesso');
                        Url::redireciona('usuarios/login');
                    else :
                        die(Sessao::mensagem('usuario','Erro com banco de dados', 'alerta'));
                    endif;

                endif;

            endif;
        // var_dump($formulario);
        else :
            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'c_senha' => '',
                'data' => '',
                'erro_nome'=> '',
                'erro_email'=>'',
                'erro_senha'=>'',
                'erro_c_senha'=>'',
                'erro_data'=>''
            ];
        endif;


        $this->view('usuarios/cadastrar', $dados);
    }
    public function login()
    {
        if (!Sessao::restrito()) :
            
            Url::redireciona('home');
        endif;

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //  var_dump($formulario);
        if (isset($formulario['log'])) :
            $dado = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'erro_email'=>'',
                'erro_senha'=>''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['email'])) :
                    $dado['erro_email'] = "preencha o campo email";
                endif;

                if (empty($formulario['senha'])) :
                    $dado['erro_senha'] = "preencha o campo senha";
                endif;

            else :
                if (Valida::email($formulario['email'])) :
                    $dado['erro_email'] = "preencha corretamente o email";
                else :
                    $checarlogin=$this->Data->checalogin($dado['email'],$dado['senha'],0);
                    if ($checarlogin) :
                        Sessao::mensagem('usuarios','Login realizado com sucesso');
                        Url::redireciona('home');
                        
                         $this->criarsessao($checarlogin);
                        // var_dump($_SESSION);
                        
                    else :
                        Sessao::mensagem('usuario','Dados Invalidos','alerta');
                        $dado['erro_email'] = "Dados invalidos";
                        $dado['erro_senha'] = "Dados invalidos";
                    endif;
                        
                endif;

            endif;
        //  var_dump($formulario);
        else :
            $dado = [
                'email' => '',
                'senha' => '',
                'erro_email'=>'',
                'erro_senha'=>''
            ];
        endif;



        $this->view('usuarios/login', $dado);
    }
    private function  criarsessao($usuario){
        
        $_SESSION['usuario_id']= $usuario['id'];
        $_SESSION['usuario_nome']= $usuario['nome'];
        $_SESSION['usuario_email']= $usuario['email'];
       
    }
    public function sair(){
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);
        session_destroy();
        Url::redireciona('usuarios/login');
    }
}
