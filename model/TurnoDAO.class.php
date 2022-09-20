<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/ConnApex.class.php');
/**
 * Description of TurnoDAO
 *
 * @author anderson
 */
class TurnoDAO extends ConnApex {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " RJT.ID AS \"idRJornadaTurno\" "
                        . " , J.ID AS \"idJornada\" "
                        . " , T.ID AS \"idTurno\" "
                        . " , T.NRO AS \"nroTurno\" "
                        . " , 'TURNO ' || T.NRO || ': ' || T.HORARIO_INIC || ' - ' || T.HORARIO_FIM AS \"descTurno\" "
                    . " FROM "
                        . " PCO_JORNADA J "
                        . " , PCO_R_JORNADA_TURNO RJT "
                        . " , PCO_TURNO T "
                    . " WHERE "
                        . " J.ID = RJT.JORNADA_ID "
                        . " AND "
                        . " RJT.TURNO_ID = T.ID "
                    . " ORDER BY "
                        . " T.NRO "
                    . " ASC";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

}
