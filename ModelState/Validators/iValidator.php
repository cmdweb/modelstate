<?php
/**
 * Created by PhpStorm.
 * User: gabriel.malaquias
 * Date: 16/12/2014
 * Time: 11:44
 */

namespace ModelState\Validators;


interface iValidator {


    public static function isValid(Attributes $object);


} 