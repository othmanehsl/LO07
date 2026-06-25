<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>

<div class="alert alert-success">
    Bienvenue <strong><?= htmlspecialchars($utilisateur->getPrenom() . ' ' . $utilisateur->getNom()) ?></strong> !
    Vous êtes connecté en tant que <em><?= htmlspecialchars($utilisateur->getRole()) ?></em>.
</div>

<a href="router1.php?action=logout" class="btn btn-outline-secondary">Se déconnecter</a>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
