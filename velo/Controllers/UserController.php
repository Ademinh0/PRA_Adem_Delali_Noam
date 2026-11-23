<?php
// login(), logout(), index() (liste des comptes), delete()


namespace App\Controllers;

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

            // seul les employée et admins ont accès au formulaire donc :
            if ($user && $user['role'] !== 'user' && password_verify($motDePasse, $user['password'])) {

                // garde en mémoire qui est connecté pour exigerConnexion() cela évite la répétition 
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['login']   = $user['login'];
                $_SESSION['role']    = $user['role'];

                header('Location: admin/reservations'); // redirection tableau de bord 
                render(
                    'users/login',
                    [
                        'erreur' => $erreur,
                        'title' => 'Connexion'
                    ]
                );
                exit;
            }

            $erreur = 'Login ou mot de passe incorrect';
        }

   
        
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit;
    }

     // TEMPORAIRE : sera remplacée à l'étape 4 par la liste des réservations
    public function tableauDeBord(): void
    {
        // montrer qui est connécté a la session 
        echo 'Connecté : ' . ($_SESSION['login'])  . ' (' . $_SESSION['role'] . ') '   
        . '<a href="/logout">Déconnexion</a>'; 
          
        
    }
}

