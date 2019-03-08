<?php
/**
 * User: Diego Maiochi
 * Date: 07/03/2019
 * Time: 21:26
 */
class Sql extends PDO {

    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
    }

    private function setParam($statment, $xChave, $xValor) {
        $statment->bindParam($xChave, $xValor);
    }

    private function setParams($statment, $aParametros = []) {
        foreach($aParametros as $xChave => $xValor) {
            $this->setParam($statment, $xChave, $xValor);
        }
    }

    public function query($rawQuery, $aParametros = []) {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $aParametros);

        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $aParametros = []) {
        $stmt = $this->query($rawQuery, $aParametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}