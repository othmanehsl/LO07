<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Mes trajets</h2>
  <a href="router1.php?action=trajetCreate" class="btn btn-success mb-3">Créer un trajet</a>

  <?php if (empty($results)): ?>
    <div class="alert alert-info">Vous n'avez aucun trajet enregistré.</div>
  <?php else: ?>
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Départ</th><th>Arrivée</th><th>Prix (€)</th>
          <th>Date</th><th>Heure</th><th>Statut</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $element): ?>
          <tr>
            <td><?= htmlspecialchars($element['ville_depart']) ?></td>
            <td><?= htmlspecialchars($element['ville_arrivee']) ?></td>
            <td><?= number_format($element['prix'], 2) ?></td>
            <td><?= $element['date_depart'] ?></td>
            <td><?= $element['heure_depart'] ?></td>
            <td>
              <?php if ($element['statut'] === 'actif'): ?>
                <span class="badge bg-success">actif</span>
              <?php else: ?>
                <span class="badge bg-secondary">passif</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
