<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Unité</title>
</head>
<h1>Ajouter une nouvelle unité</h1>
<form style="padding: 20px; border: 1px solid #ccc; border-radius: 8px;text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
      action="index.php?action=add-unit" method="POST">

    <label for="name">Nom de l'unité :</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="cost">Coût :</label><br>
    <input type="number" id="cost" name="cost" required><br><br>

    <label for="origin">Origine :</label><br>
    <input type="text" id="origin" name="origin" required><br><br>

    <label for="url_img">URL de l'image :</label><br>
    <input type="text" id="url_img" name="url_img" required><br><br>

    <button type="submit">Ajouter l'unité</button>
</form>

</html>
