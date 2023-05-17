<?php
namespace App\Models\admin;

use App\Libraries\Conexao;

class Categoria
 {

   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }

    public function checa_nome(string $nome){
        $this->db->query("SELECT nome FROM categoria WHERE nome=:nome");
        $this->db->bind(':nome', $nome);
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
    
    public function store_c(Array $data){
        $this->db->query("INSERT INTO categoria(nome, descricao, status) VALUES(:nome, :descricao, :status)");
        
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':descricao', $data['descricao']);
        $this->db->bind(':status', $data['status']);


        if ($this->db->executa() AND $this->db->total()) {
            return true;
        }
        else{ 
            return false;
        }
    }

    public function read_c()
    {
        $this->db->query("SELECT * FROM  categoria");

        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultados();
            return $resultado;

        else :
            return false;
        
        endif; 
    }
    public function read1_c(int $id)
    {
        $this->db->query("SELECT * FROM  categoria WHERE id=:id");
        $this->db->bind(':id',$id);
        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultado();
            return $resultado;

        else :
            return false;
        
        endif; 
    }

    public function edit_c(int $id)
    {
        $this->db->query("SELECT * FROM categoria WHERE id=:id");
        $this->db->bind(':id',$id);
        if($this->db->executa() AND $this->db->total()):
            $resultado = $this->db->resultado();
            return $resultado;
        else:
            return false;
        endif;
    }
    public function update_c(array $dados, int $id)
    {
        $this->db->query("UPDATE categoria SET nome=:nome , descricao=:descricao , status=:status WHERE id=:id");
        $this->db->bind(':nome',$dados['nome']);
        $this->db->bind(':descricao',$dados['descricao']);
        $this->db->bind(':status',$dados['status']);
        $this->db->bind(':id',$id);
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
    public function delete_c(int $id)
    {
        $this->db->query('DELETE FROM categoria WHERE id=:id');
        $this->db->bind(':id',$id);
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
    public function storeupload(){
        $caminho='public/img/undraw_profile_2.svg';
        $id=$this->db->ultimoid();
        $this->db->query("INSERT INTO uploads(path,id_usuario) VALUES(:pathh, :id_usuarios)");
        $this->db->bind(':pathh',$caminho,'');
        $this->db->bind(':id_usuarios',$id,'');
        if ($this->db->executa()AND $this->db->total()) {
            return true;
        } else {
            return false;
        } 
    }
 }