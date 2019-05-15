<?php


class Model {

    /**
     * Tem que ser de último nível ou recursivo
     * @param $aDados
     * @param null $oModel
     * @throws ReflectionException
     */
    public function setBean($aDados, $oModel = null) {
        if(is_null($oModel)) {
            $oModel = $this;
        }

        $oClass = new ReflectionClass($oModel);
        if(count($aDados) > 0) {
            foreach ($aDados as $xChave => $xValor) {
                if(is_array($xValor)) {
                    $this->setBean($xValor, $oModel);
                } else {
                    if($oClass->hasProperty($xChave)) {
                        $sMethod = 'set' . ucfirst($xChave);
                        if($oClass->hasMethod($sMethod)) {
                            $oModel->$sMethod($xValor);
                        }
                    }
                }

            }
        }
    }

    public function getAll($aDados) {
        $aRetorno = [];
        if(count($aDados) > 0) {
            foreach ($aDados as $xValor) {
                if(is_array($xValor)) {
                    $oModel = new $this;
                    $this->setBean($xValor, $oModel);
                    $aRetorno[] = $oModel;
                }

            }
        }
        return $aRetorno;

    }
}