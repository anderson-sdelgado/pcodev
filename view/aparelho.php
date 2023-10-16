<?php

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/AtualAplicCTR.class.php');

if (isset($info)):

    $atualAplicCTR = new AtualAplicCTR();
    echo $retorno = $atualAplicCTR->inserirDados($info);

endif;