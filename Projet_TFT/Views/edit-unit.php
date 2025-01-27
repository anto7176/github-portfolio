<?php if ($unit && $unit instanceof \Models\Unit): ?>
    <h1>Modifier l'unité : <?= htmlspecialchars($unit->getName()) ?></h1>
    <form style="padding: 20px; border: 1px solid #ccc; border-radius: 8px;text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
    <form action="index.php?action=edit-unit" method="POST">
        <!-- Champ caché pour l'ID de l'unité -->
        <input type="hidden" name="idUnit" value="<?= htmlspecialchars($unit->getId()) ?>">

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($unit->getName()) ?>" required><br><br>

        <label for="cost">Coût :</label>
        <input type="number" id="cost" name="cost" value="<?= htmlspecialchars($unit->getCost()) ?>" required><br><br>

        <label for="origin">Origine :</label>
        <input type="text" id="origin" name="origin" value="<?= htmlspecialchars($unit->getOrigin()) ?>" required><br><br>

        <label for="urlImg">Image :</label>
        <input type="text" id="urlImg" name="urlImg" value="<?= htmlspecialchars($unit->getUrlImg()) ?>" required><br><br>

        <button type="submit">Mettre à jour</button>
    </form>
<?php else: ?>
    <p>L'unité demandée n'existe pas.</p>
<?php endif; ?>
