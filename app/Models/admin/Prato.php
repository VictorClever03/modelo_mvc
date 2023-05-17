<?php

namespace App\Models\admin;

use App\Libraries\Conexao;

class Prato
{

    private $db;
    public function __construct()
    {
        $this->db = new Conexao();
    }
    public function prato_read(){
        $this->db->query("SELECT * FROM refeicoes");
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()){
            return $this->db->resultados();
        }else{
            return false;
        }
    }
    public function prato_read1($id){
        $this->db->query("SELECT * FROM refeicoes WHERE id=:id");
        $this->db->bind(":id",$id);
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()){
            return $this->db->resultado();
        }else{
            return false;
        }
    }
    public function checa_nome(string $nome)
    {
        $this->db->query("SELECT nome FROM refeicoes WHERE nome=:nome");
        $this->db->bind(':nome', $nome );
        $this->db->executa();
        
        if ($this->db->executa() and $this->db->total() ) :
            return true;
            
        else :
            return false;
        endif;
    }
    public function store_prato($dados){
        $this->db->query("INSERT INTO refeicoes(nome,imagem,preco,status) VALUES(:nome,:imagem,:preco,:status)");
        $this->db->bind(':nome',$dados['name']);
        $this->db->bind(':imagem',$dados['img']);
        $this->db->bind(':preco',$dados['value']);
        $this->db->bind(':status',$dados['status']);
        // $this->db->executa();
        if($this->db->executa() and $this->db->total()){
            return true;
        }else{
            return false;
        }
    }
    public function update_prato($dados,$id){
        $this->db->query("UPDATE refeicoes SET nome=:nome, preco=:preco, status=:status WHERE id=:id");
        $this->db->bind(":nome",$dados['name']);
        // $this->db->bind(":img",$dados['img']);
        $this->db->bind(":preco",$dados['value']);
        $this->db->bind(":status",$dados['status']);
        $this->db->bind(":id",$id);
        // $this->db->executa();
        if($this->db->executa() and $this->db->total()){
            return true;
        }else{
            return false;
        }
    }
    public function update_prato1($dados,$id){
        $this->db->query("UPDATE refeicoes SET status=:status WHERE id=:id");
        $this->db->bind(":status",$dados);
        $this->db->bind(":id",$id);
        // $this->db->executa();
        if($this->db->executa() and $this->db->total()){
            return true;
        }else{
            return false;
        }
    }
    public function delete_prato($id){
        $this->db->query("DELETE FROM  refeicoes WHERE id = :id");
        $this->db->bind(':id',$id);
        //  $this->db->executa();
         if($this->db->executa() and $this->db->total()){
            return true;
        }else{
            return false;
        }
    }
}