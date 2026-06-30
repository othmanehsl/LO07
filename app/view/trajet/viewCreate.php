<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Créer un trajet</h2>

  <form method="get" action="router1.php" class="col-md-5">
    <input type="hidden" name="action" value="trajetCreated">

    <div class="mb-3">
      <label class="form-label">Ville de départ</label>
      <select class="form-select" name="ville_depart" required>
        <?php foreach ($villes as $ville): ?>
          <option value="<?= $ville->getId() ?>"><?= htmlspecialchars($ville->getNom()) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Ville d'arrivée</label>
      <select class="form-select" name="ville_arrivee" required>
        <?php foreach ($villes as $ville): ?>
          <option value="<?= $ville->getId() ?>"><?= htmlspecialchars($ville->getNom()) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Véhicule</label>
      <select class="form-select" name="vehicule_id" required>
        <?php foreach ($vehicules as $vehicule): ?>
          <option value="<?= $vehicule->getId() ?>">
            <?= htmlspecialchars($vehicule->getMarque() . ' ' . $vehicule->getModele()) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Prix (€)</label>
      <input type="number" step="0.01" min="0" class="form-control" name="prix" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Date de départ</label>
      <input type="date" class="form-control" name="date_depart" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Heure de départ</label>
      <input type="time" class="form-control" name="heure_depart" required>
    </div>

    <button type="submit" class="btn btn-success">Créer le trajet</button>
    <a href="router1.php?action=trajetReadMine" class="btn btn-secondary ms-2">Annuler</a>
  </form>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
