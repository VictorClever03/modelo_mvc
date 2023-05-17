<?php

namespace App\Models\admin;

use App\Libraries\Conexao;
use DateTime;
class Home
{

  private $db;
  public function __construct()
  {
    $this->db = new Conexao();
  }

  // 2

  public function recentRequest()
  {
    $this->db->query("SELECT DISTINCT *, pedido.create_at as pe_create FROM pedido INNER JOIN escola ON pedido.escola = escola.id WHERE pedido.status != :status GROUP BY pedido.escola ORDER BY pedido.create_at DESC LIMIT 7");
    $this->db->bind(":status", "0");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }
  public function totalUsers()
  {
    $this->db->query("SELECT count(usuario.id) as users FROM usuario WHERE usuario.nivel_usuario = :nivel");
    $this->db->bind(":nivel", "2");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalClients()
  {
    $this->db->query("SELECT count(escola.id) as clients FROM escola");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalForn()
  {
    $this->db->query("SELECT count(fornecedor.id) as forne FROM fornecedor");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalCategory()
  {
    $this->db->query("SELECT count(categoria.id) as category FROM categoria");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  // public function totalExpirados()
  // {
  //   $this->db->query("SELECT count(lote.id) as exp FROM lote WHERE lote.data_exp<=:data");
  //   $this->db->bind(':data', time());
  //   $this->db->executa();
  //   if ($this->db->executa() and $this->db->total()) {
  //     $result = $this->db->resultado();
  //     return $result;
  //   } else {
  //     return false;
  //   }
  //   $actual = date("Y-m-d");
  //       $data1 = new DateTime('2023-02-20');
  //       $data2 = new DateTime($actual);
  //       $diferenca = $data1->diff($data2);
  //       $dias = $diferenca->days;
  //       echo $dias;
  // }

  // 1 , mensalmente
  public function totalSales(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE YEAR(entrada_caixa.create_at) = YEAR(CURDATE()) AND MONTH(entrada_caixa.create_at) = MONTH(CURDATE());");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalCompras(){
    $this->db->query("SELECT count(faturas_compras.id) as compras FROM faturas_compras WHERE YEAR(faturas_compras.create_at) = YEAR(CURDATE()) AND MONTH(faturas_compras.create_at) = MONTH(CURDATE());");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalEstoque(){
    $this->db->query("SELECT count(entrada_estoque.id) as estoque FROM entrada_estoque");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalMoney(){
    $this->db->query("SELECT SUM(entrada_caixa.total) as money FROM entrada_caixa WHERE YEAR(entrada_caixa.create_at) = YEAR(CURDATE()) AND MONTH(entrada_caixa.create_at) = MONTH(CURDATE())");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalRequest()
  {
    $this->db->query("SELECT count(DISTINCT pedido.create_at) as totalpedidos FROM pedido WHERE pedido.status = :status LIMIT 1");
    $this->db->bind(":status", "2");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function totalMoneyP(){
    $this->db->query("SELECT SUM(pedido.preco * pedido.qtd) AS pedido FROM pedido WHERE YEAR(pedido.create_at) = YEAR(CURDATE()) AND MONTH(pedido.create_at) = MONTH(CURDATE()) AND pedido.status = :status");
    $this->db->bind(":status","2");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }

  // 3 semanalmente
  public function Sales1(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE DAYOFWEEK(entrada_caixa.create_at) = 1;");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function Sales2(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE DAYOFWEEK(entrada_caixa.create_at) = 2;");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function Sales3(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE DAYOFWEEK(entrada_caixa.create_at) = 3;");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function Sales4(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE DAYOFWEEK(entrada_caixa.create_at) = 4;");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function Sales5(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE DAYOFWEEK(entrada_caixa.create_at) = 5;");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function Sales6(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE DAYOFWEEK(entrada_caixa.create_at) = 6;");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
  public function Sales7(){
    $this->db->query("SELECT count(entrada_caixa.id) as sales FROM entrada_caixa WHERE DAYOFWEEK(entrada_caixa.create_at) = 7;");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultado();
      return $result;
    } else {
      return false;
    }
  }
}
