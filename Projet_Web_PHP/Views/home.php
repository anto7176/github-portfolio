<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<h1>Bienvenue sur le projet TFT !</h1>
<p><a href="?action=unit&subAction=units">Voir les unités</a></p>
<p><a href="?action=unit&subAction=addUnit">Ajouter une unité</a></p>
</body>
</html>

<?php
// Afficher toutes les unités
echo "<h1>Liste des unités</h1>";
echo "<div style='display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;'>"; // Centrer les cases
foreach ($units as $unit) {
    echo "<div style='width: 30%; height: 300px; background-image: url(" . htmlspecialchars($unit->getUrlImg()) . "); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: flex-end; padding: 10px; box-sizing: border-box; position: relative;'>";

    // Fond sous le texte avec une légère opacité
    echo "<div style='background-color: rgba(0, 0, 0, 0.5); color: #e3b012; font-weight: bold; padding: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; white-space: nowrap; font-family: Arial, sans-serif; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);'>";

    // Texte de l'unité / boutons Supp/Edit

    echo "<div style='display: flex; justify-content: space-between; align-items: flex-start;'>
        <div style='text-align: left;'>
            <h2 style='margin: 7px 0; font-size: 25px; line-height: 1.2; color: #e3b012; font-weight: bold;'>" . htmlspecialchars($unit->getName()) . "</h2>
            <p style='margin: 4px 0; font-size: 16px; color: #fff;'>Cost: " . htmlspecialchars($unit->getCost()) . " $</p>
            <p style='margin: 4px 0; font-size: 16px; color: #fff;'>Origin: " . htmlspecialchars($unit->getOrigin()) . "</p>
        </div>
        <div style='text-align: right; display: flex; flex-direction: column; align-items: flex-end; margin-left: 40px;'>
            <button style='background-color: #e3b012; color: black; font-size: 16px; font-weight: bold; padding: 10px 20px; border: none; cursor: pointer; margin-bottom: 10px;margin-left: 40px; width: 120px; height: 40px; display: flex; justify-content: center; align-items: center;'>
                Modifier
            </button>
            <button style='background-color: #e3b012; color: black; font-size: 16px; font-weight: bold; padding: 10px 20px; border: none; cursor: pointer; width: 120px; height: 40px; display: flex; justify-content: center; align-items: center;'>
                Supprimer
            </button>
        </div>
      </div>";




    echo "</div>";  // Fin du fond
    echo "</div>";  // Fin de la div avec l'image
}
echo "</div>";  // Fin du conteneur flex
?>