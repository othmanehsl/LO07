<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Clôturer un trajet</h2>
  <p class="text-muted">La clôture est irréversible : le statut passe à "passif" et les paiements sont effectués.</p>

  <?php if (empty($trajetsActifs)): ?>
    <div class="alert alert-info">Vous n'avez aucun trajet actif à clôturer.</div>
  <?php else: ?>
    <form method="get" action="router1.php" class="col-md-5">
      <input type="hidden" name="action" value="trajetCloturer">

      <div class="mb-3">
        <label class="form-label">Choisir le trajet à clôturer</label>
        <select class="form-select" name="trajet_id" required>
          <?php foreach ($trajetsActifs as $t): ?>
            <option value="<?= $t['id'] ?>">
              <?= htmlspecialchars($t['ville_depart'] . ' → ' . $t['ville_arrivee']) ?>
              (<?= $t['date_depart'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-danger">Clôturer ce trajet</button>
      <a href="router1.php?action=trajetReadMine" class="btn btn-secondary ms-2">Annuler</a>
    </form>
  <?php endif; ?>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
