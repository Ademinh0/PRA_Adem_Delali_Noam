<?php
namespace App\Controllers;
// login(), logout(), index() (liste des comptes), delete()

use App\Models\UserModel;

class UserController
{
    public function login(): void
    {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $motDePasse = $_POST['password'] ?? '';

            $userModel = new UserModel();
            $user = $userModel->findByLogin($login);

              // seul les employée et admins ont accès au formulaire et 
              // on stocks dans la ession  qui est connecté
            if ($user && password_verify($motDePasse, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['login']   = $user['login'];
                $_SESSION['role']    = $user['role'];

                if ($user['role'] === 'user') {
                    header('Location: /');
                } else {
                    header('Location: /admin/reservations');
                }
                exit;
            }

            $erreur = 'Login ou mot de passe incorrect';
        }

        render(
            'users/login',
            [
                'erreur' => $erreur,
                'title' => 'Connexion'
            ]
        );
    }

    public function tableauDeBord(): void
    {
        
        exigerEmploye();

        // montrer qui est connécté a la session 
        echo 'Connecté : ' . ($_SESSION['login'])  . ' (' . $_SESSION['role'] . ') '   
        . '<a href="/logout">Déconnexion</a>'; 
          
        
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}