<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PassageiroCTR
 *
 * @author anderson
 */
class PassageiroCTR {
    
    public function salvarDados($versao, $info, $pagina) {

        $dados = $info['dado'];
        $pagina = $pagina . '-' . $versao;
        $this->salvarLog($dados, $pagina);

        $versao = str_replace("_", ".", $versao);

        if ($versao >= 2.00) {

            $jsonObjPassageiro = json_decode($dados);

            $dadosPassageiro = $jsonObjPassageiro->passageiro;

            $ret = $this->salvarPassageiro($dadosPassageiro);

            return $ret;
        }
    }
    
    private function salvarPassageiro($dadosPassageiro) {
        $passageiroDAO = new PassageiroDAO();
        $idPassagArray = array();
        foreach ($dadosPassageiro as $passag) {
            $v = $passageiroDAO->verifPassageiro($passag);
            if ($v == 0) {
                $passageiroDAO->insPassageiro($passag);
            }
            $idPassagArray[] = array("idPassageiro" => $passag->idPassageiro);
        }
        $dadoPassag = array("passageiro"=>$idPassagArray);
        $retPassag = json_encode($dadoPassag);
        
        return 'SALVOU_' . $retPassag;
    }
    
}
