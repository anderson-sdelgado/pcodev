<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/ViagemCTR.class.php');

if (isset($info)):

    $viagemCTR = new ViagemCTR();
    echo $viagemCTR->salvarDados($versao, $info, "inserircabecaberto");

endif;
