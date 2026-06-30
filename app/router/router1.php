<?php
session_start();

require_once(dirname(__DIR__) . '/controller/ControllerConnexion.php');
require_once(dirname(__DIR__) . '/controller/ControllerVille.php');
require_once(dirname(__DIR__) . '/controller/ControllerUtilisateur.php');
require_once(dirname(__DIR__) . '/controller/ControllerVehicule.php');
require_once(dirname(__DIR__) . '/controller/ControllerTrajet.php');
require_once(dirname(__DIR__) . '/controller/ControllerReservation.php');

// Extraction de l'action depuis l'URL (?action=xxx)
parse_str($_SERVER['QUERY_STRING'], $param);
$action = isset($param["action"]) ? htmlspecialchars($param["action"]) : "";

switch ($action) {

    // --- Connexion ---
    case "loginForm" :
    case "login" :
    case "logout" :
        ControllerConnexion::$action();
        break;

    // --- Villes (admin) ---
    case "villeReadAll" :
    case "villeCreate" :
    case "villeCreated" :
        ControllerVille::$action();
        break;

    // --- Utilisateurs (admin) ---
    case "utilisateurReadAll" :
    case "utilisateurCreateConducteur" :
    case "utilisateurCreatePassager" :
    case "utilisateurCreated" :
        ControllerUtilisateur::$action();
        break;

    // --- Véhicules (admin + conducteur) ---
    case "vehiculeReadAll" :
    case "vehiculeCreate" :
    case "vehiculeCreated" :
    case "vehiculeReadMine" :
        ControllerVehicule::$action();
        break;

    // --- Trajets (conducteur) ---
    case "trajetReadMine" :
    case "trajetCreate" :
    case "trajetCreated" :
    case "trajetPassagers" :
    case "trajetCloturer" :
        ControllerTrajet::$action();
        break;

    // --- Réservations (passager) ---
    case "reservationReadMine" :
    case "reservationCreate" :
    case "reservationCreated" :
        ControllerReservation::$action();
        break;

    default :
        ControllerConnexion::loginForm();
        break;
}
