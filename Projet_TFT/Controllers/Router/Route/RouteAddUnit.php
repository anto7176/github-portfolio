<?php


namespace Controllers\Router\Route;

class RouteAddUnit extends Route {
    public function __construct($controller) {
        parent::__construct($controller);
    }

    public function get($params = []) {
        $this->controller->displayAddUnit();  // Affichage du formulaire d'ajout d'unité
    }

    public function post($params = []) {
        // Vérifier si les paramètres sont bien reçus
        if (isset($params['name'], $params['cost'], $params['origin'], $params['url_img'])) {
            // Appeler la méthode d'ajout de l'unité
            $this->controller->addUnit(
                $params['name'],
                $params['cost'],
                $params['origin'],
                $params['url_img']
            );
        } else {
            echo "Certains champs sont manquants.";
        }
    }
}
