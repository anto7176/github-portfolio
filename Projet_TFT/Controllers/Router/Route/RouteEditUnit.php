<?php
namespace Controllers\Router\Route;

class RouteEditUnit {
    private $controller;
    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function action($post, $method) {
        // Vérifie si la méthode est GET et si le paramètre 'idUnit' est présent dans l'URL
        if ($method === 'GET' && isset($_GET['idUnit'])) {
            // Récupère et convertit l'ID de l'unité depuis l'URL en entier
            $idUnit = (int) $_GET['idUnit'];

            // Appelle la méthode du contrôleur pour afficher l'édition de l'unité avec l'ID spécifié
            $this->controller->displayEditUnit($idUnit);
        } else {
            // Message d'erreur si l'ID est manquant ou invalide
            echo "ID de l'unité non spécifié ou invalide.";
        }
    }
}
