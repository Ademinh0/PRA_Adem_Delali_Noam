<?php
namespace App\Models;

class ReservationModel
{
    // Récupère les réservations en attente de traitement.
    public function findPending(): array
    {
        $pdo = Database::getInstance();

        $sql = "SELECT *
                FROM reservations r
                JOIN users u ON r.user_id = u.user_id
                JOIN bikes b ON r.bike_id = b.bike_id
                WHERE r.status = 'pending'/* ne prend que les reservation en attente */
                ORDER BY r.start_date ASC"; /* de la plus proche a la plus lointaine */

        return $pdo->query($sql)->fetchAll();
    }

    // Récupère toutes les réservations pour l'administrateur.
    public function findAll(): array
    {
        $pdo = Database::getInstance();

        $sql = "SELECT *
                FROM reservations r
                JOIN users u ON r.user_id = u.user_id
                JOIN bikes b ON r.bike_id = b.bike_id
                ORDER BY r.start_date ASC";

        return $pdo->query($sql)->fetchAll();
    }

    // Modifie le statut d'une réservation.
    public function updateStatus(int $resNum, string $status): bool
    {
        // On vérifie que le statut demandé est autorisé.
        if ($status !== 'accepted' && $status !== 'rejected') {
            return false;
        }

        $pdo = Database::getInstance();

        $sql = "UPDATE reservations
                SET status = :status
                WHERE res_num = :res_num AND status = 'pending'";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'status' => $status,
            'res_num' => $resNum
        ]);

        return $stmt->rowCount() > 0;
    }

    // Supprime une réservation grâce à son numéro.
    public function delete(int $resNum): bool
    {
        $pdo = Database::getInstance();

        $sql = 'DELETE FROM reservations WHERE res_num = :res_num';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['res_num' => $resNum]);

        return $stmt->rowCount() > 0;
    }
}