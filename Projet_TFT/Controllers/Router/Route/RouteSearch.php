<?php

namespace Controllers\Router\Route;

class RouteSearch extends Route {

    public function __construct($controller) {
        parent::__construct($controller);
    }

    public function get($params = []) {
        $this->controller->search($params);
    }

    public function post($params = []) {
        // Ajouter une logique pour gérer les soumissions de recherche si nécessaire
    }
}
