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

class TransactionValidator
{
    /**
     * validate
     * To do: check is data optional?
     * Data is not optional on spec, see https://github.com/happyuc-project/wiki/wiki/JSON-RPC#eth_sendtransaction
     * 
     * @param array $value
     * @return bool
     */
    public static function validate($value)
    {
        if (!is_array($value)) {
            return false;
        }
        if (!isset($value['from'])) {
            return false;
        }
        if (AddressValidator::validate($value['from']) === false) {
            return false;
        }
        if (isset($value['to']) && AddressValidator::validate($value['to']) === false && $value['to'] !== '') {
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
        // if (!isset($value['data'])) {
        //     return false;
        // }
        // if (HexValidator::validate($value['data']) === false) {
        //     return false;
        // }
        if (isset($value['data']) && HexValidator::validate($value['data']) === false) {
            return false;
        }
        if (isset($value['nonce']) && QuantityValidator::validate($value['nonce']) === false) {
            return false;
        }
        return true;
    }
}