<?php
require_once 'Model.php';

class ModelUtilisateur
{
    private $id;
    private $nom;
    private $prenom;
    private $role;
    private $login;
    private $password;
    private $solde;

    // Constructeur : si $id est null (cas PDO::FETCH_CLASS), ne fait rien 
    // PDO a déjà rempli les attributs directement avant d'appeler le constructeur.
    public function __construct($id=NULL, $nom=NULL, $prenom=NULL, $role=NULL,
                                $login=NULL, $password=NULL, $solde=NULL)
    {
        if ($id !== NULL) {
            $this->id       = $id;
            $this->nom      = $nom;
            $this->prenom   = $prenom;
            $this->role     = $role;
            $this->login    = $login;
            $this->password = $password;
            $this->solde    = $solde;
        }
    }

    // --- Getters ---
    public function getId()       { return $this->id; }
    public function getNom()      { return $this->nom; }
    public function getPrenom()   { return $this->prenom; }
    public function getRole()     { return $this->role; }
    public function getLogin()    { return $this->login; }
    public function getPassword() { return $this->password; }
    public function getSolde()    { return $this->solde; }

    // --- Setters ---
    public function setId($id)             { $this->id = $id; }
    public function setNom($nom)           { $this->nom = $nom; }
    public function setPrenom($prenom)     { $this->prenom = $prenom; }
    public function setRole($role)         { $this->role = $role; }
    public function setLogin($login)       { $this->login = $login; }
    public function setPassword($password) { $this->password = $password; }
    public function setSolde($solde)       { $this->solde = $solde; }

    // --- Requêtes SQL (UNIQUEMENT ici, jamais dans les contrôleurs) ---

    // Retourne un tableau contenant l'utilisateur dont l'id correspond
    public static function getOne($id)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare('SELECT * FROM utilisateur WHERE id = :id');
            $req->execute([':id' => $id]);
            return $req->fetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');
        } catch (PDOException $e) {
            die("Erreur ModelUtilisateur::getOne : " . $e->getMessage());
        }
    }

    // Retourne un tableau contenant l'utilisateur dont le login correspond
    // Utilisé pour l'authentification
    public static function getByLogin($login)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare('SELECT * FROM utilisateur WHERE login = :login');
            $req->execute([':login' => $login]);
            return $req->fetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');
        } catch (PDOException $e) {
            die("Erreur ModelUtilisateur::getByLogin : " . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare('SELECT * FROM utilisateur ORDER BY nom');
            $req->execute();
            return $req->fetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');
        } catch (PDOException $e) {
            die("Erreur ModelUtilisateur::getAll : " . $e->getMessage());
        }
    }

    public static function insert($nom, $prenom, $role, $login, $password, $solde)
    {
        try {
            $db = Model::getInstance();

            // Calcul du prochain id
            $req = $db->prepare('SELECT MAX(id) FROM utilisateur');
            $req->execute();
            $maxId = $req->fetchColumn();
            $newId = ($maxId === null || $maxId === false) ? 1 : (int)$maxId + 1;

            $req = $db->prepare(
                'INSERT INTO utilisateur (id, nom, prenom, role, login, password, solde)
                 VALUES (:id, :nom, :prenom, :role, :login, :password, :solde)'
            );
            $req->execute([
                ':id'       => $newId,
                ':nom'      => $nom,
                ':prenom'   => $prenom,
                ':role'     => $role,
                ':login'    => $login,
                ':password' => $password,
                ':solde'    => $solde,
            ]);
            return $newId;
        } catch (PDOException $e) {
            return -1;
        }
    }
}
