<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <div class="alert alert-warning">
    Vous êtes déconnecté.
  </div>

  <a href="router1.php?action=loginForm" class="btn btn-primary">Se reconnecter</a>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
