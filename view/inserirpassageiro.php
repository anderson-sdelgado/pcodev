<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/PassageiroCTR.class.php');

if (isset($info)):

    $passageiroCTR = new PassageiroCTR();
    echo $passageiroCTR->salvarDados($versao, $info, "inserirpassageiro");
//    echo 'teste';
    
endif;
