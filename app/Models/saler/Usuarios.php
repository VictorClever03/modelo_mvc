<?php
namespace App\Models\saler;

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
    
}