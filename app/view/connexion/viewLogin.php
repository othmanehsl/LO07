<?php require $root . 'app/view/fragment/fragmentHeader.php'; ?>

<h2 class="mb-4">Connexion</h2>

<?php if ($erreur): ?>
    <div class="alert alert-danger"><?= $erreur ?></div>
<?php endif; ?>

<form method="get" action="router1.php" class="col-md-4">
    <input type="hidden" name="action" value="login">

    <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" class="form-control" id="login" name="login" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php require $root . 'app/view/fragment/fragmentFooter.php'; ?>
