
// le formulaire de connexion

<h1>Connexion </h1>
<?php if ($erreur !== ''): ?>
    <p><?= ($erreur) ?></p>
<?php endif; ?>

<form method="post" action="/login">
    <label for="login">Connexion</label>
    <input type="text" id="login" name="login" required>

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>