<?php

namespace Controllers;

use Models\UnitDAO;

class UnitController {
    private $unitDAO;

    // Constructeur pour initialiser l'objet UnitDAO
    public function __construct() {
        $this->unitDAO = new UnitDAO();  // Utilisation de UnitDAO qui étend BasePDODAO
    }

    // Affiche le formulaire d'ajout d'unité
    public function displayAddUnit() {
        include('views/add-unit.php');  // Formulaire d'ajout d'unité
    }

    // Ajoute une unité à la base de données
    public function addUnit($name, $cost, $origin, $urlImg) {
        echo "Nom : $name, Coût : $cost, Origine : $origin, URL : $urlImg <br>"; // Debugger
        $unitDAO = new UnitDAO();
        $unitDAO->addUnit($name, $cost, $origin, $urlImg);
        header("Location: index.php?action=index");
    }

    // Supprime une unité + redirige vers l'index + message
    public function deleteUnitAndIndex($idUnit) {
        $unitDAO = new UnitDAO();
        $rowCount = $unitDAO->deleteUnit($idUnit);

        $message = $rowCount > 0 ? "L'unité a été supprimée avec succès." : "Erreur : L'unité n'a pas pu être supprimée.";
        header('Location: index.php?action=index&message=' . urlencode($message));
        exit;
    }

    // Affichage de l'index avec un message optionnel
    public function displayIndex($message = '') {
        $unitDAO = new UnitDAO();
        $units = $unitDAO->getAll();
        include('index.php');
    }

    // Affiche le formulaire d'édition d'une unité
    public function displayEditUnit(int $idUnit) {
        if ($idUnit <= 0) {
            echo "ID de l'unité non valide.";
            return;
        }

        // Récupérer l'unité avec l'ID valide
        $unit = $this->unitDAO->getUnitById($idUnit);
        if ($unit === null) {
            echo "Aucune unité trouvée pour cet ID.";
            return;
        }

        include 'views/edit-unit.php';  // Passer l'unité à la vue pour pré-remplir le formulaire
    }

    // Met à jour une unité et redirige vers l'index
    public function editUnitAndIndex(array $dataUnit) {
        $unitDAO = new UnitDAO();
        $updated = $unitDAO->updateUnit($dataUnit);

        // Définir un message en fonction du succès ou de l'échec de la mise à jour
        $message = $updated ? "L'unité a été mise à jour avec succès." : "Erreur : L'unité n'a pas pu être mise à jour.";

        // Redirection vers l'index avec le message
        header('Location: index.php?action=index&message=' . urlencode($message));
        exit;
    }
    public function addOrigin($params = []) {
        include('views/add-type-origin.php');  // Affiche la vue pour ajouter une origine
    }
}

