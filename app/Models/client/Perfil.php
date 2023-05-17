<?php

namespace App\Models\client;

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
        $this->db->query("UPDATE escola SET nome=:nome, numero=:telefone WHERE id=:id");
        $this->db->bind(':nome',$data['nome']);
        $this->db->bind(':telefone',$data['telefone']);
        $this->db->bind(':id',$data['id']);
        if ($this->db->executa() AND $this->db->total()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function viewperfil($id){
        $this->db->query("SELECT * FROM escola WHERE id=:id");
        $this->db->bind(':id',$id);
        if ($this->db->executa()and $this->db->total()) {
            return $this->db->resultado();
        } else {
            return false;
        }
    }
   
   
    public function updateupload($data){
        $this->db->query("UPDATE escola SET imagem=:pathh WHERE id=:id ");
        $this->db->bind(':pathh',$data['path']);
        $this->db->bind(':id',$data['id']);
        if ($this->db->executa() AND $this->db->total()) {
            return true;
        } else {
            return false;
        }
    }
   
    public function deletefotos($data)
    {
        $this->db->query("UPDATE escola SET imagem=:path WHERE id=:id");
        $this->db->bind(':path',$data['path']);
        $this->db->bind(':id',$data['id']);
        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }
    public function newpass($data, int $id)
    {
        $this->db->query("UPDATE escola SET senha=:senha WHERE id=:id");
        $this->db->bind(':senha',$data['novasenha']);
        $this->db->bind(':id',$id);
        if ($this->db->executa() AND $this->db->total()) {
            return true;
        } else {
            return false;
        }
    }
}




