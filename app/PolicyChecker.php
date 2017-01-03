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
    private $policies = [];

    private function boot(){
        $this->policies = [
            //Time
            "-t" => [
                '00:00','23:59'
            ],
            //Days
            "-d" => [
                0,1,2,3,4,5,6
            ]
        ];
    }

    private function checkPolicy($policy)
    {
        $found = [];
        preg_match_all(self::Regex,$policy,$found);
        dd($found);
    }

    /**
     * @return boolean
     */
    public function moment($policy = null){
        if($policy == null)
            return true;

        $this->checkPolicy($policy);
    }

    private function validTime($arg){

    }

    private function validDays($arg){

    }
}