<?php
namespace App\Libraries;
class uploads
{
    private $diretorio;
    private $arquivo;
    private $tamanho;
    private $exito;
    private $erro;
    private $nome;
    private $pasta;
    public function getexito()
    {
        return $this->exito;
    }
    public function geterro():string
    {
        return $this->erro;
    }
    public function __construct($nome = null)
    {
        $this->diretorio = $nome ??  'uploads';
        if (!file_exists($this->diretorio) && !is_dir($this->diretorio)) :
            mkdir($this->diretorio, 0777);
        endif;
    }
    public function imagem(array $imagem,int $tamanho=null,string $pasta=null, string $nome=null )
    {   
        $this->pasta=$pasta??'imagens';
        $this->arquivo=$imagem;
        $this->nome=$nome??pathinfo($this->arquivo['name'],PATHINFO_FILENAME);
        $this->tamanho=$tamanho??1;
        $extensao=pathinfo($this->arquivo['name'], PATHINFO_EXTENSION);

        $extensoesValidas=['png','jpg'];
            $tiposValidas=['image/jpeg','image/png'];
    
            // var_dump(strtolower($extensao));
            if(!in_array(strtolower($extensao),$extensoesValidas)):
    
                $this->erro="ext INVALIDO";
                $this->exito=false;
            elseif(!in_array(strtolower($this->arquivo['type']),$tiposValidas)):
                $this->erro="Tipo invalido";
                $this->exito=false;
            elseif($this->arquivo['size'] > $this->tamanho * (1024*1024)):
                $this->erro="tamanho invalido";
                $this->exito=false;
            else:
                $this->criarpasta();
                $this->renomear();
                $this->moverimagem();
        endif;

    }
    private function criarpasta()
    {
        
        if (!file_exists($this->diretorio.DIRECTORY_SEPARATOR.$this->pasta) && !is_dir($this->diretorio.DIRECTORY_SEPARATOR.$this->pasta)) :
            mkdir($this->diretorio.DIRECTORY_SEPARATOR.$this->pasta, 0777);
        endif;
    }
    private function renomear()
    {
        $arquivo= $this->nome.strrchr($this->arquivo['name'], '.');
        if(file_exists($this->diretorio.DIRECTORY_SEPARATOR.$this->pasta.DIRECTORY_SEPARATOR.$arquivo)):
            $arquivo= $this->nome.'-'.uniqid().strrchr($this->arquivo['name'], '.');
        endif;
        
        $this->nome=$arquivo;
    }
    private function moverimagem()
    {
        if(move_uploaded_file($this->arquivo['tmp_name'],$this->diretorio.DIRECTORY_SEPARATOR.$this->pasta.DIRECTORY_SEPARATOR.$this->nome)):
            $this->exito= $this->nome;
            $this->erro=false;
        else:
            $this->exito=false;
            $this->erro="Erro ao mover a imagem";
        endif;
    }
}
