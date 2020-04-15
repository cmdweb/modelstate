<?php
/**
 * @author: Gabriel Malaquias
 */

namespace Alcatraz\ModelState;

class Validation
{
    static function Required($var)
    {
        if (trim($var) == '' || $var == null)
            return false;
        return true;
    }

    static function Lenght($var, $max, $min = 0)
    {
        if (strlen(trim($var)) <= $max && strlen(trim($var)) >= $min)
            return true;
        return false;
    }

    static function Number($var)
    {
        if (is_numeric($var))
            return true;
        return false;
    }

    static function Range($var, $max, $min = 0)
    {
        if (self::Number($var) && $var <= $max && $var >= $min)
            return true;
        return false;
    }

    static function Email($var)
    {
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (!preg_match($regex, $var)) {
            return false;
        } else {
            return true;
        }
    }

    static function Date($var, $type = "br")
    {
        switch ($type) {
            case "br":
                if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $var))
                    return true;
                return false;
                break;

            case "eu":
                if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $var))
                    return true;
                return false;
                break;
        }
    }

    static function Compare($var1, $var2)
    {
        if ($var1 === $var2)
            return true;
        return false;
    }

    static function validaCPF($cpf = null)
    {
        // Verifica se um n�mero foi informado
        if (empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados � igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequ�ncias invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else
            if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf ==
                '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf ==
                '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf ==
                '99999999999'
            ) {
                return false;
                // Calcula os digitos verificadores para verificar se o
                // CPF � v�lido
            } else {

                for ($t = 9; $t < 11; $t++) {

                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf{$c} * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf{$c} != $d) {
                        return false;
                    }
                }

                return true;
            }
    }

    static function validaCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }
}
