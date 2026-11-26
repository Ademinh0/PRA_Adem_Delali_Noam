
<?php

//render(), estConnecte(), exigerRole()

// charger la vue demandée puis l'insère dans layout.php
function render(string $vue, array $donnees = [])
{
    extract($donnees);

    ob_start();
    require __DIR__ . '/../views/' . $vue . '.php';
    $contenu = ob_get_clean();

    require __DIR__ . '/../views/layout.php';
}

function estConnecte(): bool
{
    return isset($_SESSION['user_id']);
}

// obliger le client ( employee) a se connecter au début  redirection page login
function exigerConnexion(): void
{
    if (!estConnecte()) {
        header('Location: index.php?page=login');
        exit;
    }
}

// oblige à être employé ou admin, un usager ne peut pas accéder au tableau de bord
function exigerEmploye(): void
{
    exigerConnexion();

    // On vérifie que le rôle est bien employee ou admin.
    if ($_SESSION['role'] !== 'employee' || $_SESSION['role'] !== 'admin') {
        header('Location: /login');
        exit;
    }
}

function page404(): void
{
    http_response_code(404);
    echo 'Page introuvable';
}
