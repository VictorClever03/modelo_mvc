<?php 
namespace App\Models\admin;

use App\Libraries\Conexao;

class Report {
  private $db;
  public function __construct(){
    $this->db= new Conexao;
  }
// relatorios dde vendas
  public function getSales(){
    $this->db->query("SELECT *, entrada_caixa.id as v_id, entrada_caixa.create_at as v_create_at, entrada_caixa.update_at as v_update_at, usuario.id as u_id, usuario.nome as u_nome, usuario.create_at as u_create_at, usuario.update_at as u_update_at FROM  entrada_caixa INNER JOIN usuario on entrada_caixa.usuario = usuario.id ORDER BY entrada_caixa.id DESC");

        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultados();
            return $resultado;

        else :
            return false;
        
        endif; 
  }
    // produtos vendidos
  public static function getR($id)
  {
    $db = new Conexao();

    $db->query("SELECT *, venda.id as v_id, refeicoes.id as re_id, refeicoes.nome as re_nome, refeicoes.preco as re_preco, refeicoes.imagem as re_img, refeicoes.status as re_status FROM venda INNER JOIN refeicoes on venda.refeicoes = refeicoes.id WHERE venda.entrada_caixa=:id ORDER BY venda.id DESC");
    $db->bind(':id',$id);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultados();
      return $result;
    } else {
      return false;
    }
   
  }
  public static function getP($id)
  {
    $db = new Conexao();

    $db->query("SELECT *, venda.id as v_id, produto.id as pr_id, produto.nome as pr_nome, produto.preco as pr_preco, produto.imagem as pr_img FROM venda INNER JOIN produto on venda.produto = produto.id WHERE venda.entrada_caixa=:id ORDER BY venda.id DESC ");
    $db->bind(':id',$id);
    $db->executa();
    if ($db->executa() and $db->total()) {
      $result = $db->resultados();
      return $result;
    } else {
      return false;
    }
  }
  public function filterV($from, $to){
    $this->db->query("SELECT *, entrada_caixa.id as v_id, entrada_caixa.create_at as v_create_at, entrada_caixa.update_at as v_update_at, usuario.id as u_id, usuario.nome as u_nome, usuario.create_at as u_create_at, usuario.update_at as u_update_at FROM  entrada_caixa INNER JOIN usuario on entrada_caixa.usuario = usuario.id WHERE entrada_caixa.create_at BETWEEN :fromDate AND :toDate ");
    $this->db->bind(":fromDate",$from);
    $this->db->bind("toDate",$to);
    if ($this->db->executa() AND $this->db->total()): 
        $resultado=$this->db->resultados();
        return $resultado;

    else :
        return false;
    
    endif; 
  }
  // compraas
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
  public function filterC($from, $to)
  {
    $this->db->query("SELECT *, faturas_compras.id as id_fc, faturas_compras.total as total_fc, fornecedor.id as id_f, fornecedor.nome as nome_f, fornecedor.email as email_f FROM faturas_compras INNER JOIN fornecedor ON faturas_compras.fornecedor=fornecedor.id WHERE faturas_compras.create_at BETWEEN :fromDate AND :toDate");
    $this->db->bind(":fromDate",$from);
    $this->db->bind("toDate",$to);
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) :
      return $this->db->resultados();
    else :
      return false;
    endif;
  }
  // pedidos
  public function pedidos()
  {

    $this->db->query("SELECT DISTINCT *, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN escola ON pedido.escola = escola.id WHERE pedido.status = :status GROUP BY pedido.update_at ORDER BY pedido.update_at DESC");
    $this->db->bind(":status", "2");
    $this->db->executa();
    if ($this->db->executa() and $this->db->total()) {
      $result = $this->db->resultados();
      return $result;
    } else {
      return false;
    }
  }
  public function filterP($from,$to)
  {

    $this->db->query("SELECT DISTINCT *, pedido.create_at as pe_create, pedido.update_at as pe_update FROM pedido INNER JOIN escola ON pedido.escola = escola.id WHERE pedido.status = :status AND pedido.update_at BETWEEN :fromDate AND :toDate GROUP BY pedido.update_at ORDER BY pedido.update_at DESC");
    $this->db->bind(":fromDate",$from);
    $this->db->bind("toDate",$to);
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