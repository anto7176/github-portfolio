<?php

namespace Config;

use Exception;

class Config {

    // Tableau statique pour stocker les paramètres
    private static $param;

    // Renvoie la valeur d'un paramètre de configuration
    public static function get($nom, $valeurParDefaut = null) {
        // Vérifier si le paramètre est défini
        $params = self::getParameter();

        if (isset($params[$nom])) {
            return $params[$nom];  // Retourne la valeur trouvée
        }

        // Retourne la valeur par défaut si la clé n'existe pas
        return $valeurParDefaut;
    }

    // Renvoie le tableau des paramètres de configuration en le chargeant si nécessaire
    private static function getParameter() {
        // Si les paramètres n'ont pas encore été chargés, on les charge
        if (self::$param === null) {
            // Définir le chemin du fichier de configuration
            $cheminFichier = "Config/prod.ini";  // Fichier de prod par défaut

            // Vérifier si le fichier de configuration de développement existe
            if (!file_exists($cheminFichier)) {
                $cheminFichier = "Config/dev.ini"; // Utiliser dev.ini s'il n'y a pas de prod.ini
            }

            // Vérifier si aucun fichier de configuration n'est trouvé
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé : $cheminFichier");
            } else {
                // Charger le fichier .ini dans la variable statique
                self::$param = parse_ini_file($cheminFichier, true);  // Le true permet de lire les sections du fichier INI
            }
        }
        return self::$param;
    }
}
