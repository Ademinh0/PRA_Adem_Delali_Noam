<?php
namespace App\Controllers;

use App\Models\ReservationModel;

class ReservationController
{
    public function index(): void
    {
        exigerEmploye();

        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->findPending();

        render(
            'reservations/liste',
            [
                'reservations' => $reservations,
                'title'        => 'Réservations en attente'
            ]
        );
    }
}