<?php
require_once dirname(__DIR__) . '/model/ModelUtilisateur.php';

class ControllerConnexion
{
    // Affiche le formulaire de connexion
    public static function loginForm()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $erreur = NULL;
        require $root . 'app/view/connexion/viewLogin.php';
    }

    // Vérifie les identifiants et ouvre la session si corrects
    public static function login()
    {
        require dirname(__DIR__) . '/controller/config.php';

        $login    = isset($_GET['login'])    ? htmlspecialchars($_GET['login'])    : '';
        $password = isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '';

        $results = ModelUtilisateur::getByLogin($login);

        if (!empty($results) && $results[0]->getPassword() == $password) {
            // Authentification réussie : on mémorise l'id en session
            $_SESSION['login_id'] = $results[0]->getId();
            $utilisateur = $results[0];
            require $root . 'app/view/connexion/viewLogged.php';
        } else {
            $erreur = "Login ou mot de passe incorrect.";
            require $root . 'app/view/connexion/viewLogin.php';
        }
    }

    // Déconnecte l'utilisateur en remettant login_id à null
    public static function logout()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $_SESSION['login_id'] = null;
        require $root . 'app/view/connexion/viewLogout.php';
    }
}
