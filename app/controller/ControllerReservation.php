<?php
require_once dirname(__DIR__) . '/model/ModelReservation.php';
require_once dirname(__DIR__) . '/model/ModelTrajet.php';

class ControllerReservation
{
    // P1 : liste des réservations du passager connecté
    public static function reservationReadMine()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $id      = $_SESSION['login_id'];
        $results = ModelReservation::getByPassager($id);
        require $root . 'app/view/reservation/viewMine.php';
    }

    // P2 : affiche la liste des trajets actifs disponibles
    public static function reservationCreate()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $trajetsActifs = ModelTrajet::getAllActifs();
        require $root . 'app/view/reservation/viewCreate.php';
    }

    // P2 : enregistre la réservation (pas de paiement ici — paiement à la clôture C5)
    public static function reservationCreated()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $trajet_id  = isset($_GET['trajet_id']) ? (int)$_GET['trajet_id'] : 0;
        $passager_id = $_SESSION['login_id']; // vient de la session, jamais du formulaire

        $results = ModelReservation::insert($trajet_id, $passager_id);
        require $root . 'app/view/reservation/viewCreated.php';
    }
}
