<?php

namespace Helpers;

/**
 * Exemple d'implémentation générale permettant de gérer plusieurs répertoires de base
 * pour un préfixe de namespace donné.
 *
 * Par exemple, pour un package foo-bar de classes, l'autoloader permettra de charger
 * les classes de ces répertoires :
 *
 *     /path/to/packages/foo-bar/
 *         src/
 *             Baz.php             # Foo\Bar\Baz
 *             Qux/
 *                 Quux.php        # Foo\Bar\Qux\Quux
 *         tests/
 *             BazTest.php         # Foo\Bar\BazTest
 *             Qux/
 *                 QuuxTest.php    # Foo\Bar\Qux\QuuxTest
 *
 * Le chemin d'accès aux fichiers des classes pour le préfixe de namespace \Foo\Bar
 * sera ajouté de cette manière :
 *
 *      <?php
 *      $loader = new \Helpers\Psr4AutoloaderClass;
 *      $loader->register();
 *      $loader->addNamespace('Foo\Bar', '/path/to/packages/foo-bar/src');
 *      $loader->addNamespace('Foo\Bar', '/path/to/packages/foo-bar/tests');
 *
 * Cette ligne tentera de charger la classe \Foo\Bar\Qux\Quux depuis le fichier
 * /path/to/packages/foo-bar/src/Qux/Quux.php :
 *
 *      new \Foo\Bar\Qux\Quux;
 *
 * Cette ligne tentera de charger le test \Foo\Bar\Qux\QuuxTest depuis le fichier
 * /path/to/packages/foo-bar/tests/Qux/QuuxTest.php :
 *
 *      new \Foo\Bar\Qux\QuuxTest;
 */
class Psr4AutoloaderClass
{
    /**
     * Un tableau associatif où la clé est le préfixe de namespace et la valeur
     * est un tableau des répertoires de base pour les classes de ce namespace.
     *
     * @var array
     */
    protected $prefixes = array();

    /**
     * Enregistre l'autoloader dans la pile SPL des autoloaders.
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Ajoute un répertoire de base pour un préfixe de namespace donné.
     *
     * @param string $prefix Le préfixe du namespace.
     * @param string $base_dir Un répertoire de base pour les fichiers de classe dans ce namespace.
     * @param bool $prepend Si vrai, le répertoire est ajouté en tête de la pile, sinon il est ajouté à la fin.
     * @return void
     */
    public function addNamespace($prefix, $base_dir, $prepend = false)
    {
        // Normalise le préfixe du namespace
        $prefix = trim($prefix, '\\') . '\\';

        // Normalise le répertoire de base en ajoutant un séparateur à la fin
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        // Initialise le tableau pour le préfixe de namespace s'il n'existe pas encore
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        // Ajoute le répertoire de base pour le préfixe de namespace
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
            array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    /**
     * Charge le fichier de la classe pour un nom de classe donné.
     *
     * @param string $class Le nom complet de la classe.
     * @return mixed Le nom du fichier mappé si réussi, ou false en cas d'échec.
     */
    public function loadClass($class)
    {
        // Le préfixe actuel du namespace
        $prefix = $class;

        // Recherche à travers les namespaces pour trouver un fichier mappé
        while (false !== $pos = strrpos($prefix, '\\')) {

            // Récupère le préfixe du namespace
            $prefix = substr($class, 0, $pos + 1);

            // Le reste du nom est la classe relative
            $relative_class = substr($class, $pos + 1);

            // Essaye de charger un fichier mappé pour le préfixe et la classe relative
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);

            if ($mapped_file) {
                return $mapped_file;
            }

            // Retire le séparateur de namespace pour la prochaine itération
            $prefix = rtrim($prefix, '\\');
        }

        // Si aucun fichier mappé n'est trouvé, retourne false
        return false;
    }

    /**
     * Charge le fichier mappé pour un préfixe de namespace et une classe relative.
     *
     * @param string $prefix Le préfixe du namespace.
     * @param string $relative_class Le nom relatif de la classe.
     * @return mixed Retourne false si aucun fichier mappé n'est trouvé, ou le nom du fichier mappé qui a été chargé.
     */
    protected function loadMappedFile($prefix, $relative_class)
    {
        // Vérifie si le préfixe existe dans les mappages
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // Cherche à travers les répertoires de base pour ce préfixe de namespace
        foreach ($this->prefixes[$prefix] as $base_dir) {

            // Remplace le préfixe du namespace par le répertoire de base, remplace les séparateurs de namespace par des séparateurs de répertoires, et ajoute .php
            $file = $base_dir
                . str_replace('\\', '/', $relative_class)
                . '.php';

            // Si le fichier mappé existe, le requiert
            if ($this->requireFile($file)) {
                return $file;
            }
        }

        return false;
    }

    /**
     * Si le fichier existe, le requiert depuis le système de fichiers.
     *
     * @param string $file Le fichier à inclure.
     * @return bool Retourne true si le fichier existe, sinon false.
     */
    protected function requireFile($file)
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        else if (file_exists('.'.$file)) {
            require '.'.$file;
            return true;
        }
        return false;
    }
}
