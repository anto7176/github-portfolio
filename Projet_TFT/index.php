<?php

// Inclusions des fichiers nécessaires
require_once 'models/BasePDODAO.php';
require_once 'models/Unit.php';
require_once 'models/UnitDAO.php';
require_once 'Helpers/Psr4AutoloaderClass.php';
require_once 'Controllers/Router/Router.php';
require_once 'Controllers/Router/Route.php';
require_once 'Controllers/MainController.php';
require_once 'Controllers/UnitController.php';
require_once 'Controllers/Router/Route/RouteIndex.php';
require_once 'Controllers/Router/Route/RouteAddUnit.php';
require_once 'Controllers/Router/Route/RouteAddOrigin.php';
require_once 'Controllers/Router/Route/RouteSearch.php';
require_once 'Controllers/Router/Route/RouteEditUnit.php';
require_once 'Controllers/Router/Route/RouteUpdateUnit.php';
include 'views/template.php';

use Controllers\Router;

// Création d'un objet UnitDAO pour accéder à la BDD
$unitDAO = new Models\UnitDAO();
// Récupérer toutes les unités
$units = $unitDAO->getAll();


// Créer une instance de l'autoloader
$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();

// Ajouter le namespace Controllers
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');


// Créer l'instance du routeur
$router = new Controllers\Router\Router();
// Appeler le routage avec GET et POST
$router->routing($_GET, $_POST);

//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------

// Afficher le message si présent dans l'URL
if (isset($_GET['message'])) {
    echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
}

// Afficher toutes les unités si on est dans l'accueil
if (isset($_GET['action']) && $_GET['action'] === 'index')  {
    echo "<h1>Liste des unités</h1>";
    echo "<div style='display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;'>"; // Centrer les cases
    foreach ($units as $unit) {
        // Affichage de l'unité avec une image de fond
        echo "<div style='width: 30%; height: 300px; background-image: url(" . htmlspecialchars($unit->getUrlImg()) . "); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: flex-end; padding: 10px; box-sizing: border-box; position: relative;'>";

        // Fond sous le texte avec une légère opacité
        echo "<div style='background-color: rgba(0, 0, 0, 0.5); color: #e3b012; font-weight: bold; padding: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; white-space: nowrap; font-family: Arial, sans-serif; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);'>";

        // Texte de l'unité et boutons Modifier/Supprimer
        echo "<div style='display: flex; justify-content: space-between; align-items: flex-start; width: 100%;'>
            <div style='text-align: left;'>
                <h2 style='margin: 7px 0; font-size: 25px; line-height: 1.2; color: #e3b012; font-weight: bold;'>" . htmlspecialchars($unit->getName()) . "</h2>
                <p style='margin: 4px 0; font-size: 16px; color: #fff;'>Cost: " . htmlspecialchars($unit->getCost()) . " $</p>
                <p style='margin: 4px 0; font-size: 16px; color: #fff;'>Origin: " . htmlspecialchars($unit->getOrigin()) . "</p>
            </div>
            <div style='text-align: center; display: flex; flex-direction: column; align-items: flex-end; margin-left: 40px;'>
                <a href='index.php?action=edit-unit&idUnit=" . $unit->getId() . "' style='background-color: #e3b012; color: black; font-size: 16px; font-weight: bold; padding: 10px 20px; border: none; cursor: pointer; width: 80px; height: 20px; display: flex; justify-content: center; align-items: center; text-decoration: none; text-shadow: none;'>
                    Modifier
                </a>
                <a href='index.php?action=del-unit&idUnit=" . $unit->getId() . "' class='btn btn-danger' style='background-color: #e3b012; margin-top: 20px; color: black; font-size: 16px; font-weight: bold; padding: 10px 20px; border: none; cursor: pointer; width: 80px; height: 20px; display: flex; justify-content: center; align-items: center; text-decoration: none; text-shadow: none;'>
                    Supprimer
                </a>
            </div>
        </div>";

        echo "</div>";  // Fin du fond
        echo "</div>";  // Fin de la div avec l'image
    }
    echo "</div>";  // Fin du conteneur flex
}
?>



<!-- Case à cocher pour afficher/masquer la colonne -->
<input type="checkbox" id="toggle-nav" class="toggle-nav-checkbox" style="opacity:0.7">
<label for="toggle-nav" class="toggle-nav-btn">&#9776;</label>

<!-- Menu de navigation -->
<nav id="sidebar">
    <ul>
        <li><a href="index.php?action=index">Accueil</a></li>
        <li><a href="index.php?action=add-unit">Ajouter une unité</a></li>
        <li><a href="index.php?action=add-origin">Ajouter une origine</a></li>
        <li><a href="index.php?action=search">Rechercher</a></li>
    </ul>
</nav>

<style>
    body {
        background-color: #000;
        color: #e3b012;
        font-family: Arial, sans-serif;
    }