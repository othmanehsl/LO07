<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Mes véhicules</h2>

  <?php if (empty($results)): ?>
    <div class="alert alert-info">Vous n'avez aucun véhicule enregistré.</div>
  <?php else: ?>
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr><th>Marque</th><th>Modèle</th><th>Année</th><th>Immatriculation</th></tr>
      </thead>
      <tbody>
        <?php foreach ($results as $element): ?>
          <tr>
            <td><?= htmlspecialchars($element->getMarque()) ?></td>
            <td><?= htmlspecialchars($element->getModele()) ?></td>
            <td><?= $element->getAnnee() ?></td>
            <td><?= htmlspecialchars($element->getImmatriculation()) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
