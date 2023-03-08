<?php
namespace App\Helpers;

class ResumirTexto{

    public static function ResumirTexto($texto, $limite, $continue=null){
        $texto = strip_tags(trim($texto));
        $limite = (int) $limite;
        $array = explode(' ', $texto);
        $totalpalavras = count($array);
        $textoresumido = implode(' ', array_slice($array,0, $limite));

        $continue = (empty($continue) ? ' ...' : ''.$continue);

        $resultado = ($limite < $totalpalavras ? $textoresumido.$continue : $texto );
        return $resultado;

    }
}