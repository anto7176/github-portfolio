<?php
namespace Models;

use PDO;
use PDOException;

class BasePDODAO {
    // Propriété pour l'instance PDO
    protected PDO $pdo;


    //Constructeur pour initialiser la connexion à la base de données

    public function __construct() {
        $this->connect();
    }


    //Connexion à la base de données

    private function connect() {
        try {
            // Définir le DSN pour la connexion à MySQL
            $dsn = 'mysql:host=localhost;dbname=projet;charset=utf8'; // Base de données "projet"
            $username = 'root';  // Utilisateur MySQL
            $password = '';      // Mot de passe MySQL (vide ici pour l'exemple)

            // Créer une instance PDO pour la connexion
            $this->pdo = new PDO($dsn, $username, $password);

            // Définir l'attribut pour la gestion des erreurs (lancer une exception en cas d'erreur)
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si la connexion échoue, afficher un message d'erreur et arrêter le script
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }


    //Getter pour obtenir l'objet PDO
    protected function getPDO(): PDO {
        return $this->pdo;
    }


    //Exécuter une requête SELECT (pour récupérer des données)

    protected function execSelect(string $sql, array $params = []): array {
        try {
            // Préparer la requête SQL
            $statement = $this->pdo->prepare($sql);
            // Exécuter la requête avec les paramètres
            $statement->execute($params);
            // Retourner tous les résultats sous forme de tableau
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Afficher l'erreur si la requête échoue
            echo "Erreur de requête SELECT : " . $e->getMessage();
            return [];  // Retourner un tableau vide en cas d'erreur
        }
    }

    //Exécuter une requête de type INSERT, UPDATE ou DELETE
    protected function execModifyRequest(string $sql, array $params = []): bool {
        try {
            // Préparer la requête SQL
            $statement = $this->pdo->prepare($sql);
            // Exécuter la requête et retourner true si cela réussit
            return $statement->execute($params);
        } catch (PDOException $e) {
            // Afficher l'erreur si la requête échoue
            echo "Erreur de requête (INSERT, UPDATE, DELETE) : " . $e->getMessage();
            return false;  // Retourner false en cas d'erreur
        }
    }


    // Exécuter une requête SELECT qui retourne un seul enregistrement

    public function execSelectOne(string $sql, array $params = []): ?array {
        try {
            // Préparer la requête SQL
            $statement = $this->pdo->prepare($sql);
            // Exécuter la requête avec les paramètres
            $statement->execute($params);
            // Retourner un seul résultat (ou null si la requête ne retourne rien)
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Afficher l'erreur si la requête échoue
            echo "Erreur de requête SELECT (un seul enregistrement) : " . $e->getMessage();
            return null;  // Retourner null en cas d'erreur
        }
    }

    //Cette méthode permet de fermer la connexion à la base de données.

    public function closeConnection(): void {
        $this->pdo = null;  // Fermer la connexion PDO en la mettant à null
    }
}
