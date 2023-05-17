<?php

namespace App\Helpers;

class ResumirTexto
{

  public static function ResumirTexto($texto, $limite, $continue = null)
  {
    $texto = strip_tags(trim($texto));
    $limite = (int) $limite;
    $array = explode(',', $texto);
    $totalpalavras = count($array);
    $textoresumido = implode(' <br>', array_slice($array, 0, $limite));

    $continue = (empty($continue) ? ' ...' : '' . $continue);
    $texto = str_replace(',', ' <br>', $texto);
    $resultado = ($limite < $totalpalavras ? $textoresumido . $continue : $texto);
    return $resultado;
  }


  public static function ResumirArray(array $array, $limite, $continue = null)
  {
    $limite = (int) $limite;
    $totalpalavras = count($array);
    $arrayResumido = array_slice($array, 0, $limite);

    $continue = (empty($continue) ? ' ...' : '' . $continue);

    $resultado = ($limite <= $totalpalavras ? $arrayResumido . $continue : $array);
    return $resultado;
  }
}
