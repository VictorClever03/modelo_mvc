<?php
namespace App\Models\client;

use App\Libraries\Conexao;

class Usuarios {

   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }

   

    public function checalogin($nome,$senha){
        $this->db->query("SELECT * FROM escola WHERE nome=:nome");
        $this->db->bind(':nome',$nome);
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            $resultado=$this->db->resultado();
        
                 if (password_verify($senha, $resultado['senha'])) :
                    return $resultado;
                else:
                    return false;
                endif;
                
        else:
            return false;
        endif;
    }
    public function checanome(string $nome){
        $this->db->query("SELECT nome FROM escola WHERE nome=:nome");
        $this->db->bind(':nome',$nome);
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
    public function storeuser($dados){
        $this->db->query("INSERT INTO escola(nome, numero, senha, imagem) VALUES(:nome, :telefone, :senha, :imagem)");
        $this->db->bind(':nome',$dados['nome']);
        $this->db->bind(':telefone',$dados['telefone']);
        $this->db->bind(':senha',$dados['senha']);
        $this->db->bind(':imagem',$dados['imagem']);
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
}