<?php

namespace App\Models\saler;

use App\Libraries\Conexao;

class Request
{

  private $db;
  public function __construct()
  {
    $this->db = new Conexao();
  }



  public function getAllRequest()
  {
    $this->db->query("SELECT DISTINCT *, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN escola ON pedido.escola = escola.id WHERE pedido.status = :status GROUP BY pedido.escola ORDER BY pedido.create_at DESC");
    $this->db->bind(":status", "1");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }

  public static function getRequestsR($id)
  {
    $db = new Conexao();

    $db->query("SELECT *, pedido.id as pe_id, refeicoes.id as re_id, refeicoes.nome as re_nome, pedido.preco as pe_preco, refeicoes.preco as re_preco, refeicoes.imagem as re_img, pedido.status as pe_status, refeicoes.status as re_status, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN refeicoes on pedido.refeicoes = refeicoes.id  WHERE pedido.status = :status AND pedido.escola = :idClient ORDER BY pedido.id DESC");
    $db->bind(":status", "1");
    $db->bind(":idClient", $id);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultados();
      return $result;
    } else {
      return false;
    }
  }
  public static function getRequestsP($id)
  {
    $db = new Conexao();

    $db->query("SELECT *, pedido.id as pe_id, produto.id as pr_id, produto.nome as pr_nome, pedido.preco as pe_preco, produto.preco as pr_preco, produto.imagem as pr_img, pedido.status as pe_status, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN produto on pedido.produto = produto.id  WHERE pedido.status = :status AND pedido.escola = :idClient ");
    $db->bind(":status", "1");
    $db->bind(":idClient", $id);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultados();
      return $result;
    } else {
      return false;
    }
  }

  public static function getSumTotal($id)
  {
    $db = new Conexao();

    $db->query("SELECT SUM(pedido.preco * pedido.qtd) AS total FROM pedido WHERE pedido.status=:status AND pedido.escola=:idClient ORDER BY pedido.escola ASC;");
    $db->bind(":status", "1");
    $db->bind(":idClient", $id);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultado();
      return $result;
    } else {
      return false;
    }
  }



  public function totalRequest()
  {
    $this->db->query("SELECT count(DISTINCT pedido.escola) as totalpedidos FROM pedido WHERE pedido.status = :status LIMIT 1");
    $this->db->bind(":status", "1");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }


  public function notifyUser($id)
  {
    $this->db->query("UPDATE pedido SET pedido.notify = :value WHERE pedido.escola = :idClient AND pedido.status=:status");
    $this->db->bind(":value", "ON");
    $this->db->bind(":status", "1");
    $this->db->bind(":idClient", $id);
    if ($this->db->executa() and $this->db->total()) {
      return true;
    } else {
      return false;
    }
  }

  public function confirmRequest($id,$data)
  {
    $this->db->query("UPDATE pedido SET pedido.status = :status, pedido.notify=:value,  pedido.update_at = CURRENT_TIMESTAMP() WHERE pedido.escola = :idClient AND pedido.update_at = :data");
    $this->db->bind(":status", "2");
    $this->db->bind(":value", "OFF");
    $this->db->bind(":data", $data);
    $this->db->bind(":idClient", $id);
    if ($this->db->executa() and $this->db->total()) {
      return true;
    } else {
      return false;
    }
  }



  public function historico()
  {

    $this->db->query("SELECT DISTINCT *, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN escola ON pedido.escola = escola.id WHERE pedido.status = :status AND DATE(pedido.update_at)=CURDATE() GROUP BY pedido.update_at ORDER BY pedido.update_at DESC");
    $this->db->bind(":status", "2");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }

  public static function getRequestsRH($data)
  {
    $db = new Conexao();

    $db->query("SELECT *, pedido.id as pe_id, refeicoes.id as re_id, refeicoes.nome as re_nome, pedido.preco as pe_preco, refeicoes.preco as re_preco, refeicoes.imagem as re_img, pedido.status as pe_status, refeicoes.status as re_status, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN refeicoes on pedido.refeicoes = refeicoes.id  WHERE pedido.status = :status AND pedido.update_at = :data ORDER BY pedido.id DESC");
    $db->bind(":status", "2");
    $db->bind(":data", $data);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultados();
      return $result;
    } else {
      return false;
    }
  }
  public static function getRequestsPH($data)
  {
    $db = new Conexao();

    $db->query("SELECT *, pedido.id as pe_id, produto.id as pr_id, produto.nome as pr_nome, pedido.preco as pe_preco, produto.preco as pr_preco, produto.imagem as pr_img, pedido.status as pe_status, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN produto on pedido.produto = produto.id  WHERE pedido.status = :status AND pedido.update_at = :data ");
    $db->bind(":status", "2");
    $db->bind(":data", $data);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultados();
      return $result;
    } else {
      return false;
    }
  }
  public static function getSumTotalH($data)
  {
    $db = new Conexao();

    $db->query("SELECT SUM(pedido.preco * pedido.qtd) AS total FROM pedido WHERE pedido.status=:status AND pedido.update_at=:data ORDER BY pedido.update_at ASC;");
    $db->bind(":status", "2");
    $db->bind(":data", $data);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  
}
