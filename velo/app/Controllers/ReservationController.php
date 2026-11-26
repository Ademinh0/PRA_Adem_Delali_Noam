<?php
namespace App\Controllers;

use App\Models\ReservationModel;

class ReservationController
{
    public function index(): void
    {
        exigerEmploye();

        $reservationModel = new ReservationModel();

        // L'administrateur voit toutes les réservations.
        // L'employé voit uniquement les réservations en attente.
        if ($_SESSION['role'] === 'admin') {
            $reservations = $reservationModel->findAll();
        } else {
            $reservations = $reservationModel->findPending();
        }

        // Récupération du message après une action.
        $message = $_SESSION['message'] ?? '';
        unset($_SESSION['message']);

        render(
            'reservations/liste',
            [
                'reservations' => $reservations,
                'message' => $message,
                'title' => 'Réservations'
            ]
        );
    }

    // Valider ou refuser une réservation.
    public function traiter(): void
    {
        exigerEmploye();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $resNum = (int) ($_POST['res_num'] ?? 0);
            $status = $_POST['status'] ?? '';

            $reservationModel = new ReservationModel();

            if ($resNum > 0 && $reservationModel->updateStatus($resNum, $status)) {

                if ($status === 'accepted') {
                    $_SESSION['message'] = 'Réservation validée.';
                } else {
                    $_SESSION['message'] = 'Réservation refusée.';
                }

            } else {
                $_SESSION['message'] = 'Impossible de modifier cette réservation.';
            }
        }

        header('Location: index.php?page=admin/reservations');
        exit;
    }

    // Seul l'administrateur peut supprimer une réservation.
    public function supprimer(): void
    {
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php?page=admin/reservations');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $resNum = (int) ($_POST['res_num'] ?? 0);

            $reservationModel = new ReservationModel();

            if ($resNum > 0 && $reservationModel->delete($resNum)) {
                $_SESSION['message'] = 'Réservation supprimée.';
            } else {
                $_SESSION['message'] = 'Impossible de supprimer cette réservation.';
            }
        }

        header('Location: index.php?page=admin/reservations');
        exit;
    }
}
