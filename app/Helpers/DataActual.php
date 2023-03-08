<?php
namespace App\Helpers;

class DataActual{
    public static function dataActual(){
        $dia=date('d');
        $diaSemana=date('w');
        $ano=date('Y');
        $mes=date('n');
        $datasemana=['Domingo','Segunda-Feira','Terça-Feira','Quarta-Feira','Quinta-Feira','Sexta-Feira','Sábado' ];
        $datames=['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro' ];
        return $datasemana[$diaSemana].' Aos '.$dia.' de '.$datames[$mes].' de '. $ano ;
    }
}