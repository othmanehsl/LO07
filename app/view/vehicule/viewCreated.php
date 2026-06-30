<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>
<?php require $root . 'app/view/fragment/fragmentMenu.php'; ?>

<div class="container">
  <?php if ($results > 0): ?>
    <div class="alert alert-success">Le véhicule a été ajouté (id = <?= $results ?>).</div>
  <?php else: ?>
    <div class="alert alert-danger">Erreur lors de l'ajout du véhicule.</div>
  <?php endif; ?>

  <a href="router1.php?action=vehiculeReadAll" class="btn btn-primary">Retour à la liste</a>
</div>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
