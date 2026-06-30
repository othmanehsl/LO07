<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Réserver un trajet</h2>

  <?php if (empty($trajetsActifs)): ?>
    <div class="alert alert-info">Aucun trajet actif disponible pour le moment.</div>
  <?php else: ?>
    <form method="get" action="router1.php" class="col-md-7">
      <input type="hidden" name="action" value="reservationCreated">

      <div class="mb-3">
        <label class="form-label">Choisir un trajet</label>
        <select class="form-select" name="trajet_id" required>
          <?php foreach ($trajetsActifs as $t): ?>
            <option value="<?= $t['id'] ?>">
              <?= htmlspecialchars(
                    $t['ville_depart'] . ' → ' . $t['ville_arrivee'] .
                    ' le ' . $t['date_depart'] .
                    ' à ' . $t['heure_depart'] .
                    ' — ' . number_format($t['prix'], 2) . ' € ' .
                    '(' . $t['conducteur_prenom'] . ' ' . $t['conducteur_nom'] . ')'
                ) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Réserver ce trajet</button>
      <a href="router1.php?action=reservationReadMine" class="btn btn-secondary ms-2">Annuler</a>
    </form>
  <?php endif; ?>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
