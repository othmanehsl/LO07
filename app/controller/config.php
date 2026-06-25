<?php
define('DEBUG', FALSE);
define('LOCAL', TRUE);

if (LOCAL) {
    $dsn      = 'mysql:host=localhost;dbname=blablacar;charset=utf8';
    $username = 'root';
    $password = '';
} else {
    // Serveur UTT : remplacer les valeurs ci-dessous
    $dsn      = 'mysql:host=dev-isi.utt.fr;dbname=VOTRE_LOGIN;charset=utf8';
    $username = 'VOTRE_LOGIN';
    $password = 'VOTRE_MOT_DE_PASSE';
}

// Chemin absolu vers la racine du projet (LO07/)
$root = dirname(dirname(__DIR__)) . "/";

if (DEBUG) {
    echo "<ul>
        <li>dsn = $dsn</li>
        <li>username = $username</li>
        <li>root = $root</li>
    </ul>";
}
