<h1>Réservations</h1>

<p>
    <a href="index.php?page=admin/velos/ajouter">Ajouter un vélo</a> |
    <a href="index.php?page=admin/comptes">Gestion des comptes</a> |
    <a href="index.php?page=logout">Déconnexion</a>
</p>

<?php // message après une acton validée, refusée, supprimée ?>
<?php if (!empty($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>

<?php // si le tableau est vide on affiche un message  ?>
<?php if (empty($reservations)): ?>
    <p>Aucune réservation.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Usager</th>
                <th>Vélo</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php // on boucle sur chaque réservation ?>
            <?php foreach ($reservations as $r): ?>
                <tr>
                    <td><?= $r['res_num'] ?></td>

                    <?php  ?>
                    <td><?= $r['firstname'] . ' ' . $r['lastname']?></td>
                    <td><?= $r['registration_number'] ?></td>

                    <?php ?>
                    <td><?= date('d/m/Y H:i', strtotime($r['start_date']))//strtotime passe le texte en nombre car date() attend un nombre ?></td>/
                    <td><?= date('d/m/Y H:i', strtotime($r['end_date'])) ?></td>

                    <?php  ?>
                    <td><?= $r['status'] ?></td>

                    <td>
                        <?php // on ne peut valider ou refuser les demandes seulements si elles sont en attentes ?>
                        <?php if ($r['status'] === 'pending'): ?>
                            <form method="post" action="index.php?page=admin/reservations/traiter">

                                <?php  // on cache le numéro de reservation pas besoin de l'afficher on veut juste le transmettre pour le valider le refuser ou le supprrimer ?> 
                                <input type="hidden" name="res_num" value="<?= $r['res_num'] ?>">

                                <?php // 2 boutons pour changer le status soit valider ou refuser  ?>
                                <button type="submit" name="status" value="accepted">Valider</button>
                                <button type="submit" name="status" value="rejected">Refuser</button>
                            </form>
                        <?php endif; ?>

                        <?php // le bouton  supprimer est dispo que pour l'admin ?>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <form method="post" action="index.php?page=admin/reservations/supprimer">
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