<?php
require_once dirname(__DIR__) . '/model/ModelVille.php';

class ControllerVille
{
    public static function villeReadAll()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $results = ModelVille::getAll();
        require $root . 'app/view/ville/viewAll.php';
    }

    public static function villeCreate()
    {
        require dirname(__DIR__) . '/controller/config.php';
        require $root . 'app/view/ville/viewCreate.php';
    }

    public static function villeCreated()
    {
        require dirname(__DIR__) . '/controller/config.php';
        $nom     = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
        $results = ModelVille::insert($nom);
        require $root . 'app/view/ville/viewCreated.php';
    }
}
