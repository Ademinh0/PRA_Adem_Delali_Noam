
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
    'login'               => $userController->login(),//connexion
    'logout'              => $userController->logout(),//deconnexion
    'admin/reservations'  => $reservationController->index(),//reservation pour les admins 
    'admin/velos/ajouter' => $bikeController->create(),// ajout d'un vélo pour les admins 
    'bikes' => $bikeController->index(), // affiche les vélo dans la page publique 
    default               => page404(),
};