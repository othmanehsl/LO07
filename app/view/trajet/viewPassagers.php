<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Passagers du trajet</h2>

  <?php if (empty($results)): ?>
    <div class="alert alert-info">Aucun passager n'a réservé ce trajet.</div>
  <?php else: ?>
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr><th>Prénom</th><th>Nom</th><th>Login</th></tr>
      </thead>
      <tbody>
        <?php foreach ($results as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['prenom']) ?></td>
            <td><?= htmlspecialchars($p['nom']) ?></td>
            <td><?= htmlspecialchars($p['login']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <a href="router1.php?action=trajetReadMine" class="btn btn-secondary">Retour à mes trajets</a>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
