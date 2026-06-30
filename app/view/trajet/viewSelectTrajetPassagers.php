<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Voir les passagers d'un trajet</h2>

  <?php if (empty($trajetsActifs)): ?>
    <div class="alert alert-info">Vous n'avez aucun trajet actif.</div>
  <?php else: ?>
    <form method="get" action="router1.php" class="col-md-5">
      <input type="hidden" name="action" value="trajetPassagers">

      <div class="mb-3">
        <label class="form-label">Choisir un trajet actif</label>
        <select class="form-select" name="trajet_id" required>
          <?php foreach ($trajetsActifs as $t): ?>
            <option value="<?= $t['id'] ?>">
              <?= htmlspecialchars($t['ville_depart'] . ' → ' . $t['ville_arrivee']) ?>
              (<?= $t['date_depart'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Voir les passagers</button>
    </form>
  <?php endif; ?>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
