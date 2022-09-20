<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of CabecViagemDAO
 *
 * @author anderson
 */
class CabecViagemDAO extends Conn {
    //put your code here
    

    public function verifCabec($cabec) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PCO_CABEC_VIAGEM "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabecViagem . "','DD/MM/YYYY HH24:MI')"
                        . " AND "
                        . " EQUIP_ID = " . $cabec->idEquipCabecViagem . " ";

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

    public function idCabec($cabec) {

        $select = " SELECT "
                        . " ID AS ID "
                    . " FROM "
                        . " PCO_CABEC_VIAGEM "
                    . " WHERE "
                        . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabecViagem . "','DD/MM/YYYY HH24:MI')"
                        . " AND "
                        . " EQUIP_ID = " . $cabec->idEquipCabecViagem . " ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        $id = 0;
        
        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insCabecAberto($cabec) {

        if ($cabec->hodometroInicialCabecViagem > 9999999) {
            $cabec->hodometroInicialCabecViagem = 0;
        }

        $sql = "INSERT INTO PCO_CABEC_VIAGEM ("
                        . " DTHR "
                        . " , DTHR_CEL "
                        . " , DTHR_TRANS "
                        . " , EQUIP_ID "
                        . " , MATRIC_MOTORISTA "
                        . " , TURNO_ID "
                        . " , TRAJETO_ID "
                        . " , HOD_HOR_INICIAL "
                        . " , STATUS "
                    . " ) "
                    . " VALUES ("
                        . " TO_DATE('" . $cabec->dthrCabecViagem . "','DD/MM/YYYY HH24:MI')"
                        . " , TO_DATE('" . $cabec->dthrCabecViagem . "','DD/MM/YYYY HH24:MI')"
                        . " , SYSDATE "
                        . " , " . $cabec->idEquipCabecViagem
                        . " , " . $cabec->matricMotoCabecViagem
                        . " , " . $cabec->idTurnoCabecViagem
                        . " , " . $cabec->idTrajetoCabecViagem
                        . " , " . $cabec->hodometroInicialCabecViagem
                        . " , 1 "
                    . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function insCabecFechado($cabec) {

        if ($cabec->hodometroInicialCabecViagem > 9999999) {
            $cabec->hodometroInicialCabecViagem = 0;
        }

        if ($cabec->hodometroFinalCabecViagem > 9999999) {
            $cabec->hodometroFinalCabecViagem = 0;
        }

        $sql = "INSERT INTO PCO_CABEC_VIAGEM ("
                        . " DTHR "
                        . " , DTHR_CEL "
                        . " , DTHR_TRANS "
                        . " , EQUIP_ID "
                        . " , MATRIC_MOTORISTA "
                        . " , TURNO_ID "
                        . " , TRAJETO_ID "
                        . " , HOD_HOR_INICIAL "
                        . " , HOD_HOR_FINAL "
                        . " , STATUS "
                    . " ) "
                    . " VALUES ("
                        . " TO_DATE('" . $cabec->dthrCabecViagem . "','DD/MM/YYYY HH24:MI')"
                        . " , TO_DATE('" . $cabec->dthrCabecViagem . "','DD/MM/YYYY HH24:MI')"
                        . " , SYSDATE "
                        . " , " . $cabec->idEquipCabecViagem
                        . " , " . $cabec->matricMotoCabecViagem
                        . " , " . $cabec->idTurnoCabecViagem
                        . " , " . $cabec->idTrajetoCabecViagem
                        . " , " . $cabec->hodometroInicialCabecViagem
                        . " , " . $cabec->hodometroFinalCabecViagem
                        . " , 2 "
                    . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function updateCabecFechado($idCabec, $cabec) {

        if ($cabec->hodometroFinalCabecViagem > 9999999) {
            $cabec->hodometroFinalCabecViagem = 0;
        }

        $sql = "UPDATE PCO_CABEC_VIAGEM "
                    . " SET "
                        . " HOD_HOR_FINAL = " . $cabec->hodometroFinalCabecViagem
                        . " , STATUS = 2 "
                    . " WHERE "
                        . " ID = " . $idCabec;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
