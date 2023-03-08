<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class Post extends Controller
{
    private $Postmodel;
    public function __construct()
    {
        $this->Postmodel = $this->model('Post');
        if (Sessao::restrito()) :
            Url::redireciona('usuarios/login');
        endif;
    }

    public function index()
    {
        $Ldados = [
            'posts' => $this->Postmodel->lerPost()
        ];
        $this->view("posts/index", $Ldados);
    }
    public function cadastrar()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //   var_dump($formulario);
        if (isset($formulario['cad'])) :
            $dado = [
                'titulo' => trim($formulario['titulo']),
                'mensagem' => trim($formulario['mensagem']),
                'usuario_id' => $_SESSION['usuario_id'],
                'erro_titulo' => '',
                'erro_mensagem' => ''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dado['erro_titulo'] = "preencha o campo titulo";
                endif;

                if (empty($formulario['mensagem'])) :
                    $dado['erro_mensagem'] = "preencha o campo mensagem";
                endif;

            else :
                if ($this->Postmodel->armazena($dado)) :
                    Sessao::mensagem('post', 'Post cadastrado com sucesso');
                    Url::redireciona('post');
                else :
                    die('Erro com banco de dados, consulte o programdor');
                endif;

                var_dump($dado);


            endif;

        else :
            $dado = [
                'titulo' => '',
                'mensagem' => '',
                'erro_titulo' => '',
                'erro_mensagem' => ''
            ];
        endif;






        $this->view("posts/cadastrar", $dado);
    }
    public function ver($id)
    {
        $post=$this->Postmodel->lerpostcada($id);
        if($post ==null){
            Url::redireciona('paginas/error');
        }
        $dados = [
            'posts' => $post
        ];
        $this->view('posts/ver', $dados);
    }
    public function verusuarios()
    {
        $id = $_SESSION['usuario_id'];
        $dados = [
            'posts' => $this->Postmodel->lerPostusuarios($id)
        ];
        $this->view('posts/verusuarios', $dados);
    }

    public function editar($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($formulario);
        //echo "<br>$id<br>";
        if (isset($formulario['cad'])) :
            $dado = [
                'titulo' => trim($formulario['titulo']),
                'mensagem' => trim($formulario['mensagem']),
                'erro_titulo' => '',
                'erro_mensagem' => '',
                'id' => $id
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dado['erro_titulo'] = "preencha o campo titulo";
                endif;

                if (empty($formulario['mensagem'])) :
                    $dado['erro_mensagem'] = "preencha o campo mensagem";
                endif;

            else :

                $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
                if ($id and $metodo == 'POST') :
                    if ($this->Postmodel->actualiza($dado)) :
                    
                        Sessao::mensagem('post', 'Post Actualizado com sucesso');
                        Url::redireciona('post');
                    else :
                        Sessao::mensagem('post', 'Post Nao Actualizado');
                        Url::redireciona('post');
                    endif;
                endif;


            endif;

        else :
            $post = $this->Postmodel->lerpostcada($id);
            if (Sessao::restrito1($post['idusuarios'])) :
                Sessao::mensagem('post', 'Não autorizado para editar', 'alerta');
                Url::redireciona('post');
            endif;
            $dado = [
                'titulo' => $post['titulo'],
                'mensagem' => $post['mensagem'],
                'erro_titulo' => '',
                'erro_mensagem' => '',
                'id' => $post['idposts']
            ];
        endif;



        $this->view("posts/editar", $dado);
    }
    public function deletar($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
       
        $post = $this->Postmodel->lerpostcada($id);
        if (Sessao::restrito1($post['idusuarios'])) :
            Sessao::mensagem('post', 'Não autorizado para deletar', 'alerta');
            Url::redireciona('post');
        else :
           
            
            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
            
            if ($id and $metodo == 'POST') :
                if ($this->Postmodel->deletar($id)) :
                    Sessao::mensagem('post', 'Post deletado com sucesso');
                    Url::redireciona('post');
               
                else :
                    die("Erro com banco de dados, consulte um programador!");
                endif;
            else:
                die("Erro com banco de dados, consulte um programador!");

            endif;

        endif;
    }
}
