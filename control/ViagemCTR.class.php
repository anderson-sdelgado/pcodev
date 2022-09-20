<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/CabecViagemDAO.class.php');
require_once('../model/PassageiroViagemDAO.class.php');
/**
 * Description of PassageiroCTR
 *
 * @author anderson
 */
class ViagemCTR {
    
    
    public function salvarDadosCabecAberto($info) {

        $dados = $info['dado'];

        $posicao = strpos($dados, "_") + 1;
        $cabec = substr($dados, 0, ($posicao - 1));
        $item = substr($dados, $posicao);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjItem = json_decode($item);

        $dadosCab = $jsonObjCabec->cabecalho;
        $dadosPassag = $jsonObjItem->passageiro;

        return $this->salvarCabecAberto($dadosCab, $dadosPassag);
 
    }
    
      public function salvarDadosCabecFechado($info) {

        $dados = $info['dado'];

        $posicao = strpos($dados, "_") + 1;
        $cabec = substr($dados, 0, ($posicao - 1));
        $item = substr($dados, $posicao);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjItem = json_decode($item);

        $dadosCab = $jsonObjCabec->cabecalho;
        $dadosPassag = $jsonObjItem->passageiro;

        return $this->salvarCabecFechado($dadosCab, $dadosPassag);

    }
    
    
    private function salvarCabecAberto($dadosCabec, $dadosPassag) {
        
        $cabecViagemDAO = new CabecViagemDAO();
        
        foreach ($dadosCabec as $cabec) {
            $v = $cabecViagemDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecViagemDAO->insCabecAberto($cabec);
            }
            $idCabecBD = $cabecViagemDAO->idCabec($cabec);
            $retPassag = $this->salvarPassageiro($idCabecBD, $cabec->idCabecViagem, $dadosPassag);
        }
        
        return 'CABECABERTO_' . $retPassag;
    }
    
    private function salvarCabecFechado($dadosCabec, $dadosPassag) {
        
        $cabecViagemDAO = new CabecViagemDAO();
        $idCabecArray = array();
        
        foreach ($dadosCabec as $cabec) {
            $v = $cabecViagemDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecViagemDAO->insCabecFechado($cabec);
                $idCabecBD = $cabecViagemDAO->idCabec($cabec);
            } else {
                $idCabecBD = $cabecViagemDAO->idCabec($cabec);
                $cabecViagemDAO->updateCabecFechado($idCabecBD, $cabec);
            }
            $retPassag = $this->salvarPassageiro($idCabecBD, $cabec->idCabecViagem, $dadosPassag);
            $idCabecArray[] = array("idCabecViagem" => $cabec->idCabecViagem);
        }
        
        $dadoCabec = array("cabecalho"=>$idCabecArray);
        $retCabec = json_encode($dadoCabec);
        return 'CABECFECHADO_' . $retCabec . "|" . $retPassag;
        
    }
    
    private function salvarPassageiro($idCabecBD, $idCabecCel, $dadosPassag) {
        
        $passageiroViagemDAO = new PassageiroViagemDAO();
        $idPassageiroViagemArray = array();
        
        foreach ($dadosPassag as $passag) {
            if ($idCabecCel == $passag->idCabecPassageiroViagem) {
                $v = $passageiroViagemDAO->verifPassageiro($idCabecBD, $passag);
                if ($v == 0) {
                    $passageiroViagemDAO->insPassageiro($idCabecBD, $passag);
                }
                $passageiroViagemDAO->idPassageiro($idCabecBD, $passag);
                $idPassageiroViagemArray[] = array("idPassageiroViagem" => $passag->idPassageiroViagem, "idCabecPassageiroViagem" => $passag->idCabecPassageiroViagem);
            }
        }
        
        $dadoPassag = array("passageiro"=>$idPassageiroViagemArray);
        $retPassag = json_encode($dadoPassag);
        
        return $retPassag;
        
    }
 
}
