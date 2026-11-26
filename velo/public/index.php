// point d'entrée avec match()
'/'/login'  => $userController->login(),
'/logout' => $userController->logout(),

<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UserController;
use App\Controllers\BikeController;
use App\Controllers\ReservationController;

session_start();

$userController = new UserController();
$bikeController = new BikeController();
$reservationController = new ReservationController();

$url = $_SERVER['REQUEST_URI'];// adresse demandé par le navigateur 

match ($url) {
    '/login'               => $userController->login(),
    '/logout'              => $userController->logout(),
    '/admin/reservations'  => $reservationController->index(),
    '/admin/velos/ajouter' => $bikeController->create(),
    default                => page404(),
};