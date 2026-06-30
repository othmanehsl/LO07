<?php
require_once 'Model.php';

class ModelVehicule
{
    private $id;
    private $marque;
    private $modele;
    private $annee;
    private $immatriculation;
    private $proprietaire_id;

    public function __construct($id=NULL, $marque=NULL, $modele=NULL, $annee=NULL,
                                $immatriculation=NULL, $proprietaire_id=NULL)
    {
        if ($id !== NULL) {
            $this->id              = $id;
            $this->marque          = $marque;
            $this->modele          = $modele;
            $this->annee           = $annee;
            $this->immatriculation = $immatriculation;
            $this->proprietaire_id = $proprietaire_id;
        }
    }

    public function getId()              { return $this->id; }
    public function getMarque()          { return $this->marque; }
    public function getModele()          { return $this->modele; }
    public function getAnnee()           { return $this->annee; }
    public function getImmatriculation() { return $this->immatriculation; }
    public function getProprietaireId()  { return $this->proprietaire_id; }

    public function setId($id)                        { $this->id = $id; }
    public function setMarque($marque)                { $this->marque = $marque; }
    public function setModele($modele)                { $this->modele = $modele; }
    public function setAnnee($annee)                  { $this->annee = $annee; }
    public function setImmatriculation($immat)        { $this->immatriculation = $immat; }
    public function setProprietaireId($proprietaire_id) { $this->proprietaire_id = $proprietaire_id; }

    // Jointure véhicule ↔ utilisateur pour afficher le propriétaire en "Prénom Nom"
    // FETCH_ASSOC car le résultat mélange deux tables (pas de classe unique à mapper)
    public static function getAllWithProprietaire()
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare(
                'SELECT vehicule.marque, vehicule.modele, vehicule.annee,
                        vehicule.immatriculation, utilisateur.prenom, utilisateur.nom
                 FROM vehicule, utilisateur
                 WHERE vehicule.proprietaire_id = utilisateur.id
                 ORDER BY vehicule.marque'
            );
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur ModelVehicule::getAllWithProprietaire : " . $e->getMessage());
        }
    }

    // Liste des conducteurs pour alimenter le <select> du formulaire d'ajout
    public static function getAllProprietairesPossibles()
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare(
                "SELECT id, prenom, nom FROM utilisateur WHERE role = 'conducteur' ORDER BY nom"
            );
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur ModelVehicule::getAllProprietairesPossibles : " . $e->getMessage());
        }
    }

    public static function insert($marque, $modele, $annee, $immatriculation, $proprietaire_id)
    {
        try {
            $db = Model::getInstance();

            $req = $db->prepare('SELECT MAX(id) FROM vehicule');
            $req->execute();
            $maxId = $req->fetchColumn();
            $newId = ($maxId === null || $maxId === false) ? 1 : (int)$maxId + 1;

            $req = $db->prepare(
                'INSERT INTO vehicule (id, marque, modele, annee, immatriculation, proprietaire_id)
                 VALUES (:id, :marque, :modele, :annee, :immatriculation, :proprietaire_id)'
            );
            $req->execute([
                ':id'              => $newId,
                ':marque'          => $marque,
                ':modele'          => $modele,
                ':annee'           => $annee,
                ':immatriculation' => $immatriculation,
                ':proprietaire_id' => $proprietaire_id,
            ]);
            return $newId;
        } catch (PDOException $e) {
            return -1;
        }
    }
}
