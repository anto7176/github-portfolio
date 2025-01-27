<?php
namespace Controllers\Router\Route;

class RouteIndex extends Route {
public function __construct($controller) {
parent::__construct($controller);  // Appel au constructeur parent pour initialiser le contrôleur
}

// Méthode GET qui appelle la méthode index du contrôleur
public function get($params = []) {
$this->controller->index();
}

// Méthode POST qui appelle également la méthode index du contrôleur, pour le moment
public function post($params = []) {
$this->controller->index();
}
}
