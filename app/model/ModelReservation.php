<?php
require_once 'Model.php';

class ModelReservation
{
    private $id;
    private $trajet_id;
    private $passager_id;

    public function __construct($id=NULL, $trajet_id=NULL, $passager_id=NULL)
    {
        if ($id !== NULL) {
            $this->id          = $id;
            $this->trajet_id   = $trajet_id;
            $this->passager_id = $passager_id;
        }
    }

    public function getId()         { return $this->id; }
    public function getTrajetId()   { return $this->trajet_id; }
    public function getPassagerId() { return $this->passager_id; }

    public function setId($id)               { $this->id = $id; }
    public function setTrajetId($trajet_id)  { $this->trajet_id = $trajet_id; }
    public function setPassagerId($pid)      { $this->passager_id = $pid; }

    // C4 : passagers ayant réservé un trajet donné, avec leur identité (jointure)
    // Un même passager peut apparaître plusieurs fois s'il a plusieurs réservations
    public static function getPassagersByTrajet($trajet_id)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare(
                'SELECT u.prenom, u.nom, u.login
                 FROM reservation r, utilisateur u
                 WHERE r.passager_id = u.id AND r.trajet_id = :tid
                 ORDER BY u.nom'
            );
            $req->execute([':tid' => $trajet_id]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur ModelReservation::getPassagersByTrajet : " . $e->getMessage());
        }
    }

    // P1 : réservations d'un passager avec toutes les infos lisibles du trajet
    public static function getByPassager($passager_id)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare(
                'SELECT r.id, vd.nom AS ville_depart, va.nom AS ville_arrivee,
                        t.date_depart, t.heure_depart, t.prix, t.statut,
                        u.prenom AS conducteur_prenom, u.nom AS conducteur_nom
                 FROM reservation r, trajet t, ville vd, ville va, utilisateur u
                 WHERE r.trajet_id = t.id
                   AND t.ville_depart = vd.id
                   AND t.ville_arrivee = va.id
                   AND t.conducteur_id = u.id
                   AND r.passager_id = :pid
                 ORDER BY t.date_depart'
            );
            $req->execute([':pid' => $passager_id]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur ModelReservation::getByPassager : " . $e->getMessage());
        }
    }

    // P2 : créer une réservation (le paiement se fait plus tard à la clôture C5)
    public static function insert($trajet_id, $passager_id)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare('SELECT MAX(id) FROM reservation');
            $req->execute();
            $maxId = $req->fetchColumn();
            $newId = ($maxId === null || $maxId === false) ? 1 : (int)$maxId + 1;

            $req = $db->prepare(
                'INSERT INTO reservation (id, trajet_id, passager_id)
                 VALUES (:id, :trajet_id, :passager_id)'
            );
            $req->execute([
                ':id'          => $newId,
                ':trajet_id'   => $trajet_id,
                ':passager_id' => $passager_id,
            ]);
            return $newId;
        } catch (PDOException $e) {
            return -1;
        }
    }
}
