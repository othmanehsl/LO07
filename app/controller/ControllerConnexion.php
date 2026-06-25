<?php
class ControllerConnexion
{
    // Affiche le formulaire de connexion (version minimale — étape 1)
    public static function loginForm()
    {
        require_once(dirname(__DIR__) . '/controller/config.php');

        echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>BlaBlaCar LO07</title>
</head>
<body>
    <h1>BlaBlaCar &mdash; le socle fonctionne !</h1>
    <p>Le routeur a bien appelé <strong>ControllerConnexion::loginForm()</strong>.</p>
</body>
</html>";
    }
}
