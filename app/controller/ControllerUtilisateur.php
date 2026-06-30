<?php
require_once dirname(__DIR__) . '/model/ModelUtilisateur.php';

class ControllerUtilisateur
{
    public static function utilisateurReadAll()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $results = ModelUtilisateur::getAll();
        require $root . 'app/view/utilisateur/viewAll.php';
    }

    public static function utilisateurCreateConducteur()
    {
        require dirname(__DIR__) . '/controller/config.php';
        require $root . 'app/view/utilisateur/viewCreateConducteur.php';
    }

    public static function utilisateurCreatePassager()
    {
        require dirname(__DIR__) . '/controller/config.php';
        require $root . 'app/view/utilisateur/viewCreatePassager.php';
    }

    public static function utilisateurCreated()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $nom      = isset($_GET['nom'])      ? htmlspecialchars($_GET['nom'])      : '';
        $prenom   = isset($_GET['prenom'])   ? htmlspecialchars($_GET['prenom'])   : '';
        $role     = isset($_GET['role'])     ? htmlspecialchars($_GET['role'])     : '';
        $login    = isset($_GET['login'])    ? htmlspecialchars($_GET['login'])    : '';
        $password = isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '';
        $solde    = isset($_GET['solde'])    ? (float)$_GET['solde']              : 0.0;

        $results = ModelUtilisateur::insert($nom, $prenom, $role, $login, $password, $solde);
        require $root . 'app/view/utilisateur/viewCreated.php';
    }
}
