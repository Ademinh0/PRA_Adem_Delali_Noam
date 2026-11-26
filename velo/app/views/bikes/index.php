<h1>Nos vélos disponibles</h1>

<?php if (empty($velos)): ?>

<p>Aucun vélo disponible pour le moment.</p>

<?php else: ?>

<?php foreach ($velos as $velo): ?>

    <div>

    <h2><?= htmlspecialchars($velo['registration_number']) ?></h2>

    <?php if (!empty($velo['photo'])): ?>
    <img
    src="images/<?= ($velo['photo']) ?>"
    alt="Photo du vélo">
        <?php endif; ?>

    <p>Disponibilité : Disponible</p>

        </div>

        <hr>

    <?php endforeach; ?>

<?php endif; ?>
