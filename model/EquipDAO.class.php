<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/ConnApex.class.php');
/**
 * Description of EquipDAO
 *
 * @author anderson
 */
class EquipDAO extends ConnApex {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($base) {

        $select = " SELECT "
                        . " E.EQUIP_ID AS \"idEquip\" "
                        . " , E.NRO_EQUIP AS \"nroEquip\" "
                        . " , E.CLASSOPER_CD AS \"codClasseEquip\" "
                        . " , CARACTER(E.CLASSOPER_DESCR) AS \"descrClasseEquip\" "
                        . " , E.TPTUREQUIP_CD AS \"codTurno\""
                        . " , 1 AS \"tipoEquip\""
                    . " FROM "
                        . " V_EQUIP_AGRIC E "
                    . " WHERE "
                        . " E.CLASSOPER_CD = 27 "
                        . " AND "
                        . " E.MODELEQUIP_ID != 952 "
                    . " UNION "
                    . " SELECT "
                        . " E.EQUIP_ID AS \"idEquip\" "
                        . " , E.NRO_EQUIP AS \"nroEquip\" "
                        . " , E.CLASSOPER_CD AS \"codClasseEquip\" "
                        . " , CARACTER(E.CLASSOPER_DESCR) AS \"descrClasseEquip\" "
                        . " , E.TPTUREQUIP_CD AS \"codTurno\" "
                        . " , 2 AS \"tipoEquip\""
                    . " FROM "
                        . " V_EQUIP_AGRIC E "
                        . " , STAFE.PCO_ONIBUS_TERCEIRO O "
                    . " WHERE "
                        . " E.EQUIP_ID = O.EQUIP_ID ";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

    
}
