
<h1>Réservations en attente</h1>

<p>
    <a href="index.php?page=admin/velos/ajouter">Ajouter un vélo</a>
    <a href="index.php?page=logout">Déconnexion</a>
</p>

<?php if (empty($reservations)): ?>

    <p>Aucune réservation en attente.</p>

<?php else: ?>

    <table>

        <thead>
            <tr>
                <th>N°</th>
                <th>Usager</th>
                <th>Vélo</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Demandée le</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($reservations as $r): ?>

                <tr>
                    <td><?= $r['res_num'] ?></td>
                    <td><?= $r['firstname'] . ' ' . $r['lastname'] ?></td>
                    <td><?= $r['registration_number'] ?></td>

                    <?php // utilisation du strtotime pour passer le texte en nombre  date() attend un nombre ?>
                    <td><?= date('d/m/Y H:i', strtotime($r['start_date'])) ?></td>

                    <td><?= date('d/m/Y H:i', strtotime($r['end_date'])) ?></td>

                    <td><?= date('d/m/Y H:i', strtotime($r['res_date'])) ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>
