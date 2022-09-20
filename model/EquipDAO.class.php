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

    public function dados() {

        $select = " SELECT "
                        . " E.EQUIP_ID AS \"idEquip\" "
                        . " , E.NRO_EQUIP AS \"nroEquip\" "
                        . " , E.CLASSOPER_CD AS \"codClasseEquip\" "
                        . " , CARACTER(E.CLASSOPER_DESCR) AS \"descrClasseEquip\" "
                        . " , RJE.JORNADA_ID AS \"idJornada\""
                        . " , DECODE(O.EQUIP_ID, null, 1, 2) AS \"tipoEquip\""
                    . " FROM "
                        . " V_EQUIP_AGRIC E "
                        . " , STAFE.PCO_ONIBUS_TERCEIRO O "
                        . " , PCO_R_JORNADA_EQUIP RJE "
                    . " WHERE "
                        . " E.CLASSOPER_CD = 27 "
                        . " AND "
                        . " (E.MODELEQUIP_ID != 952 OR O.EQUIP_ID IS NOT NULL) "
                        . " AND "
                        . " E.EQUIP_ID = O.EQUIP_ID(+) "
                        . " AND "
                        . " RJE.EQUIP_ID = E.EQUIP_ID "
                    . " ORDER BY "
                        . " E.NRO_EQUIP "
                    . " ASC ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

    
}
