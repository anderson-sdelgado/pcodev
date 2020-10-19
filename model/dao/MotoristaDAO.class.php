<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of MotoristaDAO
 *
 * @author anderson
 */
class MotoristaDAO extends Conn {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($base) {

        $select = " SELECT "
                    . " NRO_CRACHA AS \"matricMoto\" "
                    . " , FUNC_NOME AS \"nomeMoto\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_FUNC "
                . " ORDER BY "
                    . " NRO_CRACHA "
                . " ASC ";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function atual($moto, $base) {

        $select = " SELECT "
                    . " NRO_CRACHA AS \"matricMoto\" "
                    . " , FUNC_NOME AS \"nomeMoto\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_FUNC"
                . " WHERE"
                    . " NRO_CRACHA = " . $moto;
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
