<?php

namespace Controllers\Router\Route;

class RouteAddOrigin extends Route {

    public function __construct($controller) {
        parent::__construct($controller);
    }

    public function get($params = []) {
        // Appel du contrôleur pour afficher la vue d'ajout d'origine
        $this->controller->addOrigin($params);
    }

    public function post($params = []) {
        // Vous pouvez ajouter ici la gestion de la soumission du formulaire si nécessaire
    }
}
