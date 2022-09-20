<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicativoCTR
 *
 * @author anderson
 */
class AtualAplicCTR {
    //put your code here
    
    public function atualAplic($info) {

        $atualAplicDAO = new AtualAplicDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $nroAparelho = $d->nroAparelhoAtual;
            $versaoAtual = $d->versaoAtual;
        }

        $retAtualApp = 0;

        $v = $atualAplicDAO->verAtual($nroAparelho);
        if ($v == 0) {
            $atualAplicDAO->insAtual($nroAparelho, $versaoAtual);
        } else {
            $result = $atualAplicDAO->retAtual($nroAparelho);
            foreach ($result as $item) {
                $versaoNova = $item['VERSAO_NOVA'];
                $versaoAtualBD = $item['VERSAO_ATUAL'];
            }
            if ($versaoAtual != $versaoAtualBD) {
                $atualAplicDAO->updAtualNova($nroAparelho, $versaoAtual);
            } else {
                if ($versaoAtual != $versaoNova) {
                    $retAtualApp = 1;
                } else {
                    if (strcmp($versaoAtual, $versaoAtualBD) <> 0) {
                        $atualAplicDAO->updAtual($nroAparelho, $versaoAtual);
                    }
                }
            }
        }
        $dthr = $atualAplicDAO->dataHora();

        $dado = array("flagAtualApp" => $retAtualApp
            , "dthr" => $dthr);

        $retorno = json_encode(array("dados" => array($dado)));

        return $retorno;
        
    }
    
}
