<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');

/**
 * Description of AtualizaAplicDAO
 *
 * @author anderson
 */
class AtualAplicDAO extends Conn {

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function verAtual($nroAparelho) {

        $select = "SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PCO_ATUALIZACAO "
                . " WHERE "
                . " NRO_APARELHO = " . $nroAparelho;

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

    public function insAtual($nroAparelho, $va) {

        $sql = "INSERT INTO PCO_ATUALIZACAO ("
                . " NRO_APARELHO "
                . " , VERSAO_ATUAL "
                . " , VERSAO_NOVA "
                . " , DTHR_ULT_ATUAL "
                . " ) "
                . " VALUES ("
                . " " . $nroAparelho
                . " , TRIM(TO_CHAR(" . $va . ", '99999999D99')) "
                . " , TRIM(TO_CHAR(" . $va . ", '99999999D99')) "
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function retAtual($nroAparelho) {

        $select = " SELECT "
                . " VERSAO_NOVA"
                . " , VERSAO_ATUAL"
                . " FROM "
                . " PCO_ATUALIZACAO "
                . " WHERE "
                . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

    public function updAtualNova($nroAparelho, $va) {

        $sql = "UPDATE PCO_ATUALIZACAO "
                . " SET "
                . " VERSAO_ATUAL = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                . " , VERSAO_NOVA = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                . " , DTHR_ULT_ATUAL = SYSDATE "
                . " WHERE "
                . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function updAtual($nroAparelho, $va) {

        $sql = "UPDATE PCO_ATUALIZACAO "
                . " SET "
                . " VERSAO_ATUAL = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                . " , DTHR_ULT_ATUAL = SYSDATE "
                . " WHERE "
                . " NRO_APARELHO = " . $nroAparelho;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function dataHora() {

        $select = " SELECT "
                . " TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI') AS DTHR "
                . " FROM "
                . " DUAL ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result1 = $this->Read->fetchAll();

        foreach ($result1 as $item) {
            $dthr = $item['DTHR'];
        }

        return $dthr;
    }
    
}
