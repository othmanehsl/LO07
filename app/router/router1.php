<?php
session_start();

require_once(dirname(__DIR__) . '/controller/ControllerConnexion.php');
// Les autres contrôleurs seront ajoutés ici au fil des étapes

// Extraction de l'action depuis l'URL (?action=xxx)
parse_str($_SERVER['QUERY_STRING'], $param);
$action = isset($param["action"]) ? htmlspecialchars($param["action"]) : "";

switch ($action) {

    case "loginForm" :
    case "login" :
    case "logout" :
        ControllerConnexion::$action();
        break;

    default :
        ControllerConnexion::loginForm();
        break;
}
