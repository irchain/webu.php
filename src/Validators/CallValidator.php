<?php

/**
 * This file is part of webu.php package.
 * 
 * (c) Kuan-Cheng,Lai <alk03073135@gmail.com>
 * 
 * @author Peter Lai <alk03073135@gmail.com>
 * @license MIT
 */

namespace Webu\Validators;

use Webu\Validators\IValidator;
use Webu\Validators\QuantityValidator;
use Webu\Validators\TagValidator;
use Webu\Validators\HexValidator;

class CallValidator
{
    /**
     * validate
     *
     * @param array $value
     * @return bool
     */
    public static function validate($value)
    {
        if (!is_array($value)) {
            return false;
        }
        if (isset($value['from']) && AddressValidator::validate($value['from']) === false) {
            return false;
        }
        if (!isset($value['to'])) {
            return false;
        }
        if (AddressValidator::validate($value['to']) === false) {
            return false;
        }
        if (isset($value['gas']) && QuantityValidator::validate($value['gas']) === false) {
            return false;
        }
        if (isset($value['gasPrice']) && QuantityValidator::validate($value['gasPrice']) === false) {
            return false;
        }
        if (isset($value['value']) && QuantityValidator::validate($value['value']) === false) {
            return false;
        }
        if (isset($value['data']) && HexValidator::validate($value['data']) === false) {
            return false;
        }
        if (isset($value['nonce']) && QuantityValidator::validate($value['nonce']) === false) {
            return false;
        }
        return true;
    }
}