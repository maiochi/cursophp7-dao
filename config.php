<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 07/03/2019
 * Time: 21:51
 */
spl_autoload_register(function($sClassName) {
    $sFileName = 'class'.DIRECTORY_SEPARATOR.$sClassName.'.php';
    if(file_exists($sFileName)) {
        require_once($sFileName);
    }
});