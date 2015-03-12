<?php
/**
 * Created by PhpStorm.
 * User: gabriel.malaquias
 * Date: 16/12/2014
 * Time: 11:55
 */

namespace ModelState\Validators;


use ModelState\ModelState;
use ModelState\Validation;

abstract class Email implements iValidator {

    public static function isValid(Attributes $object){
        if(array_key_exists('Required',$object->_allOptions)) {
            if (!Validation::Email($object->_value))
                ModelState::addError("O campo " . $object->_displayName . " deve ser um e-mail.");
        }else{
            if (!Validation::Email($object->_value) && $object->_value != '')
                ModelState::addError("O campo " . $object->_displayName . " deve ser um e-mail.");
        }
    }

} 