<?php
namespace App\Controllers;

// login(), logout(), tableauDeBord , session_destroy()

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

            // Seuls les employés et les administrateurs peuvent accéder au tableau de bord.
            // On vérifie le mot de passe avec password_verify().
            if (
                $user
                && ($user['role'] === 'employee' || $user['role'] === 'admin')
                && password_verify($motDePasse, $user['password'])
            ) {
                // On stocke dans la session les informations de la personne connectée.
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['login']   = $user['login'];
                $_SESSION['role']    = $user['role'];

                header('Location: index.php?page=admin/reservations');
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
        echo 'Connecté : ' . $_SESSION['login'] . ' (' . $_SESSION['role'] . ') '
        . '<a href="index.php?page=logout">Déconnexion</a>';
    }

    public function logout(): void
    {
        // On vide les informations de session.
        $_SESSION = [];

        // On détruit la session.
        session_destroy();

        header('Location: index.php?page=login');
        exit;
    }
}
