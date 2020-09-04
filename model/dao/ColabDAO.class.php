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
    
    public function dados($base) {

        $select = " SELECT "
                    . " COLAB.CD AS \"matricColab\" "
                    . " , CORR.NOME AS \"nomeColab\" "
                . " FROM " 
                    . " COLAB COLAB "
                    . " , CORR CORR "
                    . " , REG_DEMIS DEM " 
                . " WHERE "
                    . " COLAB.CD > 10000 "
                    . " AND COLAB.CORR_ID = CORR.CORR_ID "
                    . " AND DEM.COLAB_ID IS NULL " 
                    . " AND COLAB.COLAB_ID = DEM.COLAB_ID(+) "
                . " ORDER BY " 
                    . " COLAB.CD "
                . " ASC ";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
