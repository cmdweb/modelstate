<?php


namespace Alcatraz\ModelState\Validators;

use Alcatraz\ModelState\ModelState;
use Alcatraz\ModelState\Validation;

abstract class CNPJ implements iValidator {

    public static function isValid(Attributes $object){
        if(!Validation::validaCnpj($object->_value))
            ModelState::addError("O campo " . $object->_displayName . " não contém CNPJ válido.");
    }

} 