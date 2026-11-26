
<h1>Gestion des comptes utilisateurs</h1>

<p>
    <a href="index.php?page=admin/reservations">Retour aux réservations</a> |
    <a href="index.php?page=logout">Déconnexion</a>
</p>

<?php if (!empty($message)): ?>
    <p><?= ($message) ?></p>
<?php endif; ?>

<?php if (empty($users)): ?>

    <p>Aucun compte utilisateur.</p>

<?php else: ?>

    <table>

        <thead>
            <tr>
                <th>N°</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Login</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($users as $user): ?>

                <tr>

                    <td><?= $user['user_id'] ?></td>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td><?= $user['login'] ?></td>
                    <td><?= $user['role'] ?></td>

                    <td>

                        <?php if ($_SESSION['role'] === 'admin' && (int) $user['user_id'] !== (int) $_SESSION['user_id']): ?>

                            <!-- La suppression du compte supprime aussi ses réservations. -->
                            <form
                                method="post"
                                action="index.php?page=admin/comptes/supprimer"
                                onsubmit="return confirm('Supprimer ce compte et ses réservations associées ?');"
                            >

                                <input
                                    type="hidden"
                                    name="user_id"
                                    value="<?= (int) $user['user_id'] ?>"
                                >

                                <button type="submit">Supprimer</button>

                            </form>

                        <?php elseif ($_SESSION['role'] === 'admin'): ?>

                            <span>Compte connecté</span>

                        <?php else: ?>

                            <span>Suppression réservée à l'administrateur</span>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>
