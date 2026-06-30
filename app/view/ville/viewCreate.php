<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <h2 class="mb-3">Ajouter une ville</h2>

  <form method="get" action="router1.php" class="col-md-4">
    <input type="hidden" name="action" value="villeCreated">

    <div class="mb-3">
      <label for="nom" class="form-label">Nom de la ville</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>

    <button type="submit" class="btn btn-success">Ajouter la ville</button>
    <a href="router1.php?action=villeReadAll" class="btn btn-secondary ms-2">Annuler</a>
  </form>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
