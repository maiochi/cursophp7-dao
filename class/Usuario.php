<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 07/03/2019
 * Time: 22:03
 */

class Usuario extends  Model {

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

    public function getList() {
        $oSql = new Sql();
        $aDados =  $oSql->select('select * from tb_usuarios order by deslogin');
        return $this->getAll($aDados);
    }

    public function search($sLogin) {
        $oSql = new Sql();
        $aDados =  $oSql->select("select * from tb_usuarios where deslogin like :SEARCH order by deslogin",
                                        [':SEARCH' => '%'.$sLogin.'%']);
        return $this->getAll($aDados);
    }

    public function insert() {
        $oSql = new Sql();
        // Chama a procedure do banco
        $xResult = $oSql->select('CALL sp_tbusuarios_insert(:LOGIN, :PASSWORD)', [':LOGIN' => $this->getDeslogin(), ':PASSWORD' => $this->getDessenha()]);

        if(count($xResult) > 0) {
            $this->setBean($xResult[0], $this);
        }
    }

    public function update() {
        $oSql = new Sql();
        $oSql->query('update tb_usuarios set deslogin = :LOGIN, dessenha = :PASSWORD where idusuario = :ID', [':LOGIN'     => $this->getDeslogin(),
                                                                                                                        ':PASSWORD' => $this->getDessenha(),
                                                                                                                        ':ID'       => $this->getIdusuario()]);
    }

    public function delete() {
        $oSql = new Sql();
        $oSql->query('delete from tb_usuarios where idusuario = :ID', [':ID' => $this->getIdusuario()]);
    }

    public function __toString() {
        return json_encode((array) $this);
    }
}