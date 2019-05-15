<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 07/03/2019
 * Time: 21:53
 */
require_once 'config.php';
/*$oSql = new Sql();
$xUsuarios = $oSql->select('select * from tb_usuarios');
echo json_encode($xUsuarios);*/

$oUsuario = new Usuario();
//$oUsuario->loadById(30);
//echo $oUsuario;

//echo '<pre>'.print_r($oUsuario->getList(), true).'</pre>';
//echo '<pre>'.print_r($oUsuario->search('ma'), true).'</pre>';
//echo $oUsuario;

$aUsuarios = $oUsuario->getList();
foreach($aUsuarios as $oModelUsuario) {
    $oModelUsuario->delete();
}
//$oUsuario->setDeslogin('Diego Marques Maiochi');
//$oUsuario->setDessenha('1234');
//$oUsuario->delete();
//echo $oUsuario;