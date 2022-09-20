<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of PassageiroViagemDAO
 *
 * @author anderson
 */
class PassageiroViagemDAO extends Conn {
    //put your code here
    

    public function verifPassageiro($idPassag, $passag) {

        $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                . " FROM "
                    . " PCO_PASSAG_VIAGEM "
                . " WHERE "
                    . " ID_CEL = " . $passag->idPassageiroViagem
                    . " AND "
                    . " CABEC_ID = " . $idPassag;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }
    
        public function idPassageiro($idPassag, $passag) {

        $select = " SELECT "
                    . " ID "
                . " FROM "
                    . " PCO_PASSAG_VIAGEM "
                . " WHERE "
                    . " ID_CEL = " . $passag->idPassageiroViagem
                    . " AND "
                    . " CABEC_ID = " . $idPassag;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }
    
    public function insPassageiro($idCabec, $passag) {

        $sql = "INSERT INTO PCO_PASSAG_VIAGEM ("
                . " CABEC_ID "
                . " , MATRIC_COLAB "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " , ID_CEL "
                . " ) "
                . " VALUES ("
                . " " . $idCabec
                . " , " . $passag->matricColabPassageiroViagem
                . " , TO_DATE('" . $passag->dthrPassageiroViagem . "','DD/MM/YYYY HH24:MI')"
                . " , TO_DATE('" . $passag->dthrPassageiroViagem . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " , " . $passag->idPassageiroViagem
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();

    }
    
}
