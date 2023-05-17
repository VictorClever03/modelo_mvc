<?php

namespace App\Models\admin;

use App\Libraries\Conexao;

class Estoque
{

    private $db;
    public function __construct()
    {
        $this->db = new Conexao();
    }

    public function checa_lote(string $lote)
    {
        $this->db->query("SELECT lote FROM lote WHERE lote=:lote");
        $this->db->bind(':lote', $lote );
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
            return true;
        else :
            return false;
        endif;
    }
    public function entrada_estoque($dados){
        // Armazenando primeiro o lote do produto
        $this->db->query("INSERT INTO lote(lote,data_exp,data_prod) VALUES(:lote,:exp,:fab)");
        $this->db->bind(':lote', $dados['lote'] );
        $this->db->bind(':exp', $dados['exp'] );
        $this->db->bind(':fab', $dados['fab'] );
        // $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
            // Armazenado agora o estoque proposto
            $this->db->query("INSERT INTO entrada_estoque(qtd,produto,usuario,lote) VALUES(:qtd,:prod,:usuario,:lote)");
            $this->db->bind(':qtd', $dados['qtd'] );
            $this->db->bind(':prod', $dados['produto'] );
            $this->db->bind(':usuario', $dados['usuario'] );
            $this->db->bind(':lote', $this->db->ultimoid() );
            // $this->db->executa();
            if ($this->db->executa() and $this->db->total()) {
                return true;
            }else{
                return false;
            }

        else :
            return false;
        endif;
    }
    public function read_p(){
        $this->db->query("SELECT * FROM produto");
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
            return $this->db->resultados();
        else :
            return false;
        endif;
    }
    public function read_estoque(){
        $this->db->query("SELECT *, entrada_estoque.id as e_id, entrada_estoque.lote as e_lote, entrada_estoque.produto as e_produto, entrada_estoque.usuario as e_usuario, entrada_estoque.create_at as e_create, entrada_estoque.update_at as e_update, lote.id as l_id, lote.lote as l_lote, produto.id as p_id, produto.nome as p_nome, produto.create_at as p_create, produto.update_at as p_update, usuario.id as u_id, usuario.nome as u_nome, usuario.create_at as u_create, usuario.update_at as u_update, produto.imagem as p_imagem, usuario.imagem as u_imagem FROM entrada_estoque INNER JOIN lote on entrada_estoque.lote=lote.id INNER JOIN produto on entrada_estoque.produto=produto.id INNER JOIN usuario on entrada_estoque.usuario = usuario.id");

        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultados();
            return $resultado;

        else :
            return false;
        
        endif; 
    }
    public function read_estoque1($id){
        $this->db->query("SELECT *, entrada_estoque.id as e_id, entrada_estoque.lote as e_lote, entrada_estoque.produto as e_produto, entrada_estoque.usuario as e_usuario, entrada_estoque.create_at as e_create, entrada_estoque.update_at as e_update, lote.id as l_id, lote.lote as l_lote FROM entrada_estoque INNER JOIN lote on entrada_estoque.lote=lote.id WHERE entrada_estoque.id = :id");
        $this->db->bind(":id",$id);

        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultado();
            return $resultado;

        else :
            return false;
        
        endif; 
    }
    public function update_estoque($dados,$id){
        // Actualizando primeiro o codigo de barra
        $this->db->query("UPDATE lote INNER JOIN entrada_estoque ON lote.id=entrada_estoque.lote SET lote.lote=:lote,data_exp=:exp, data_prod=:fab, qtd=:qtd, entrada_estoque.usuario=:usuario WHERE entrada_estoque.id=:id");
        $this->db->bind(':lote', $dados['lote'] );
        $this->db->bind(':exp', $dados['exp'] );
        $this->db->bind(':fab', $dados['fab'] );
        $this->db->bind(':id',$id);
        $this->db->bind(':qtd', $dados['qtd'] );
        $this->db->bind(':usuario', $dados['usuario'] );
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }
    public function delete_estoque($id){
        $this->db->query("DELETE FROM lote WHERE id=:id");
        $this->db->bind(":id",$id);
        // $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
            return true;
        else :
            return false;
        endif;
    }
}