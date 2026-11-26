
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
$page = $_GET['page'] ?? 'login';

// On utilise match() pour appeler le bon contrôleur.
match ($page) {
    'login'               => $userController->login(),
    'logout'              => $userController->logout(),
    'admin/reservations'  => $reservationController->index(),
    'admin/velos/ajouter' => $bikeController->create(),
    default               => page404(),
};