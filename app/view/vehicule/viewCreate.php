<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Ajouter un véhicule</h2>

  <form method="get" action="router1.php" class="col-md-5">
    <input type="hidden" name="action" value="vehiculeCreated">

    <div class="mb-3">
      <label class="form-label">Marque</label>
      <input type="text" class="form-control" name="marque" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Modèle</label>
      <input type="text" class="form-control" name="modele" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Année</label>
      <input type="number" class="form-control" name="annee" min="1990" max="2030" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Immatriculation</label>
      <input type="text" class="form-control" name="immatriculation" placeholder="ex : ab-123-cd" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Propriétaire (conducteur)</label>
      <select class="form-select" name="proprietaire_id" required>
        <?php foreach ($proprietaires as $p): ?>
          <option value="<?= $p['id'] ?>">
            <?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Ajouter le véhicule</button>
    <a href="router1.php?action=vehiculeReadAll" class="btn btn-secondary ms-2">Annuler</a>
  </form>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
