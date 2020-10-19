<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of PassageiroDAO
 *
 * @author anderson
 */
class PassageiroDAO extends Conn {
    
    public function verifPassageiro($passageiro, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PCO_PASSAGEIRO "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $passageiro->dthrPassageiro . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " MATRIC_COLAB = " . $passageiro->matricColabPassageiro;

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insPassageiro($passageiro, $base) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PCO_PASSAGEIRO ("
                . " DTHR_VIAGEM "
                . " , DTHR_VIAGEM_CEL "
                . " , EQUIP_ID "
                . " , MATRIC_MOTORISTA "
                . " , TURNO_ID "
                . " , MATRIC_COLAB "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $ajusteDataHoraDAO->dataHoraGMT($passageiro->dthrViagemPassageiro, $base)
                . " , TO_DATE('" . $passageiro->dthrViagemPassageiro . "','DD/MM/YYYY HH24:MI')"
                . " , " . $passageiro->idEquipPassageiro
                . " , " . $passageiro->matricMotoPassageiro
                 . " , " . $passageiro->idTurnoPassageiro
                . " , " . $passageiro->matricColabPassageiro
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($passageiro->dthrPassageiro, $base)
                . " , TO_DATE('" . $passageiro->dthrPassageiro . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();

    }
    
}
