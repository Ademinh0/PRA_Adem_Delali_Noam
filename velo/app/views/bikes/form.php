<h1>Enregistrer un vélo</h1>

<?php if ($erreur !== ''): ?>
    <p><?= ($erreur) ?></p>
<?php endif; ?>

<?php if ($succes !== ''): ?>
    <p><?= ($succes) ?></p>
<?php endif; ?>

<form method="post" action="index.php?page=admin/velos/ajouter">

    <label for="registration_number">Numéro d'immatriculation</label>
    <input type="text" id="registration_number" name="registration_number" required>

    <label for="availability">Disponible</label>
    <input type="checkbox" id="availability" name="availability" checked>

    <label for="photo">Nom du fichier photo (ex : velo1.jpg)</label>
    <input type="text" id="photo" name="photo" required>

    <button type="submit">Enregistrer</button>

</form>
<p>
<a href="index.php?page=admin/reservations">Retour aux réservations</a>
</p>
<p>
<a href="index.php?page=logout">Déconnexion</a>
</p>
