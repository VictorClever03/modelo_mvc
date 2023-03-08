<?php
namespace App\Models;

use App\Helpers\Valida;
use App\Libraries\Conexao;

class Usuarios {
   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }
    public function checaemail(string $email){
        $this->db->query("SELECT email FROM usuarios WHERE email=:e");
        $this->db->bind(':e',$email,"");
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
    public function armazena(Array $data){
        $this->db->query("INSERT INTO usuarios(nome, email, senha, data_nascimento) VALUES(:nome, :email, :senha, :datta)");
        
        $this->db->bind(':nome', $data['nome'],"");
        $this->db->bind(':email', $data['email'], "");
        $this->db->bind(':senha', $data['senha'], "");
        $this->db->bind(':datta', $data['data'], "");


        if ($this->db->executa()) {
            return true;
        }
        else{ 
            return false;
        }
    }

    public function checalogin($email,$senha,$nivel){
        $this->db->query("SELECT * FROM usuarios WHERE email=:e");
        $this->db->bind(':e',$email,"");
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            $resultado=$this->db->resultado();
        
                 if (password_verify($senha, $resultado['senha']) AND $resultado['nivel']==$nivel) :
                    return $resultado;
                else:
                    return false;
                endif;
                
        else:
            return false;
        endif;
    }
}