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
    
    private $base = 2;
    private $baseApex = 3;

    public function dadosColab($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $colabDAO = new ColabDAO();
        
        if($versao >= 1.00){
        
            $dados = array("dados"=>$colabDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function atualColab($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $colabDAO = new ColabDAO();

            $dado = $info['dado'];

            $dadosEquip = array("dados" => $colabDAO->atual($dado, $this->base));
            $resEquip = json_encode($dadosEquip);
            
            return $resEquip;
        
        }
        
    }
    
    public function dadosMoto($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $motoristaDAO = new MotoristaDAO();
        
        if($versao >= 1.00){
        
            $dados = array("dados"=>$motoristaDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function atualMoto($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $motoristaDAO = new MotoristaDAO();

            $dado = $info['dado'];

            $dadosEquip = array("dados" => $motoristaDAO->atual($dado, $this->base));
            $resEquip = json_encode($dadosEquip);
            
            return $resEquip;
        
        }
        
    }
    
    public function dadosEquip($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $equipDAO = new EquipDAO();

            $dadosEquip = array("dados" => $equipDAO->dados($this->baseApex));
            $resEquip = json_encode($dadosEquip);
            
            return $resEquip;
        
        }
        
    }
        
    public function dadosTrajeto($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $trajetoDAO = new TrajetoDAO();

            $dados = array("dados"=>$trajetoDAO->dados($this->baseApex));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosTurno($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $turnoDAO = new TurnoDAO();

            $dados = array("dados"=>$turnoDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
}
