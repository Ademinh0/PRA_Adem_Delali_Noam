<?php
namespace App\Models;

use PDOException;

class BikeModel
{
    // renvoie true si le vélo est enregistré, false si l'immatriculation existe déjà
    public function create(string $immatriculation, int $disponible, string $photo): bool
    {
        $pdo = Database::getInstance();

        $sql = 'INSERT INTO bikes (registration_number, availability, photo)
                VALUES (:immatriculation, :disponible, :photo)';
        $stmt = $pdo->prepare($sql);

        try {
            return $stmt->execute([
                'immatriculation' => $immatriculation,
                'disponible'      => $disponible,
                'photo'           => $photo,
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false;
            }
            throw $e;
        }
        
    }

// Récupère tous les vélos disponibles dans la base de données.
public function findAvailable(): array
{
    $pdo = Database::getInstance();

    $sql = "SELECT * FROM bikes WHERE availability = 1"; // le 1 represénte true et le 0 false 

    return $pdo->query($sql)->fetchAll();
}

}