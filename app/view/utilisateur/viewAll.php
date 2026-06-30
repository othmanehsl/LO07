<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Liste des utilisateurs</h2>
  <a href="router1.php?action=utilisateurCreateConducteur" class="btn btn-success mb-3 me-2">Ajouter un conducteur</a>
  <a href="router1.php?action=utilisateurCreatePassager"   class="btn btn-info    mb-3">Ajouter un passager</a>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr><th>Id</th><th>Nom</th><th>Prénom</th><th>Rôle</th><th>Login</th><th>Solde (€)</th></tr>
    </thead>
    <tbody>
      <?php foreach ($results as $u): ?>
        <tr>
          <td><?= $u->getId() ?></td>
          <td><?= htmlspecialchars($u->getNom()) ?></td>
          <td><?= htmlspecialchars($u->getPrenom()) ?></td>
          <td><?= htmlspecialchars($u->getRole()) ?></td>
          <td><?= htmlspecialchars($u->getLogin()) ?></td>
          <td><?= number_format($u->getSolde(), 2) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
