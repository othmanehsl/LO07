<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <?php if ($results > 0): ?>
    <div class="alert alert-success">Votre réservation a été enregistrée (id = <?= $results ?>).</div>
  <?php else: ?>
    <div class="alert alert-danger">Erreur lors de la réservation.</div>
  <?php endif; ?>

  <a href="router1.php?action=reservationReadMine" class="btn btn-primary">Retour à mes réservations</a>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
