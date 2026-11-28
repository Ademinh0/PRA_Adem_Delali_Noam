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
            $immatriculation = trim($_POST['registration_number'] ?? '');// si la registration number existe on prend sa valeur sinon chaine vide de plus con retire les espaces en début et fin de chaines pour éviter les beugs ( trim)
            $disponible = isset($_POST['availability']) ? 1 : 0; // true ou false ( 1 ou 0) isset va vérifier si la disponibilité a bien été coché 
            $photo = trim($_POST['photo'] ?? ''); // pareil que pour le $immatriculation 
            
  

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

    // Affiche les vélos disponibles sur la page publique.
    public function index(): void
    {
    $bikeModel = new BikeModel();

    $velos = $bikeModel->findAvailable();

    render(
        'bikes/index',
        [
            'velos' => $velos,
            'title' => 'Nos vélos disponibles'
        ]
    );
}

}
