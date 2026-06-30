<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <?php if ($results === true): ?>
    <div class="alert alert-success">
      Le trajet a été clôturé. Les paiements ont été effectués.
    </div>
  <?php else: ?>
    <div class="alert alert-danger">
      Erreur lors de la clôture du trajet (trajet introuvable, déjà passif, ou problème en base).
    </div>
  <?php endif; ?>

  <a href="router1.php?action=trajetReadMine" class="btn btn-primary">Retour à mes trajets</a>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
