<?php
require_once dirname(__DIR__) . '/model/ModelVehicule.php';

class ControllerVehicule
{
    public static function vehiculeReadAll()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $results = ModelVehicule::getAllWithProprietaire();
        require $root . 'app/view/vehicule/viewAll.php';
    }

    public static function vehiculeCreate()
    {
        require dirname(__DIR__) . '/controller/config.php';
        // Liste des conducteurs pour le menu déroulant du formulaire
        $proprietaires = ModelVehicule::getAllProprietairesPossibles();
        require $root . 'app/view/vehicule/viewCreate.php';
    }

    // C1 : liste des véhicules du conducteur connecté
    public static function vehiculeReadMine()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $id      = $_SESSION['login_id'];
        $results = ModelVehicule::getByProprietaire($id);
        require $root . 'app/view/vehicule/viewMine.php';
    }

    public static function vehiculeCreated()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $marque          = isset($_GET['marque'])          ? htmlspecialchars($_GET['marque'])          : '';
        $modele          = isset($_GET['modele'])          ? htmlspecialchars($_GET['modele'])          : '';
        $annee           = isset($_GET['annee'])           ? (int)$_GET['annee']                       : 0;
        $immatriculation = isset($_GET['immatriculation']) ? htmlspecialchars($_GET['immatriculation']) : '';
        $proprietaire_id = isset($_GET['proprietaire_id']) ? (int)$_GET['proprietaire_id']             : 0;

        $results = ModelVehicule::insert($marque, $modele, $annee, $immatriculation, $proprietaire_id);
        require $root . 'app/view/vehicule/viewCreated.php';
    }
}
