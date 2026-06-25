<?php
// Classe mère de tous les modèles — connexion PDO en singleton
class Model extends PDO
{
    private static $_instance = NULL;

    public function __construct() {}

    // Retourne l'unique instance PDO (la crée si elle n'existe pas encore)
    public static function getInstance()
    {
        if (self::$_instance === NULL) {
            require(dirname(__DIR__) . '/controller/config.php');

            try {
                self::$_instance = new PDO(
                    $dsn, $username, $password,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }

        return self::$_instance;
    }
}
