<?php

namespace App\Models\saler;

use App\Libraries\Conexao;

class Venda
{
  private $db;
  public function __construct()
  {
    $this->db = new Conexao();
  }

  public function saveCaixa($data)
  {
    // var_dump($data);
    // exit;
    $total = 0;
    foreach ($data['total'] as $key => $value) {
      // echo $value.'<br>';
      $total += $value;
    }
    $this->db->query("INSERT INTO entrada_caixa(total, valor_pago,troco,usuario,forma_pagamento) VALUES(:total, :valor_pago,:troco,:usuario, :mode)");
    // $this->db->bind(":total", $total);
    $this->db->bind(":total", $total);
    $this->db->bind(":valor_pago", $data['pagamento']);
    $this->db->bind(":troco", $data['troco']);
    $this->db->bind(":usuario", $_SESSION['usuarioS_id']);
    $this->db->bind(":mode", $data['f_pagamento']);
    if ($this->db->executa() and $this->db->total()) {
      // $this->saveSale($data);
      return true;
    } else {
      return false;
    }
  }

  public function saveSale($data)
  {
$idCaixa=$this->db->ultimoid();
    foreach ($data['qtd'] as $key => $value) {

      $this->db->query("INSERT INTO venda(`id`, `qtd`, `create_at`, `update_at`, `produto`, `entrada_caixa`, `refeicoes`, `escola`) VALUES(NULL, :qtd, current_timestamp(), current_timestamp(), :produto, :entrada_caixa, :refeicoes, NULL)");
      $this->db->bind(':qtd', $value);
      $this->db->bind(':produto', $data['type'][$key] === 'product' ? $data['id'][$key] : NULL);
      $this->db->bind(':entrada_caixa', $idCaixa);
      $this->db->bind(':refeicoes', $data['type'][$key] === 'refei' ? $data['id'][$key] : NULL);
      // $this->db->bind(':cliente', $data['cliente']);
      $this->db->executa();
    }
    if ($this->db->total()) :
      return true;
    else :
      return false;
    endif;
  }
}
