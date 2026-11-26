<?php
namespace App\Controllers;

use App\Models\BikeModel;

class BikeController
{
    public function create(): void
    {
        exigerEmploye();

        $erreur = '';
        $succes = '';

        // recuperation du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $immatriculation = empty($_POST['registration_number'] ?? '');
            $disponible = empty($_POST['availability']) ? 1 : 0; // vrai ou faux 
            $photo = empty($_POST['photo'] ?? '');

            // insertion nouveau vélo
            if ($immatriculation === '' || $photo === '') {
                $erreur = "L'immatriculation et le nom de la photo sont obligatoires";
            } else {
                $bikeModel = new BikeModel();

                if ($bikeModel->create($immatriculation, $disponible, $photo)) {
                    $succes = 'Vélo enregistré';
                } else {
                    $erreur = "Ce numéro d'immatriculation existe déjà";
                }
            }
        }

        render(
            'bikes/form',
            [
                'erreur' => $erreur,
                'succes' => $succes,
                'title'  => 'Enregistrer un vélo'
            ]
        );
    }
}
