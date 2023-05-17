<?php

namespace App\Models\admin;

use App\Libraries\Conexao;

class Compras
{

  private $db;
  public function __construct()
  {
    $this->db = new Conexao();
  }

  public function list()
  {
    $this->db->query("SELECT *, faturas_compras.id as id_fc, faturas_compras.total as total_fc, fornecedor.id as id_f, fornecedor.nome as nome_f, fornecedor.email as email_f FROM faturas_compras INNER JOIN fornecedor ON faturas_compras.fornecedor=fornecedor.id");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) :
      return $this->db->resultados();
    else :
      return false;
    endif;
  }

  public function store1($path, $total, $forn)
  {

    $this->db->query("INSERT INTO faturas_compras(path, total, fornecedor) VALUES(:path, :total, :fornecedor)");

    $this->db->bind(':path', $path);
    $this->db->bind(':total', $total);
    $this->db->bind(':fornecedor', $forn);

    if ($this->db->executa() and $this->db->total()) {
      return true;
    } else {
      return false;
    }
  }
  public function store2($data, $forn)
  {
    $idfactura = $this->db->ultimoid();
    foreach ($data['qtd'] as $key => $value) {


      $this->db->query("INSERT INTO compra(nome, preco, qtd, total, fatura, fornecedor, usuario) VALUES(:nome, :preco, :qtd, :total, :fatura, :fornecedor, :usuario)");

      $this->db->bind(':nome', $data['nome'][$key]);
      $this->db->bind(':preco', $data['preco'][$key]);
      $this->db->bind(':qtd', $data['qtd'][$key]);
      $this->db->bind(':total', ($data['qtd'][$key] * $data['preco'][$key]));
      $this->db->bind(':fatura', $idfactura);
      $this->db->bind(':fornecedor', $forn);
      $this->db->bind(':usuario', $_SESSION['usuarios_id']);
      $this->db->executa();
    }

    if ($this->db->total()) {
      return true;
    } else {
      return false;
    }
  }

  public function get($id)
  {
    $this->db->query("SELECT * FROM  fornecedor WHERE id = :id");
    $this->db->bind(":id", $id);
    if ($this->db->executa() and $this->db->total()) :
      $resultado = $this->db->resultado();
      return $resultado;

    else :
      return false;

    endif;
  }
  public function delete(int $id)
  {
    $this->db->query('DELETE FROM faturas_compras WHERE id=:id');
    $this->db->bind(':id', $id);
    if ($this->db->executa() and $this->db->total()) :
      return true;
    else :
      return false;
    endif;
  }
}
