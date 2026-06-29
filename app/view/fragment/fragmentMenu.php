<?php
// Ce fragment est la seule vue autorisée à appeler un modèle directement,
// car le menu connecté doit être affiché sur toutes les pages.
require_once dirname(dirname(__DIR__)) . '/model/ModelUtilisateur.php';

$loginId      = $_SESSION['login_id'] ?? null;
$userConnecte = null;

if ($loginId !== null) {
    $results = ModelUtilisateur::getOne($loginId);
    if (!empty($results)) {
        $userConnecte = $results[0];
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container-fluid">

    <span class="navbar-brand fw-bold">Othmane</span>

    <?php if ($userConnecte): ?>
      <span class="navbar-text text-white me-3">
        <?= htmlspecialchars($userConnecte->getPrenom() . ' ' . $userConnecte->getNom()) ?>
        &nbsp;|&nbsp;
        <strong><?= number_format($userConnecte->getSolde(), 2) ?> €</strong>
      </span>
    <?php endif; ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav me-auto">

        <?php if ($userConnecte && $userConnecte->getRole() === 'administrateur'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Administrateur</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=utilisateurReadAll">A1 - Liste des utilisateurs</a></li>
              <li><a class="dropdown-item" href="router1.php?action=utilisateurCreateConducteur">A2 - Ajout conducteur</a></li>
              <li><a class="dropdown-item" href="router1.php?action=utilisateurCreatePassager">A3 - Ajout passager</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="router1.php?action=vehiculeReadAll">A4 - Liste des véhicules</a></li>
              <li><a class="dropdown-item" href="router1.php?action=vehiculeCreate">A5 - Ajout véhicule</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="router1.php?action=villeReadAll">A6 - Liste des villes</a></li>
              <li><a class="dropdown-item" href="router1.php?action=villeCreate">A7 - Ajout ville</a></li>
            </ul>
          </li>

        <?php elseif ($userConnecte && $userConnecte->getRole() === 'conducteur'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Conducteur</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=vehiculeReadMine">C1 - Mes véhicules</a></li>
              <li><a class="dropdown-item" href="router1.php?action=trajetReadMine">C2 - Mes trajets</a></li>
              <li><a class="dropdown-item" href="router1.php?action=trajetCreate">C3 - Ajout trajet</a></li>
              <li><a class="dropdown-item" href="router1.php?action=trajetPassagers">C4 - Passagers d'un trajet</a></li>
              <li><a class="dropdown-item" href="router1.php?action=trajetCloturer">C5 - Clôturer un trajet</a></li>
            </ul>
          </li>

        <?php elseif ($userConnecte && $userConnecte->getRole() === 'passager'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Passager</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=reservationReadMine">P1 - Mes réservations</a></li>
              <li><a class="dropdown-item" href="router1.php?action=reservationCreate">P2 - Réserver un trajet</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Toujours visible : Innovations -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=innovationData">Innovation Data</a></li>
            <li><a class="dropdown-item" href="router1.php?action=innovationMvc">Innovation MVC</a></li>
          </ul>
        </li>

        <!-- Toujours visible : Examinateur -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Examinateur</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=examinateurSuperglobales">E1 - Superglobales</a></li>
            <li><a class="dropdown-item" href="router1.php?action=examinateurReservationsAleatoires">E2 - Réservations aléatoires</a></li>
          </ul>
        </li>

        <!-- Toujours visible : Se connecter / Se déconnecter -->
        <li class="nav-item">
          <a class="nav-link" href="router1.php?action=loginForm">Se connecter</a>
        </li>
        <?php if ($userConnecte): ?>
          <li class="nav-item">
            <a class="nav-link" href="router1.php?action=logout">Se déconnecter</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
