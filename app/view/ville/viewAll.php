<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Liste des villes</h2>
  <a href="router1.php?action=villeCreate" class="btn btn-success mb-3">Ajouter une ville</a>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr><th>Id</th><th>Nom</th></tr>
    </thead>
    <tbody>
      <?php foreach ($results as $ville): ?>
        <tr>
          <td><?= $ville->getId() ?></td>
          <td><?= htmlspecialchars($ville->getNom()) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
