<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../control/AtualAplicCTR.class.php');
require_once('../model/AtualAplicDAO.class.php');
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

    public function dadosColab($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $colabDAO = new ColabDAO();

            $dados = array("dados"=>$colabDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function pesqColab($info) {

        
        $atualAplicDAO = new AtualAplicDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $nroMatricula = $d->nroMatricula;
            $token = $d->token;
        }

        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {
            
            $colabDAO = new ColabDAO();

            $dadosEquip = array("dados" => $colabDAO->pesq($nroMatricula));
            $resEquip = json_encode($dadosEquip);

            return $resEquip;
        
        }

    }
    
    public function dadosMoto($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $motoristaDAO = new MotoristaDAO();

            $dados = array("dados"=>$motoristaDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function pesqMoto($info) {
        
        $atualAplicDAO = new AtualAplicDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $nroMatricula = $d->nroMatricula;
            $token = $d->token;
        }

        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {
            
            $motoristaDAO = new MotoristaDAO();

            $dadosEquip = array("dados" => $motoristaDAO->pesq($nroMatricula));
            $resEquip = json_encode($dadosEquip);

            return $resEquip;
            
        }
        
        
    }
    
    public function dadosEquip($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
            
            $equipDAO = new EquipDAO();

            $dadosEquip = array("dados" => $equipDAO->dados());
            $resEquip = json_encode($dadosEquip);

            return $resEquip;
        
        }
        
    }
        
    public function dadosTrajeto($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $trajetoDAO = new TrajetoDAO();

            $dados = array("dados"=>$trajetoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosTurno($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $turnoDAO = new TurnoDAO();

            $dados = array("dados"=>$turnoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
}
