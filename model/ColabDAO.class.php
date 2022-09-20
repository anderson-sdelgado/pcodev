<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of FuncDAO
 *
 * @author anderson
 */
class ColabDAO extends Conn {
    //put your code here
    
    public function dados() {

        $select = " SELECT "
                    . " MATRIC AS \"matricColab\" "
                    . " , NOME AS \"nomeColab\" "
                . " FROM "
                    . " VIEW_PCO_PASSAGEIRO";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
    public function atual($colab) {

        $select = " SELECT "
                    . " MATRIC AS \"matricColab\" "
                    . " , NOME AS \"nomeColab\" "
                . " FROM "
                    . " VIEW_PCO_PASSAGEIRO"
                . " WHERE MATRIC = " . $colab;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
