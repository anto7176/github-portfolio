<?php

namespace Models;

class UnitDAO extends BasePDODAO {

    // Récupérer toutes les unités
    public function getAll(): array {
        $sql = 'SELECT * FROM unit';
        $result = $this->execSelect($sql);  // Utilise execSelect pour récupérer les résultats
        $units = [];

        // Transformer les résultats en objets Unit
        foreach ($result as $data) {
            $units[] = new Unit($data);
        }

        return $units;
    }

    // Ajouter une unité
    public function addUnit($name, $cost, $origin, $urlImg): bool {
        $sql = 'INSERT INTO unit (name, cost, origin, url_img) VALUES (:name, :cost, :origin, :url_img)';
        $params = [
            ':name' => $name,
            ':cost' => $cost,
            ':origin' => $origin,
            ':url_img' => $urlImg
        ];

        // Exécuter la requête d'insertion
        return $this->execModifyRequest($sql, $params);  // Retourne true si l'insertion réussit
    }

    // Récupérer une unité par ID (exemple)
    public function getUnitById($id) {
        $sql = 'SELECT * FROM unit WHERE id = :id';
        $params = [':id' => $id];

        $data = $this->execSelectOne($sql, $params);  // Récupère les données sous forme de tableau

        if ($data) {
            // Assurez-vous que l'objet Unit est instancié avec les données récupérées
            return new Unit($data);  // Renvoie un objet Unit
        }

        return null;  // Si aucune unité n'est trouvée, retourner null
    }


    // Méthode pour récupérer une seule unité
    public function execSelectOne(string $sql, array $params = []): ?array {
        // Appel de la méthode parente pour exécuter la requête
        return parent::execSelectOne($sql, $params);  // Appel à la méthode de la classe de base
    }

    public function deleteUnit(int $idUnit): int {
        $sql = 'DELETE FROM unit WHERE id = :id';
        $params = [':id' => $idUnit];

        // Exécute la requête de suppression
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        // Retourne le nombre de lignes affectées
        return $statement->rowCount();
    }
    public function updateUnit(array $dataUnit): bool {
        $sql = 'UPDATE unit SET name = :name, cost = :cost, origin = :origin, url_img = :url_img WHERE id = :id';
        $params = [
            ':id' => $dataUnit['idUnit'],
            ':name' => $dataUnit['name'],
            ':cost' => $dataUnit['cost'],
            ':origin' => $dataUnit['origin'],
            ':url_img' => $dataUnit['urlImg']
        ];

        // Exécuter la requête d'update
        return $this->execModifyRequest($sql, $params);  // Retourne true si la mise à jour réussit
    }

}
?>
