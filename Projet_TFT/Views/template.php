<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Description de la page ici">
    <title>PROJET - TFT</title>
    <link rel="stylesheet" href="public/css/main.css"/>
</head>
<body>

<main id="contenu">
    <!-- Titre principal de la page -->
    <h1>PROJET - TFT</h1>

    <!-- Affichage du sous-titre spécifique à chaque page -->
    <?php if (isset($subtitle)): ?>
        <h2><?= htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8') ?></h2>
    <?php endif; ?>

    <?= isset($content) ? $content : '' ?>
</main>

</body>
</html>
