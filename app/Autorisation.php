<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 27/11/2016
 * Time: 14:42
 */

namespace App;


class Autorisation
{
    const ADMIN = 'admin';
    const RBOM = 'rbom';
    const CIE = 'cie';
    const DIRECTEUR = 'directeur';
    const EQUIPE_TRAVAUX = 'equipe';
    const RTM = 'rtmdoc';
    const RGS = 'stock';
    const RPS = 'rps';

    /**
     * @param IdentiteAcces $identiteAcces      L'utilisateur à controller
     * @param string $role      Le role requis pour cette route
     * @return bool
     */
    public static function isAllowed(IdentiteAcces $identiteAcces, $role)
    {
        $authorizations = json_decode($identiteAcces->autorisation);

        if(array_search($role, $authorizations) !== false)
            return true;
        else
            return false;
    }

    /**
     * @param $authorizations
     * @return null|string
     */
    public static function routing($authorizations)
    {
        $redirectTo = null;

        //directeur
        if (array_search(Autorisation::DIRECTEUR, $authorizations) !== false) {
            $redirectTo = "accueil_" . Autorisation::DIRECTEUR;
        } //admin
        elseif (array_search(Autorisation::ADMIN, $authorizations) !== false) {
            $redirectTo = "accueil_" . Autorisation::ADMIN;
        } //rbom
        elseif (array_search(Autorisation::RBOM, $authorizations) !== false) {
            $redirectTo = "accueil_" . Autorisation::RBOM;
        } //rtm
        elseif (array_search(Autorisation::RTM, $authorizations) !== false) {
            $redirectTo = "accueil_" . Autorisation::RTM;
        } //equipe
        elseif (array_search(Autorisation::EQUIPE_TRAVAUX, $authorizations) !== false) {
            $redirectTo = "accueil_" . Autorisation::EQUIPE_TRAVAUX;
        } //cie
        elseif (array_search(Autorisation::CIE, $authorizations) !== false) {
            $redirectTo = "accueil_" . Autorisation::CIE;
        } //rgs
        elseif (array_search(Autorisation::RGS, $authorizations) !== false) {
            $redirectTo = "accueil_" . Autorisation::RGS;
        }

        return $redirectTo;
    }
}