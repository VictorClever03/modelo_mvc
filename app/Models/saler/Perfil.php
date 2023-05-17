<?php

namespace App\Models\Saler;

use App\Libraries\Conexao;

class Perfil
{

    private $db;
    public function __construct()
    {
        $this->db = new Conexao();
    }

      // perfil

      public function updateperfil($data){
        $this->db->query("UPDATE usuario SET nome=:nome, email=:email WHERE id=:id");
        $this->db->bind(':nome',$data['nome']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':id',$data['id']);
        if ($this->db->executa() AND $this->db->total()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function viewperfil($id){
        $this->db->query("SELECT * FROM usuario WHERE id=:id");
        $this->db->bind(':id',$id);
        if ($this->db->executa()and $this->db->total()) {
            return $this->db->resultado();
        } else {
            return false;
        }
    }
   
    // public function storeupload(){
    //     $caminho='/public/img/undraw_profile_2.svg';
    //     $id=$this->db->ultimoid();
    //     $this->db->query("INSERT INTO uploads(path,id_usuario) VALUES(:pathh, :id_usuarios)");
    //     $this->db->bind(':pathh',$caminho);
    //     $this->db->bind(':id_usuarios',$id);
    //     if ($this->db->executa()AND $this->db->total()) {
    //         return true;
    //     } else {
    //         return false;
    //     } 
    // }
    public function updateupload($data){
        $this->db->query("UPDATE usuario SET imagem=:pathh WHERE id=:id_usuarios ");
        $this->db->bind(':pathh',$data['path']);
        $this->db->bind(':id_usuarios',$data['id']);
        if ($this->db->executa() AND $this->db->total()) {
            return true;
        } else {
            return false;
        }
    }
    // public function readupload($id){
    //     $this->db->query("SELECT * FROM uploads WHERE id_usuario = :id");
    //     $this->db->bind(':id',$id,'');
    //     if($this->db->executa() AND $this->db->total()){
    //         return $this->db->resultado();
    //     }else{
    //         return false;
    //     }
    // }
    public function deletefotos($data)
    {
        $this->db->query("UPDATE usuario SET imagem=:path WHERE id=:id");
        $this->db->bind(':path',$data['path']);
        $this->db->bind(':id',$data['id']);
        if ($this->db->executa() ) {
            return true;
        } else {
            return false;
        }
    }
    public function newpass($data, int $id)
    {
        $this->db->query("UPDATE usuario SET senha=:senha WHERE id=:id");
        $this->db->bind(':senha',$data['novasenha']);
        $this->db->bind(':id',$id);
        if ($this->db->executa() AND $this->db->total()) {
            return true;
        } else {
            return false;
        }
    }
}




