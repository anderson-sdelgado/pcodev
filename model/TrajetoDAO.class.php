<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/ConnApex.class.php');
/**
 * Description of TrajetoDAO
 *
 * @author anderson
 */
class TrajetoDAO extends ConnApex {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " ID AS \"idTrajeto\" "
                        . " , DESCR AS \"descrTrajeto\" "
                    . " FROM "
                        . " PCO_TRAJETO ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
}
