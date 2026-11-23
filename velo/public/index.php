// point d'entrée avec match()
'/'/login'  => $userController->login(),
'/logout' => $userController->logout(),
<?php 

require __DIR__ . '/../vendor/autoload.php';
use App\Controllers\UserController;

session_start();

$userController = new UserController();

$url = $_SERVER['REQUEST_URI'];

match ($url) {
    'login'              => $userController->login(),
    'logout'             => $userController->logout(),
    'admin/reservations' => $userController->tableauDeBord(),
    default               => page404(),
};