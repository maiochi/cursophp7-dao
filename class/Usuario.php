<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 07/03/2019
 * Time: 22:03
 */

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function setIdusuario($id) {
        $this->idusuario = $id;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setDeslogin($login) {
        $this->deslogin = $login;
    }

    public function getDeslogin() {
        return $this->deslogin;
    }

    public function setDessenha($senha) {
        $this->dessenha = $senha;
    }

    public function getDessenha() {
        return $this->dessenha;
    }

    public function setDtcadastro($data) {
        return $this->dtcadastro = $data;
    }

    public function getDtcadastro() {
        return $this->dtcadastro;
    }

    public function loadById($id) {
        $oSql = new Sql();

        $xResults = $oSql->select('select * from tb_usuarios where idusuario = :ID', [':ID' => $id]);

        if(count($xResults) > 0) {
            $aRetorno = $xResults[0];
            foreach($aRetorno as $xChave => $xValor) {
                if(property_exists($this, $xChave)) {
                    $this->$xChave = $xValor;
                }
            }
        }
    }

    public function __toString() {
        return json_encode((array) $this);
    }
}