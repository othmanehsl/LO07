<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Ajouter un passager</h2>

  <form method="get" action="router1.php" class="col-md-5">
    <input type="hidden" name="action" value="utilisateurCreated">
    <input type="hidden" name="role"   value="passager">

    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input type="text" class="form-control" name="nom" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Prénom</label>
      <input type="text" class="form-control" name="prenom" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Login</label>
      <input type="text" class="form-control" name="login" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Mot de passe</label>
      <input type="password" class="form-control" name="password" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Solde initial (€)</label>
      <input type="number" step="0.01" class="form-control" name="solde" value="100.00" required>
    </div>

    <button type="submit" class="btn btn-info">Ajouter le passager</button>
    <a href="router1.php?action=utilisateurReadAll" class="btn btn-secondary ms-2">Annuler</a>
  </form>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
