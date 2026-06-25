<?php
session_start();

// Personne connecté au démarrage (exigence du cahier des charges)
$_SESSION['login_id'] = null;

header('Location: app/router/router1.php?action=loginForm');
exit();
