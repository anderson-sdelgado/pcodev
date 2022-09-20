<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/ColabDAO.class.php');
require_once('../model/MotoristaDAO.class.php');
require_once('../model/EquipDAO.class.php');
require_once('../model/TrajetoDAO.class.php');
require_once('../model/TurnoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
//    private $base = 2;
//    private $baseApex = 3;

    public function dadosColab() {

        $colabDAO = new ColabDAO();

        $dados = array("dados"=>$colabDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function atualColab($info) {

        $dado = $info['dado'];
        
        $colabDAO = new ColabDAO();

        $dadosEquip = array("dados" => $colabDAO->atual($dado));
        $resEquip = json_encode($dadosEquip);

        return $resEquip;

    }
    
    public function dadosMoto() {

        $motoristaDAO = new MotoristaDAO();

        $dados = array("dados"=>$motoristaDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
        
    }
    
    public function atualMoto($info) {

        $dado = $info['dado'];
        
        $motoristaDAO = new MotoristaDAO();

        $dadosEquip = array("dados" => $motoristaDAO->atual($dado));
        $resEquip = json_encode($dadosEquip);

        return $resEquip;
        
    }
    
    public function dadosEquip() {

        $equipDAO = new EquipDAO();

        $dadosEquip = array("dados" => $equipDAO->dados());
        $resEquip = json_encode($dadosEquip);

        return $resEquip;
        
    }
        
    public function dadosTrajeto() {

        $trajetoDAO = new TrajetoDAO();

        $dados = array("dados"=>$trajetoDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosTurno() {

        $turnoDAO = new TurnoDAO();

        $dados = array("dados"=>$turnoDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
}
