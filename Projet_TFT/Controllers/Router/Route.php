<?php
namespace Controllers\Router\Route;

abstract class Route {
    protected $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    // Cette méthode appelle la méthode appropriée en fonction de la méthode HTTP
    public function action($params = [], $method = 'GET') {
        if ($method === 'POST') {
            return $this->post($params);
        } else {
            return $this->get($params);
        }
    }

    // Méthode abstraite pour gérer la logique des requêtes GET
    abstract public function get($params = []);

    // Méthode abstraite pour gérer la logique des requêtes POST
    abstract public function post($params = []);
}
