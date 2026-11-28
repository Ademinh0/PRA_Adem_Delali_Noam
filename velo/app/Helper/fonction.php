<?php

//render(), estConnecte(), exigerConnexion(), exigerEmploye(), page404()

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

// obliger le client ou bien admin/employée a se connecter au début de sa visite. 
function exigerConnexion(): void
{
    if (!estConnecte()) {
        header('Location: index.php?page=login');
        exit;
    }
}

// oblige à être employé ou admin, cette fonction va etre utilisé partout pour vérifier que ce n'est pas un usager ou un client qui est accès au tableau de bord 
function exigerEmploye(): void
{
    exigerConnexion();

    if ($_SESSION['role'] !== 'employee' && $_SESSION['role'] !== 'admin') {
        header('Location: index.php?page=login');
        exit;
    }
}

function page404(): void
{
    http_response_code(404);
    echo 'Page introuvable';
}
