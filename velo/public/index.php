<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UserController;
use App\Controllers\BikeController;
use App\Controllers\ReservationController;

session_start();

$userController = new UserController();
$bikeController = new BikeController();
$reservationController = new ReservationController();

// On récupère la page demandée.
$page = $_GET['page'] ?? 'bikes';

// On utilise match() pour appeler le bon contrôleur.
match ($page) {
    'bikes'                        => $bikeController->index(),// affiche les vélo dans la page publique 
    'login'                        => $userController->login(),//connexion
    'logout'                       => $userController->logout(),//deconnexion
    'admin/reservations'           => $reservationController->index(),//Afficher les réservations
    'admin/reservations/traiter'   => $reservationController->traiter(),// Valider ou refuser les reservations 
    'admin/reservations/supprimer' => $reservationController->supprimer(),// Supprimer une réservation
    'admin/velos/ajouter'          => $bikeController->create(),// ajout d'un vélo pour les admins 
    'admin/comptes'                => $userController->index(),// Afficher les comptes
    'admin/comptes/supprimer'      => $userController->delete(),// Supprimer un compte
    default                        => page404(),// page erreur 
};


