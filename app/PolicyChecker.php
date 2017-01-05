<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 29/12/2016
 * Time: 17:37
 */

namespace App;


use Carbon\Carbon;

class PolicyChecker
{
    const REGEX = "#(-[a-z])([\s][a-z0-9\s:,]*){1,}# "; //Expression régulière gérant la conformité de la police d'untilisateur
    private $policies = [];

    public function __construct()
    {
        $this->boot();
    }

    private function boot(){
        $this->policies = [
            //Time
            "-t" => [
                'd' => '00:00', //heure de début
                'f' => '23:59'  //heure de fin
            ],
            //Days
            "-d" => [ 0,1,2,3,4,5,6 ],
        ];
    }

    private function checkPolicy($policy)
    {
        $found = []; $realPolicy = [];
        preg_match_all(self::REGEX,$policy,$found);

        //formattage des polices
        if(count($found) != 0)
        {
            foreach ($found[0] as $k => $v)
            {
                switch ($found[1][$k]){
                    case '-t' : list($d,$f) = explode(' ',trim($found[2][$k]));
                                $realPolicy['-t'] = ['d' => $d, 'f' => $f];
                                $this->policies = array_merge($this->policies,$realPolicy);
                                break;

                    case '-d' : $this->policies['-d'] = explode(',',trim($found[2][$k]));
                                break;
                    default : null;
                }
            }
        }

        return $this->policies;
    }

    /**
     * @return boolean
     * @param string $policy        Police gérant les accès de l'utilisateur
     */
    public function moment($policy = null)
    {
        if($policy == null)
            return true;

        return $this->passPolicy($this->checkPolicy($policy));
    }

    /**
     * @param array $args
     * @return
     */
    private function passPolicy(array $args=[])
    {
        if($this->validDays() && $this->validTime())
            return true;

        return false;
    }

    /**
     * @return bool
     * @see retourne true si le temps de connexion est conforme
     */
    private function validTime()
    {
        //Début
        list($hd,$md) = explode(':',$this->policies['-t']['d']);
        $debut = Carbon::createFromTime($hd,$md)->diffInMinutes(Carbon::now(),false);
        if($debut < 0) {
            return false;
        }

        //Fin
        list($hf,$mf) = explode(':',$this->policies['-t']['f']);
        $fin = Carbon::createFromTime($hf,$mf)->diffInMinutes(Carbon::now(),false);
        if($fin > 0){
            return false;
        }

        return true;
    }

    /**
     * @return bool
     * @see retourne true si le jour de connexion est conforme
     */
    private function validDays()
    {
        $today = Carbon::now()->dayOfWeek;

        if(array_search($today,$this->policies['-d']) === false)
            return false;

        return true;
    }
}