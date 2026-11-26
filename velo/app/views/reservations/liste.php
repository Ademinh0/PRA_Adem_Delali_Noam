
<h1>Gestion des réservations</h1>

<p>
    <a href="index.php?page=admin/comptes">Gestion des comptes</a> |
    <a href="index.php?page=logout">Déconnexion</a>
</p>

<?php if (!empty($message)): ?>
    <p><?= ($message) ?></p>
<?php endif; ?>

<?php if (empty($reservations)): ?>

    <p>Aucune réservation à afficher.</p>

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
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($reservations as $r): ?>

                <tr>

                    <td><?= $r['res_num'] ?></td>

                    <td><?= htmlspecialchars($r['firstname'] . ' ' . $r['lastname']) ?></td>

                    <td><?= htmlspecialchars($r['registration_number']) ?></td>

                    <?php // strtotime() convertit la date texte en nombre, attendu par date(). ?>

                    <td><?= date('d/m/Y H:i', strtotime($r['start_date'])) ?></td>

                    <td><?= date('d/m/Y H:i', strtotime($r['end_date'])) ?></td>

                    <td><?= date('d/m/Y H:i', strtotime($r['res_date'])) ?></td>

                    <td><?= $r['status'] ?></td>

                    <td>

                        <?php if ($r['status'] === 'pending'): ?>

                            <!-- Formulaire pour valider la réservation. -->
                            <form method="post" action="index.php?page=admin/reservations/traiter">

                                <input type="hidden" name="res_num" value="<?= $r['res_num'] ?>">
                                <input type="hidden" name="status" value="accepted">

                                <button type="submit">Valider</button>

                            </form>

                            <!-- Formulaire pour refuser la réservation. -->
                            <form method="post" action="index.php?page=admin/reservations/traiter">

                                <input type="hidden" name="res_num" value="<?= $r['res_num'] ?>">
                                <input type="hidden" name="status" value="rejected">

                                <button type="submit">Refuser</button>

                            </form>

                        <?php endif; ?>

                        <?php if ($_SESSION['role'] === 'admin'): ?>

                            <!-- Seul l'administrateur peut supprimer une réservation. -->
                            <form
                                method="post"
                                action="index.php?page=admin/reservations/supprimer"
                                onsubmit="return confirm('Supprimer cette réservation ?');"
                            >

                                <input type="hidden" name="res_num" value="<?= $r['res_num'] ?>">

                                <button type="submit">Supprimer</button>

                            </form>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>
