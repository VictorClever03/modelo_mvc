<?php
namespace App\Models\admin;

use App\Libraries\Conexao;

class Fornecedores  
 {

   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }

    public function list(){
        $this->db->query("SELECT * FROM fornecedor ORDER BY id DESC");
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            return $this->db->resultados();
        else:
            return false;
        endif;
    }
    
    public function store($data){
      
        $this->db->query("INSERT INTO fornecedor(nome, contacto, email, endereco) VALUES(:nome, :contacto, :email, :endereco)");
        
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':contacto', $data['contacto']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':endereco', $data['endereco']);


        if ($this->db->executa() AND $this->db->total()) {
            return true;
        }
        else{ 
            return false;
        }
    }

    public function get($id)
    {
        $this->db->query("SELECT * FROM  fornecedor WHERE id = :id");
        $this->db->bind(":id",$id);
        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultado();
            return $resultado;

        else :
            return false;
        
        endif; 
    }
    public function delete(int $id)
    {
      $this->db->query('DELETE FROM fornecedor WHERE id=:id');
      $this->db->bind(':id',$id);
      if($this->db->executa() AND $this->db->total()):
          return true;
      else:
          return false;
      endif;
    }

    public function update($dados,$id)
    {
      $this->db->query("UPDATE fornecedor SET nome=:nome , contacto=:contacto , email=:email, endereco=:endereco WHERE id=:id");
      $this->db->bind(':nome',$dados['nome']);
      $this->db->bind(':contacto',$dados['contacto']);
      $this->db->bind(':email',$dados['email']);
      $this->db->bind(':endereco',$dados['endereco']);
      $this->db->bind(':id',$id);
      if($this->db->executa() AND $this->db->total()):
          return true;
      else:
          return false;
      endif;
    }
   
 }