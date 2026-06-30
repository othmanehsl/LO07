<?php
require_once 'Model.php';

class ModelTrajet
{
    private $id;
    private $ville_depart;
    private $ville_arrivee;
    private $conducteur_id;
    private $vehicule_id;
    private $prix;
    private $date_depart;
    private $heure_depart;
    private $statut;

    public function __construct($id=NULL, $ville_depart=NULL, $ville_arrivee=NULL,
                                $conducteur_id=NULL, $vehicule_id=NULL, $prix=NULL,
                                $date_depart=NULL, $heure_depart=NULL, $statut=NULL)
    {
        if ($id !== NULL) {
            $this->id            = $id;
            $this->ville_depart  = $ville_depart;
            $this->ville_arrivee = $ville_arrivee;
            $this->conducteur_id = $conducteur_id;
            $this->vehicule_id   = $vehicule_id;
            $this->prix          = $prix;
            $this->date_depart   = $date_depart;
            $this->heure_depart  = $heure_depart;
            $this->statut        = $statut;
        }
    }

    public function getId()           { return $this->id; }
    public function getVilleDepart()  { return $this->ville_depart; }
    public function getVilleArrivee() { return $this->ville_arrivee; }
    public function getConducteurId() { return $this->conducteur_id; }
    public function getVehiculeId()   { return $this->vehicule_id; }
    public function getPrix()         { return $this->prix; }
    public function getDateDepart()   { return $this->date_depart; }
    public function getHeureDepart()  { return $this->heure_depart; }
    public function getStatut()       { return $this->statut; }

    public function setId($id)                   { $this->id = $id; }
    public function setVilleDepart($v)           { $this->ville_depart = $v; }
    public function setVilleArrivee($v)          { $this->ville_arrivee = $v; }
    public function setConducteurId($v)          { $this->conducteur_id = $v; }
    public function setVehiculeId($v)            { $this->vehicule_id = $v; }
    public function setPrix($v)                  { $this->prix = $v; }
    public function setDateDepart($v)            { $this->date_depart = $v; }
    public function setHeureDepart($v)           { $this->heure_depart = $v; }
    public function setStatut($v)                { $this->statut = $v; }

