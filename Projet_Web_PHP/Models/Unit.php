<?php

namespace Models;

class Unit {
    // Déclaration des propriétés de la classe
    private int $id;
    private string $name;
    private int $cost;
    private string $origin;
    private string $urlImg;

    // Constructeur de la classe Unit.
    // Initialise un objet Unit avec les données fournies dans un tableau.
    // Si une donnée n'est pas présente, une valeur par défaut est assignée.
    public function __construct(array $data) {
        // Initialisation des propriétés avec les valeurs provenant du tableau $data.
        // Si une valeur est absente, une valeur par défaut est assignée.

        $this->id = isset($data['id']) ? (int) $data['id'] : 0;          // ID (entier) ou valeur par défaut 0
        $this->name = isset($data['name']) ? (string) $data['name'] : '';  // Nom (chaîne) ou valeur par défaut ''
        $this->cost = isset($data['cost']) ? (int) $data['cost'] : 0;      // Coût (entier) ou valeur par défaut 0
        $this->origin = isset($data['origin']) ? (string) $data['origin'] : '';  // Origine (chaîne) ou valeur par défaut ''
        $this->urlImg = isset($data['url_img']) ? (string) $data['url_img'] : ''; // URL de l'image (chaîne) ou valeur par défaut ''
    }

    // Récupère l'ID de l'unité.
    // @return int L'ID de l'unité.
    public function getId(): int {
        return $this->id;
    }

    // Récupère le nom de l'unité.
    // @return string Le nom de l'unité.
    public function getName(): string {
        return $this->name;
    }

    // Récupère le coût de l'unité.
    // @return int Le coût de l'unité.
    public function getCost(): int {
        return $this->cost;
    }

    // Récupère l'origine de l'unité.
    // @return string L'origine de l'unité.
    public function getOrigin(): string {
        return $this->origin;
    }

    // Récupère l'URL de l'image de l'unité.
    // @return string L'URL de l'image.
    public function getUrlImg(): string {
        return $this->urlImg;
    }

    // Méthode magique __toString qui permet d'afficher une représentation sous forme de chaîne de l'objet.
    // Cela permet de faciliter le débogage et l'affichage des informations de l'unité.
    public function __toString(): string {
        // Retourne une chaîne contenant les principales informations de l'unité
        return "Unité [ID: " . $this->id . ", Nom: " . $this->name . ", Coût: " . $this->cost . ", Origine: " . $this->origin . ", URL Image: " . $this->urlImg . "]";
    }
}

?>
