<?php

function diasSemana(){

    return array(
                 0=>'Sunday',
                 1=>'Monday',
                 2=>'Tuesday',
                 3=>'Wednesday',
                 4=>'Thursday',
                 5=>'Friday',
                 6=>'Saturday'
                 );
}

function ExibeDiaSemanaById($id){

    $datas = array(
                 0=>'Sunday',
                 1=>'Monday',
                 2=>'Tuesday',
                 3=>'Wednesday',
                 4=>'Thursday',
                 5=>'Friday',
                 6=>'Saturday'
                 );

    return $datas[$id];
}

function FinalDeSemana($dataInicio, $dataFinal){

    $finalSemana = 0;

    $timestampInicio = strtotime($dataInicio);
    $timestampFinal  = strtotime($dataFinal);

    $distanciaDatas = ($timestampFinal-$timestampInicio)/(60*60*24);

    for($dias = 0; $dias <= $distanciaDatas; $dias++){

        $dataVerificacao = $timestampInicio+(60*60*24*$dias);

        if(date('w', $dataVerificacao) == 0 || date('w', $dataVerificacao) == 6){

            $finalSemana++;
        }
    }

    return $finalSemana;
}

function TempoAtras($timeBD) {

    $timeNow = time();
    $timeRes = $timeNow - $timeBD;
    $nar = 0;

    // variável de retorno
    $r = "";

    // Agora
    if ($timeRes == 0){
        $r = "now";
    } else
    // Segundos
    if ($timeRes > 0 and $timeRes < 60){
        $r = $timeRes. " seconds ago";
    } else
    // Minutos
    if (($timeRes > 59) and ($timeRes < 3599)){
        $timeRes = $timeRes / 60;
        if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
            $r = round($timeRes,$nar). " minute ago";
        } else {
            $r = round($timeRes,$nar). " minutes ago";
        }
    }
     else
    // Horas
    // Usar expressao regular para fazer hora e MEIA
    if ($timeRes > 3559 and $timeRes < 85399){
        $timeRes = $timeRes / 3600;

        if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
            $r = round($timeRes,$nar). " hour ago";
        }
        else {
            $r = round($timeRes,$nar). " hours ago";
        }
    } else
    // Dias
    // Usar expressao regular para fazer dia e MEIO
    if ($timeRes > 86400 and $timeRes < 2591999){

        $timeRes = $timeRes / 86400;
        if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
            $r = round($timeRes,$nar). " day ago";
        } else {

            preg_match('/(\d*)\.(\d)/', $timeRes, $matches);

            if ($matches[2] >= 5) {
                $ext = round($timeRes,$nar) - 1;

                // Imprime o dia
                $r = $ext;

                // Formata o dia, singular ou plural
                if ($ext >= 1 and $ext < 2){ $r.= " dia "; } else { $r.= " days ";}

                // Imprime o final da data
                $r.= "&frac12; ago";


            } else {
                $r = round($timeRes,0) . " days ago";
            }

        }

    } else
    // Meses
    if ($timeRes > 2592000 and $timeRes < 31103999){

        $timeRes = $timeRes / 2592000;
        if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
            $r = round($timeRes,$nar). " month ago";
        } else {

            preg_match('/(\d*)\.(\d)/', $timeRes, $matches);

            if ($matches[2] >= 5){
                $ext = round($timeRes,$nar) - 1;

                // Imprime o mes
                $r.= $ext;

                // Formata o mes, singular ou plural
                if ($ext >= 1 and $ext < 2){ $r.= " month "; } else { $r.= " months ";}

                // Imprime o final da data
                $r.= "&frac12; ago";
            } else {
                $r = round($timeRes,0) . " months ago";
            }

        }
    } else
    // Anos
    if ($timeRes > 31104000 and $timeRes < 155519999){

        $timeRes /= 31104000;
        if (round($timeRes,$nar) >= 1 and round($timeRes,$nar) < 2){
            $r = round($timeRes,$nar). " year ago";
        } else {
            $r = round($timeRes,$nar). " years ago";
        }
    } else
    // 5 anos, mostra data
    if ($timeRes > 155520000){

        $localTimeRes = localtime($timeRes);
        $localTimeNow = localtime(time());

        $timeRes /= 31104000;
        $gmt = array();
        $gmt['mes'] = $localTimeRes[4];
        $gmt['ano'] = round($localTimeNow[5] + 1900 - $timeRes,0);

        $mon = array("Jan ","Feb ","Mar ","Abr ","Mar ","Jun ","Jul ","Aug ","Sep ","Oct ","Nov ","Dec ");

        $r = $mon[$gmt['mes']] . $gmt['ano'];
    }

    return $r;

}
?>