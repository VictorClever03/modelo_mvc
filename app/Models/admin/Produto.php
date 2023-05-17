<?php

namespace App\Models\admin;

use App\Libraries\Conexao;

class Produto
{

    private $db;
    public function __construct()
    {
        $this->db = new Conexao();
    }

    public function checa_nome(string $nome)
    {
        $this->db->query("SELECT nome FROM produto WHERE nome=:nome");
        $this->db->bind(':nome', $nome );
        $this->db->executa();
        if ($this->db->executa() and $this->db->total()) :
            return true;
        else :
            return false;
        endif;
    }

    public function store_p(array $data, $image)
    {
        // Armazenando primeiro o codigo de barra
        $this->db->query("INSERT INTO codigo_barra(cod,categoria) VALUES(:cod,:categoria)");
        $this->db->bind(':cod', $data['code']);
        $this->db->bind(':categoria', $data['cat']);
        if ($this->db->executa() and $this->db->total()) :
            // return true;
            //Armazenando agora o produto
            $this->db->query("INSERT INTO produto(nome,preco,imagem,categoria,codigo_barra) VALUES(:name,:preco,:imagem,:categoria,:codigo_barra)");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':preco', $data['value']);
            $this->db->bind(':imagem', $image);
            $this->db->bind(':categoria', $data['cat']);
            $this->db->bind(':codigo_barra', $this->db->ultimoid());
            if($this->db->executa() and $this->db->total()):
                return true;
            else:
                return false;
            endif;
        else :
            return false;
        endif;
    }
    public function read_p()
    {
        $this->db->query("SELECT *, produto.id as p_id, produto.nome as p_nome, produto.create_at as p_create_at, produto.update_at as p_update_at, categoria.id as c_id, categoria.nome as c_nome, categoria.create_at as c_create_at, categoria.update_at as c_update_at, codigo_barra.id as b_id, codigo_barra.categoria as b_categoria  FROM  produto INNER JOIN categoria on produto.categoria = categoria.id INNER JOIN codigo_barra on produto.codigo_barra = codigo_barra.id ");

        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultados();
            return $resultado;

        else :
            return false;
        
        endif; 
    }
    public function read1_p(int $id)
    {
        $this->db->query("SELECT * FROM  produto WHERE id=:id");
        $this->db->bind(':id',$id);
        if ($this->db->executa() AND $this->db->total()): 
            $resultado=$this->db->resultado();
            return $resultado;

        else :
            return false;
        
        endif; 
    }

    public function edit_p(int $id)
    {
        $this->db->query("SELECT *, produto.id as p_id, produto.nome as p_nome, produto.create_at as p_crate_at, produto.update_at as p_update_at, categoria.id as c_id, categoria.nome as c_nome, categoria.create_at as c_create_at, categoria.update_at as c_update_at, codigo_barra.id as b_id, codigo_barra.categoria as b_categoria FROM  produto INNER JOIN categoria on produto.categoria = categoria.id INNER JOIN codigo_barra on produto.codigo_barra = codigo_barra.id WHERE produto.id = :id");
        $this->db->bind(':id',$id);
        if($this->db->executa() AND $this->db->total()):
            $resultado = $this->db->resultado();
            return $resultado;
        else:
            return false;
        endif;
    }
    public function update_p(array $data, int $id)
    {
        // Actualizando primeiro o codigo de barra
        $this->db->query("UPDATE produto INNER JOIN codigo_barra ON produto.codigo_barra=codigo_barra.id SET cod=:code,codigo_barra.categoria=:categoria, nome=:name, preco=:preco, produto.categoria=:categoria WHERE produto.id=:id");
        $this->db->bind(':code',$data['code']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':preco', $data['value']);
        // $this->db->bind(':imagem', $data['path']);
        $this->db->bind(':categoria', $data['cat']);
        $this->db->bind(':id',$id);
        if($this->db->executa() AND $this->db->total()):
            return true;
        else:
            return false;
        endif;
    }

    public function delete_p(int $id)
    {
        $this->db->query('DELETE FROM codigo_barra WHERE id=:id');
        $this->db->bind(':id',$id);
        // if($this->db->executa() AND $this->db->total()):
        //     $this->db->query('DELETE FROM codigo_barra WHERE id=:id');
        //     $this->db->bind(':id',$id);
            if($this->db->executa() AND $this->db->total()):
                return true;
            else:
                return false;
            endif;
        // else:
        //     return false;
        // endif;
    }
}
