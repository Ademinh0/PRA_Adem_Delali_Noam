<?php
namespace App\Models;

class ReservationModel
{
    public function findPending(): array
    {
        $pdo = Database::getInstance();

        $sql = "SELECT *
                FROM reservations r
                JOIN users u ON r.user_id = u.user_id
                JOIN bikes b ON r.bike_id = b.bike_id
                WHERE r.status = 'pending' /* ne prend que les reservation en attente */ 
                ORDER BY r.start_date ASC"; // de la plus proche a la plus lointaine 

        return $pdo->query($sql)->fetchAll();// je sors toute les infos en une seule ligne
    }
}