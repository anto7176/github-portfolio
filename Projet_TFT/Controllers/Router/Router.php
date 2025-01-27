<?php
namespace Controllers\Router;

class Router {

    private $routeList = [];
    private $ctrlList = [];
    private $action_key = 'action';

    public function __construct($name_of_action_key = 'action') {
        // Le nom de la clé d'action peut être personnalisé
        $this->action_key = $name_of_action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    // Créer une liste de contrôleurs associés aux différentes actions
    private function createControllerList() {
        $this->ctrlList = [
            'main' => new \Controllers\MainController(),
            'unit' => new \Controllers\UnitController(),
        ];
    }

    // Créer une liste de routes associées à des actions
    private function createRouteList() {
        $this->routeList = [
            'index' => new \Controllers\Router\Route\RouteIndex($this->ctrlList['main']),
            'add-unit' => new \Controllers\Router\Route\RouteAddUnit($this->ctrlList['unit']),
            'search' => new \Controllers\Router\Route\RouteSearch($this->ctrlList['main']),
            'add-origin' => new \Controllers\Router\Route\RouteAddOrigin($this->ctrlList['unit']),
            'del-unit' => new \Controllers\Router\Route\RouteDelUnit($this->ctrlList['unit']),
            'edit-unit' => new \Controllers\Router\Route\RouteEditUnit($this->ctrlList['unit']),

        ];
    }

    // Détermine quelle action et méthode doit être exécutée
    // Dans le routeur, on vérifie que les données sont envoyées via POST pour l'édition
    // Routeur (Router.php)
    public function routing($get, $post) {
        $action = isset($get[$this->action_key]) ? $get[$this->action_key] : 'index';

        // Si la route existe dans la liste
        if (isset($this->routeList[$action])) {
            $route = $this->routeList[$action];
            $method = $_SERVER['REQUEST_METHOD'];

            // Traiter POST ou GET selon l'action
            if ($method === 'POST' && $action === 'edit-unit') {
                $dataUnit = [
                    'idUnit' => $post['idUnit'],
                    'name' => $post['name'],
                    'cost' => $post['cost'],
                    'origin' => $post['origin'],
                    'urlImg' => $post['urlImg']
                ];

                $this->ctrlList['unit']->editUnitAndIndex($dataUnit);  // Appeler la méthode de mise à jour
            } else {
                $route->action($post, $method);
            }
        } else {
            echo "Page non trouvée.";
        }
    }


}

