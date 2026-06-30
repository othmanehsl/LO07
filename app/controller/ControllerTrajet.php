<?php
require_once dirname(__DIR__) . '/model/ModelTrajet.php';
require_once dirname(__DIR__) . '/model/ModelVille.php';
require_once dirname(__DIR__) . '/model/ModelVehicule.php';

class ControllerTrajet
{
    // C2 : trajets du conducteur connecté
    public static function trajetReadMine()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $id      = $_SESSION['login_id'];
        $results = ModelTrajet::getByConducteur($id);
        require $root . 'app/view/trajet/viewMine.php';
    }

    // C3 : formulaire de création de trajet
    public static function trajetCreate()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $id        = $_SESSION['login_id'];
        $villes    = ModelVille::getAll();                       // pour les deux <select> de villes
        $vehicules = ModelVehicule::getByProprietaire($id);     // uniquement les véhicules du conducteur
        require $root . 'app/view/trajet/viewCreate.php';
    }

    // C3 : traitement du formulaire
    public static function trajetCreated()
    {
        require dirname(__DIR__) . '/controller/config.php';

        // Le conducteur_id vient de la session, JAMAIS du formulaire (sécurité)
        $conducteur_id = $_SESSION['login_id'];
        $ville_depart  = isset($_GET['ville_depart'])  ? (int)$_GET['ville_depart']              : 0;
        $ville_arrivee = isset($_GET['ville_arrivee']) ? (int)$_GET['ville_arrivee']             : 0;
        $vehicule_id   = isset($_GET['vehicule_id'])   ? (int)$_GET['vehicule_id']               : 0;
        $prix          = isset($_GET['prix'])          ? (float)$_GET['prix']                    : 0.0;
        $date_depart   = isset($_GET['date_depart'])   ? htmlspecialchars($_GET['date_depart'])   : '';
        $heure_depart  = isset($_GET['heure_depart'])  ? htmlspecialchars($_GET['heure_depart'])  : '';

        $results = ModelTrajet::insert(
            $ville_depart, $ville_arrivee, $conducteur_id,
            $vehicule_id, $prix, $date_depart, $heure_depart
        );
        require $root . 'app/view/trajet/viewCreated.php';
    }
}
