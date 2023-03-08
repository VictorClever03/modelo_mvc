<?php

namespace App\Models;

use App\Libraries\Conexao;

class Post
{
    private $db;
    public function __construct()
    {
        $this->db = new Conexao;
    }
    public function armazena(array $data)
    {
        $this->db->query("INSERT INTO posts(titulo, mensagem, id_usuarios) VALUES(:titulo, :mensagem, :usuario_id)");

        $this->db->bind(':titulo', $data['titulo'], "");
        $this->db->bind(':mensagem', $data['mensagem'], "");
        $this->db->bind(':usuario_id', $data['usuario_id'], "");

        if ($this->db->executa()and $this->db->total()) {
            return true;
        } else {
            return false;
        }
    }
    public function lerPost()
    {
        $this->db->query("SELECT *, posts.id as idposts, posts.criado_em as dataposts, usuarios.id as idusuarios, usuarios.criado_em as datausuarios  FROM posts INNER JOIN usuarios ON posts.id_usuarios=usuarios.id ORDER BY dataposts DESC");
       
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
           return $this->db->resultados();
        endif;
    }
    // ler meus posts
    public function lerPostusuarios($data)
    {
        $this->db->query("SELECT * FROM posts WHERE id_usuarios=:usuariologado ORDER BY id DESC");
        $this->db->bind(':usuariologado',$data,"");
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
           return $this->db->resultados();
        endif;
    }
    public function actualiza($data)
    {
        $this->db->query("UPDATE posts SET titulo=:titulo, mensagem=:texto WHERE id=:id");
        $this->db->bind(':titulo',$data['titulo'],"");
        $this->db->bind(':texto',$data['mensagem'],"");
        $this->db->bind(':id',$data['id'],"");
        
        if ($this->db->executa() AND $this->db->total()) :
           return true;
        else:
            return false;
        endif;
    }
    public function lerpostcada($id)
    {
        $this->db->query("SELECT *, posts.id as idposts, posts.criado_em as dataposts, usuarios.id as idusuarios, usuarios.criado_em as datausuarios  FROM posts INNER JOIN usuarios ON posts.id_usuarios=usuarios.id WHERE posts.id=:id");
        $this->db->bind(':id', $id, "");
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
           return $this->db->resultado();
        endif;
    }
    public function deletar($id){
        $this->db->query("DELETE FROM posts WHERE id=:id");
        $this->db->bind(':id',$id,'');
        
        if ($this->db->executa() and $this->db->total()) {
            return true;
        } else {
            return false;
        }
    }
}