    // C2 : trajets d'un conducteur avec noms de villes (double jointure sur la table ville)
    // FETCH_ASSOC car le résultat croise trajet + ville départ + ville arrivée
    public static function getByConducteur($conducteur_id)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare(
                'SELECT t.id, vd.nom AS ville_depart, va.nom AS ville_arrivee,
                        t.prix, t.date_depart, t.heure_depart, t.statut
                 FROM trajet t, ville vd, ville va
                 WHERE t.ville_depart = vd.id
                   AND t.ville_arrivee = va.id
                   AND t.conducteur_id = :cid
                 ORDER BY t.date_depart'
            );
            $req->execute([':cid' => $conducteur_id]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur ModelTrajet::getByConducteur : " . $e->getMessage());
        }
    }

    // C3 : insertion d'un nouveau trajet, statut 'actif' par défaut
    public static function insert($ville_depart, $ville_arrivee, $conducteur_id,
                                  $vehicule_id, $prix, $date_depart, $heure_depart)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare('SELECT MAX(id) FROM trajet');
            $req->execute();
            $maxId = $req->fetchColumn();
            $newId = ($maxId === null || $maxId === false) ? 1 : (int)$maxId + 1;

            $req = $db->prepare(
                "INSERT INTO trajet
                    (id, ville_depart, ville_arrivee, conducteur_id, vehicule_id,
                     prix, date_depart, heure_depart, statut)
                 VALUES
                    (:id, :ville_depart, :ville_arrivee, :conducteur_id, :vehicule_id,
                     :prix, :date_depart, :heure_depart, 'actif')"
            );
            $req->execute([
                ':id'            => $newId,
                ':ville_depart'  => $ville_depart,
                ':ville_arrivee' => $ville_arrivee,
                ':conducteur_id' => $conducteur_id,
                ':vehicule_id'   => $vehicule_id,
                ':prix'          => $prix,
                ':date_depart'   => $date_depart,
                ':heure_depart'  => $heure_depart,
            ]);
            return $newId;
        } catch (PDOException $e) {
            return -1;
        }
    }

    // P2 : tous les trajets actifs disponibles à la réservation (tous conducteurs)
    public static function getAllActifs()
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare(
                'SELECT t.id, vd.nom AS ville_depart, va.nom AS ville_arrivee,
                        t.date_depart, t.heure_depart, t.prix,
                        u.prenom AS conducteur_prenom, u.nom AS conducteur_nom
                 FROM trajet t, ville vd, ville va, utilisateur u
                 WHERE t.ville_depart = vd.id
                   AND t.ville_arrivee = va.id
                   AND t.conducteur_id = u.id
                   AND t.statut = \'actif\'
                 ORDER BY t.date_depart'
            );
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur ModelTrajet::getAllActifs : " . $e->getMessage());
        }
    }

    // C4/C5 : trajets ACTIFS d'un conducteur (pour les formulaires de sélection)
    public static function getActifsByConducteur($conducteur_id)
    {
        try {
            $db  = Model::getInstance();
            $req = $db->prepare(
                'SELECT t.id, vd.nom AS ville_depart, va.nom AS ville_arrivee, t.date_depart
                 FROM trajet t, ville vd, ville va
                 WHERE t.ville_depart = vd.id AND t.ville_arrivee = va.id
                   AND t.conducteur_id = :cid AND t.statut = \'actif\'
                 ORDER BY t.date_depart'
            );
            $req->execute([':cid' => $conducteur_id]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur ModelTrajet::getActifsByConducteur : " . $e->getMessage());
        }
    }

    // C5 : clôture d'un trajet avec paiements — TOUT ou RIEN via transaction PDO
    public static function cloturer($trajet_id)
    {
        $db = Model::getInstance();
        try {
            $db->beginTransaction();

            // 1. Vérifier que le trajet existe et est bien actif
            $req = $db->prepare('SELECT prix, conducteur_id, statut FROM trajet WHERE id = :tid');
            $req->execute([':tid' => $trajet_id]);
            $trajet = $req->fetch(PDO::FETCH_ASSOC);

            if (!$trajet || $trajet['statut'] !== 'actif') {
                $db->rollBack();
                return false;
            }

            $prix          = $trajet['prix'];
            $conducteur_id = $trajet['conducteur_id'];

            // 2. Récupérer toutes les réservations du trajet
            $req = $db->prepare('SELECT passager_id FROM reservation WHERE trajet_id = :tid');
            $req->execute([':tid' => $trajet_id]);
            $reservations = $req->fetchAll(PDO::FETCH_ASSOC);

            // 3. Pour chaque réservation : débiter le passager et créditer le conducteur
            // Les deux requêtes sont préparées une seule fois pour l'efficacité
            $reqDebit  = $db->prepare('UPDATE utilisateur SET solde = solde - :prix WHERE id = :pid');
            $reqCredit = $db->prepare('UPDATE utilisateur SET solde = solde + :prix WHERE id = :cid');

            foreach ($reservations as $resa) {
                $reqDebit->execute([':prix' => $prix, ':pid' => $resa['passager_id']]);
                $reqCredit->execute([':prix' => $prix, ':cid' => $conducteur_id]);
            }

            // 4. Passer le trajet en passif
            $req = $db->prepare("UPDATE trajet SET statut = 'passif' WHERE id = :tid");
            $req->execute([':tid' => $trajet_id]);

            // 5. Valider toutes les opérations en une seule fois
            $db->commit();
            return true;

        } catch (PDOException $e) {
            // En cas d'erreur, annuler TOUT (aucun paiement partiel)
            $db->rollBack();
            return false;
        }
    }
}
