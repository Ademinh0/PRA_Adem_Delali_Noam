<?php
namespace App\Models;

// accès BDD / findByLogin()

class UserModel
{
    public function findByLogin(string $login)
    {
        $pdo = Database::getInstance();

        $sql = 'SELECT * FROM users WHERE login = :login';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['login' => $login]);

        return $stmt->fetch(); // on renvoie la ligne sous forme de tableau ou false si login n'existe pas
    }

    // Récupère tous les infos du comptes sans afficher le mots de passe.
    public function findAll(): array
    {
        $pdo = Database::getInstance();

        $sql = 'SELECT user_id, firstname, lastname, login, role
                FROM users
                ORDER BY lastname, firstname';

        return $pdo->query($sql)->fetchAll();
    }

    // Supprime un compte utilisateur.
    public function delete(int $userId): bool
    {
        $pdo = Database::getInstance();

        $pdo->beginTransaction();

        try {

            // On supprime d'abord les réservations associées au compte car on ne peut pas supprimer un compte qui a une réservation logiquement
            // C'est nécessaire à cause de la clé étrangère dans la table reservations.
            $sql = 'DELETE FROM reservations WHERE user_id = :user_id';

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);

            // On supprime ensuite le compte utilisateur.
            $sql = 'DELETE FROM users WHERE user_id = :user_id';

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);

            $supprime = $stmt->rowCount() > 0;

            $pdo->commit();

            return $supprime;

        } catch (\Throwable $e) {

            // En cas d'erreur, on annule les suppressions.
            $pdo->rollBack();

            throw $e;
        }
    }
}
