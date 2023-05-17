<?php

namespace App\Models\password;

use App\Libraries\Conexao;

class Password
{

  private $db;
  public function __construct()
  {
    $this->db = new Conexao();
  }

  //  forget password

  public function getUserEmail($email)
  {
    $this->db->query("SELECT * FROM usuario WHERE email=:email LIMIT 1");
    $this->db->bind(':email', $email);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) :
      $resultado = $this->db->resultado();
      return $resultado;
    else :
      return false;
    endif;
  }
  public function storeEmailKey($key, $email)
  {
    $this->db->query("UPDATE usuario SET recover_pass=:recover WHERE email=:email");
    $this->db->bind(':recover', $key);
    $this->db->bind(':email', $email);
    if ($this->db->executa() and $this->db->total()) :
      return true;
    else :
      return false;
    endif;
  }

  public function getUserNumber($number)
  {
    $this->db->query("SELECT * FROM escola WHERE numero=:numero LIMIT 1");
    $this->db->bind(':numero', $number);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) :
      $resultado = $this->db->resultado();
      return $resultado;
    else :
      return false;
    endif;
  }
  public function storeKeyNumber($key, $numero)
  {
    $this->db->query("UPDATE escola SET recover_pass=:recover WHERE numero=:numero");
    $this->db->bind(':recover', $key);
    $this->db->bind(':numero', $numero);
    if ($this->db->executa() and $this->db->total()) :
      return true;
    else :
      return false;
    endif;
  }

  // verify code match
  public function checkEmailKey($dados)
  {
    $this->db->query("SELECT * FROM usuario WHERE email=:email AND recover_pass=:recover");
    $this->db->bind(':email', $dados['email']);
    $this->db->bind(':recover', $dados['key']);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) :
      $resultado = $this->db->resultado();
      return $resultado;

    else :
      return false;
    endif;
  }
  public function checkNumberKey($dados)
  {
    $this->db->query("SELECT * FROM escola WHERE numero=:numero AND recover_pass=:recover");
    $this->db->bind(':numero', $dados['number']);
    $this->db->bind(':recover', $dados['key']);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) :
      $resultado = $this->db->resultado();
      return $resultado;

    else :
      return false;
    endif;
  }
  
  public function newEmailPass($dados)
  {
    $this->db->query("UPDATE usuario SET recover_pass=Null, senha=:senha WHERE email=:email");
    $this->db->bind(':senha', $dados['newpass']);
    $this->db->bind(':email', $dados['email']);
    if ($this->db->executa() and $this->db->total()) :
      return true;
    else :
      return false;
    endif;
  }
  public function newNumberPass($dados)
  {
    $this->db->query("UPDATE escola SET recover_pass=Null, senha=:senha WHERE numero=:number");
    $this->db->bind(':senha', $dados['newpass']);
    $this->db->bind(':number', $dados['number']);
    if ($this->db->executa() and $this->db->total()) :
      return true;
    else :
      return false;
    endif;
  }
  
}
