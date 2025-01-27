<!-- Dans views/add-type-origin.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une origine</title>
    <link rel="stylesheet" href="public/css/main.css"> <!-- Assurez-vous que le chemin est correct -->
</head>
<body>

<h1>Ajouter une nouvelle origine</h1>
<p>Cette page permet d'ajouter une origine.</p>

<form action="index.php?action=add-origin" method="POST" style ="text-align: center;">
    <label for="origin">Nom de l'origine :</label><br>
    <input type="text" id="origin" name="origin" required><br><br>
    <input type="submit" value="Ajouter l'origine">
</form>

</body>
</html>
