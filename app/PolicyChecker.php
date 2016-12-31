<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 29/12/2016
 * Time: 17:37
 */

namespace App;


class PolicyChecker
{
    const Regex = "#([a-z])([\s][a-z0-9\s:,]*){1,}# ";

    public static function checkPolicy($policy = "-t 22:00 08:45| -d 1,2,3,4| -q azer")
    {
        $found = [];
        $a = preg_match_all(self::Regex,$policy,$found);
        var_dump($found);
    }
}