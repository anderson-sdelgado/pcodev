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
    
    private $base = 2;
    
    public function atualAplic($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        $retorno = '';
        
        if($versao >= 1.00){

            $atualAplicDAO = new AtualAplicDAO();

            $jsonObj = json_decode($info['dado']);
            $dados = $jsonObj->dados;

            foreach ($dados as $d) {
                $nroAparelho = $d->nroAparelhoAtual;
                $versaoAtual = $d->versaoAtual;
            }
            
            $retAtualApp = 0;
            
            $v = $atualAplicDAO->verAtual($nroAparelho, $this->base);
            if ($v == 0) {
                $atualAplicDAO->insAtual($nroAparelho, $versaoAtual, $this->base);
            } else {
                $result = $atualAplicDAO->retAtual($nroAparelho, $this->base);
                foreach ($result as $item) {
                    $versaoNova = $item['VERSAO_NOVA'];
                    $versaoAtualBD = $item['VERSAO_ATUAL'];
                }
                if ($versaoAtual != $versaoAtualBD) {
                    $atualAplicDAO->updAtualNova($nroAparelho, $versaoAtual, $this->base);
                } else {
                    if ($versaoAtual != $versaoNova) {
                        $retAtualApp = 1;
                    } else {
                        if (strcmp($versaoAtual, $versaoAtualBD) <> 0) {
                            $atualAplicDAO->updAtual($nroAparelho, $versaoAtual, $this->base);
                        }
                    }
                }
            }
            $dthr = $atualAplicDAO->dataHora($this->base);
            
            $dado = array("flagAtualApp" => $retAtualApp
                , "dthr" => $dthr);

            $retorno = json_encode(array("dados" => array($dado)));
            
        }
        
        return $retorno;
        
    }
    
}
