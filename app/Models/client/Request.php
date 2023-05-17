<?php

namespace App\Models\client;

use App\Libraries\Conexao;

class Request
{

  private $db;
  public function __construct()
  {
    $this->db = new Conexao();
  }

  public function getRequestsR()
  {
    $this->db->query("SELECT *, pedido.id as pe_id, refeicoes.id as re_id, refeicoes.nome as re_nome, pedido.preco as pe_preco, refeicoes.preco as re_preco, refeicoes.imagem as re_img, pedido.status as pe_status, refeicoes.status as re_status, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN refeicoes on pedido.refeicoes = refeicoes.id  WHERE pedido.status = :status AND pedido.escola= :iduser");
    $this->db->bind(":status", "0");
    $this->db->bind(":iduser", $_SESSION['usuarioC_id']);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }
  public function getRequestsP()
  {
    $this->db->query("SELECT *, pedido.id as pe_id, produto.id as pr_id, produto.nome as pr_nome, pedido.preco as pe_preco, produto.preco as pr_preco, produto.imagem as pr_img, pedido.status as pe_status, pedido.create_at as pe_create, pedido.update_at as pe_update, produto.create_at as pr_create, produto.update_at as pr_upadate FROM pedido INNER JOIN produto on pedido.produto = produto.id  WHERE pedido.status = :status AND pedido.escola= :iduser");
    $this->db->bind(":status", "0");
    $this->db->bind(":iduser", $_SESSION['usuarioC_id']);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }

  public function getAllRequest()
  {
    $this->db->query("SELECT * FROM pedido WHERE pedido.status = :status AND pedido.escola = :iduser ");
    $this->db->bind(":status", "0");
    $this->db->bind(":iduser", $_SESSION['usuarioC_id']);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }

  public function confirmRequest()
  {
    $this->db->query("UPDATE pedido SET pedido.status = :status, pedido.update_at = CURRENT_TIMESTAMP() WHERE pedido.escola = :iduser AND pedido.status=:zero");
    $this->db->bind(":status", "1");
    $this->db->bind(":zero", "0");
    $this->db->bind(":iduser", $_SESSION['usuarioC_id']);
    if ($this->db->executa() and $this->db->total()) {
      return true;
    } else {
      return false;
    }
  }

  public function totalRequest()
  {
    $this->db->query("SELECT count(id) as total FROM pedido WHERE pedido.escola= :iduser AND pedido.status = :status");
    $this->db->bind(":status", "0");
    $this->db->bind(":iduser", $_SESSION['usuarioC_id']);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }



  public function deleteRequest($id)
  {
    $this->db->query("DELETE FROM pedido WHERE id=:id");
    $this->db->bind(":id", $id);
    if ($this->db->executa() and $this->db->total()) {
      return true;
    } else {
      return false;
    }
  }
  public function getNotify($id)
  {
    $this->db->query("SELECT notify FROM pedido WHERE pedido.escola=:idClient AND pedido.notify=:notify LIMIT 1");
    $this->db->bind(":notify", "ON");
    $this->db->bind(":idClient", $id);
    if ($this->db->executa() and $this->db->total()) {
      return $this->db->resultado();
    } else {
      return false;
    }
  }
}
