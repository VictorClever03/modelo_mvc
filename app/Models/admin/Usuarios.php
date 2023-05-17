<?php
namespace App\Models\admin;

use App\Libraries\Conexao;

class Usuarios {

   private $db;
    public function __construct()
    {
       $this->db = new Conexao();
    }

    public function checalogin($nome,$senha,$nivel){
        $this->db->query("SELECT *, usuario.id as usuario_id, usuario.nome as u_nome, usuario.nivel_usuario as u_nivel, nivel_usuario.nome as n_nome, nivel_usuario.nivel as n_nivel, nivel_usuario.id as nivel_id FROM usuario inner join nivel_usuario on usuario.nivel_usuario = nivel_usuario.id WHERE usuario.nome = :nome ");
        $this->db->bind(':nome',$nome);
        $this->db->executa();
        if($this->db->executa() AND $this->db->total()):
            $resultado=$this->db->resultado();
        
                 if (password_verify($senha, $resultado['senha']) AND $resultado['n_nivel']==$nivel) :
                    return $resultado;
                else:
                    return false;
                endif;
                
        else:
            return false;
        endif;
    }
    public function checanome(string $nome){
      $this->db->query("SELECT nome FROM usuario WHERE nome=:nome");
      $this->db->bind(':nome',$nome);
      $this->db->executa();
      if($this->db->executa() AND $this->db->total()):
          return true;
      else:
          return false;
      endif;
  }
    public function createUser($data){
      $this->db->query("INSERT INTO usuario(nome, email, senha, nivel_usuario) VALUES(:nome, :email, :senha, :nivel)");
      $this->db->bind(":nome", $data['nome']); 
      $this->db->bind(":email", $data['email']);
      $this->db->bind(":senha", $data['senha']);
      $this->db->bind(":nivel", $data['nivel']);
      if($this->db->executa() AND $this->db->total()){
        return true;
      }else{
        return false;
      }
    }
    public function getUsers(){
      $this->db->query("SELECT * FROM usuario WHERE id!=:id ORDER BY id DESC");
      $this->db->bind(":id",$_SESSION['usuarios_id']);
      $this->db->executa();
      if($this->db->executa() AND $this->db->total()):
          return $this->db->resultados();
      else:
          return false;
      endif;
    }
    public function deleteUser($id){
      $this->db->query("DELETE FROM usuario WHERE id = :id");
      $this->db->bind(":id",$id);
      
      if($this->db->executa() AND $this->db->total()){
        return true;
      }else{
        return false;
      }
    }
    public function getUsersC(){
      $this->db->query("SELECT * FROM escola ORDER BY id DESC");
      $this->db->executa();
      if($this->db->executa() AND $this->db->total()):
          return $this->db->resultados();
      else:
          return false;
      endif;
    }
    public function deleteUserC($id){
      $this->db->query("DELETE FROM escola WHERE id = :id");
      $this->db->bind(":id",$id);
      
      if($this->db->executa() AND $this->db->total()){
        return true;
      }else{
        return false;
      }
    }
}