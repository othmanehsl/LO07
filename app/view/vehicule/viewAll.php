<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Liste des véhicules</h2>
  <a href="router1.php?action=vehiculeCreate" class="btn btn-success mb-3">Ajouter un véhicule</a>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Année</th>
        <th>Immatriculation</th>
        <th>Propriétaire</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $element): ?>
        <tr>
          <td><?= htmlspecialchars($element['marque']) ?></td>
          <td><?= htmlspecialchars($element['modele']) ?></td>
          <td><?= $element['annee'] ?></td>
          <td><?= htmlspecialchars($element['immatriculation']) ?></td>
          <td><?= htmlspecialchars($element['prenom'] . ' ' . $element['nom']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
