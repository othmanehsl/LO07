<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Mes réservations</h2>
  <a href="router1.php?action=reservationCreate" class="btn btn-success mb-3">Réserver un trajet</a>

  <?php if (empty($results)): ?>
    <div class="alert alert-info">Vous n'avez aucune réservation.</div>
  <?php else: ?>
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Départ</th><th>Arrivée</th><th>Date</th><th>Heure</th>
          <th>Prix (€)</th><th>Conducteur</th><th>Statut</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $r): ?>
          <tr>
            <td><?= htmlspecialchars($r['ville_depart']) ?></td>
            <td><?= htmlspecialchars($r['ville_arrivee']) ?></td>
            <td><?= $r['date_depart'] ?></td>
            <td><?= $r['heure_depart'] ?></td>
            <td><?= number_format($r['prix'], 2) ?></td>
            <td><?= htmlspecialchars($r['conducteur_prenom'] . ' ' . $r['conducteur_nom']) ?></td>
            <td>
              <?php if ($r['statut'] === 'actif'): ?>
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
