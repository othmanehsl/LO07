<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <?php if ($results > 0): ?>
    <div class="alert alert-success">Le trajet a été créé (id = <?= $results ?>).</div>
  <?php else: ?>
    <div class="alert alert-danger">Erreur lors de la création du trajet.</div>
  <?php endif; ?>

  <a href="router1.php?action=trajetReadMine" class="btn btn-primary">Retour à mes trajets</a>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
