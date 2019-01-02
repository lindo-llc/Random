<?php

namespace App\Helpers;

/**
 * Random String Generator
 *
 * @since 2019-01-02
 * @version 0.1
 * @author Dwayne Walsh
 * @website https://github.com/DwayneWalsh
 *
 */

class Random
{
    
    public static function make($count = '10', $make = [
        'symbols' => [
            'letters' => [
                'uppercase' => true,
                'lowercase' => true
            ],
            'numbers' => true,
            'symbols' => false
        ],
        'options' => [
            'prefix' => false,
            'uppercaseAll' => false
        ]
    ]) 
    {
        $mk = '';
        if($make['symbols']['letters']['uppercase']) {
            $mk .= 'QWERTYUIOPASDFGHJKLZXCVBNM';
        }

        if($make['symbols']['letters']['lowercase']) {
            $mk .= 'qwertyuiopasdfghjklzxcvbnm';
        }

        if($make['symbols']['numbers']) {
            $mk .= '0123456789';
        }

        if($make['symbols']['symbols']) {
            $mk .= '-_~+[]"/.><!@#^*()';
        }

        if(!empty($mk)) {
            $return = '';
            $string = md5(time()*rand(000,999)+microtime());
            $string = substr(str_shuffle(md5($string)), 0, 5);
            $random = substr(str_shuffle($mk), 0, 30);

            if($make['options']['prefix']) {
                $return .= $string.'-';
            }

            $return .= $random;

            return ($make['options']['uppercaseAll'] ? strtoupper($return) : $return);

        } else if(ini_get("display_errors") === true) {
            throw new Exception(__CLASS__." ".__FUNCTION__." function Error. Neither (
                ".implode(", ", array_keys($make)).") were set to true");
        }
    }
}