<?php
/**
 * Created by PhpStorm.
 * User: gabriel.malaquias
 * Date: 16/12/2014
 * Time: 11:55
 */

namespace Alcatraz\ModelState\Validators;

use Alcatraz\ModelState\ModelState;
use Alcatraz\ModelState\Validation;

abstract class Required implements iValidator {

    public static function isValid(Attributes $object){
        if(!Validation::Required($object->_value))
            ModelState::addError("O campo " . $object->_displayName . " é obrigatório.");
    }

} 