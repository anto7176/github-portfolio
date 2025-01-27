<?php

namespace Controllers\Router\Route;

class RouteDelUnit {
    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    // Méthode pour supprimer une unité
    public function action($post, $method) {
        if ($method === 'GET' && isset($_GET['idUnit'])) {
            $idUnit = (int) $_GET['idUnit']; // Convertir en entier pour plus de sécurité
            $this->controller->deleteUnitAndIndex($idUnit);  // Appeler la méthode du contrôleur pour supprimer l'unité
        } else {
            echo "ID de l'unité non spécifié.";
        }
    }
}

