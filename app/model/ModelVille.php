<?php
require_once 'Model.php';

class ModelVille
{
    private $id;
    private $nom;

    public function __construct($id=NULL, $nom=NULL)
    {
        if ($id !== NULL) {
            $this->id  = $id;
            $this->nom = $nom;
        }
    }

    public function getId()  { return $this->id; }
    public function getNom() { return $this->nom; }

    public function setId($id)   { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }

    public static function getAll()
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare('SELECT * FROM ville ORDER BY nom');
            $req->execute();
            return $req->fetchAll(PDO::FETCH_CLASS, 'ModelVille');
        } catch (PDOException $e) {
            die("Erreur ModelVille::getAll : " . $e->getMessage());
        }
    }

    public static function insert($nom)
    {
        try {
            $db = Model::getInstance();

            // Calcul du prochain id
            $req = $db->prepare('SELECT MAX(id) FROM ville');
            $req->execute();
            $maxId = $req->fetchColumn();
            $newId = ($maxId === null || $maxId === false) ? 1 : (int)$maxId + 1;

            $req = $db->prepare('INSERT INTO ville (id, nom) VALUES (:id, :nom)');
            $req->execute([':id' => $newId, ':nom' => $nom]);
            return $newId;
        } catch (PDOException $e) {
            return -1;
        }
    }
}
