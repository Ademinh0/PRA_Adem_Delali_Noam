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
        header('Location: /login');
        exit;
    }
}

// oblige à être employé ou admin, un usager est renvoyé à l'accueil
function exigerEmploye(): void
{
    exigerConnexion();

    if ($_SESSION['role'] === 'user') {
        header('Location: /');
        exit;
    }
}

function page404(): void
{
    http_response_code(404);
    echo 'Page introuvable';
}