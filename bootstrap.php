<?php
// bootstrap.php

// importation du fichier "vendor/autoload.php"
require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);

// espaces de noms de Doctrine ORM utilisés par ce script
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


// sous-répertoire contenant les entités du projet
$entitiesPath = [
    join(DIRECTORY_SEPARATOR, [__DIR__, "src/Modeles"])
];

// Paramètres de connexion au SGBD :
// à adapter aux caractéristiques de chaque projet
$dbParams = array(
    'driver'   => 'pdo_mysql', // driver PHP à utiliser : ici PDO pour MySQL
    'host'     => 'localhost', // nom ou adresse de la machine hôte
    'user'     => 'script_php',      // identifiant de l'utilisateur
    'password' => 'zh6tjPp6T56N4dbF@',// mot de passe de l'utilisateur
    'dbname'   => 'adpetitedb',  // nom de la base de données
    'charset'  => 'utf8'  // jeu de caractères pour requêtes et résultats
);

// Paramètres de Doctrine et des annotations pour le développement ;
// l'utilisation d'un cache et de proxies
// améliore les performances de l'ORM en production
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

$config = Setup::createAnnotationMetadataConfiguration(
    $entitiesPath,
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

// Décommenter la ligne suivante pour l'affichage/le déboguage des requêtes
// $config->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());

// Création d'un gestionnaire d'entités utilisant les paramètres précédents
$entityManager = EntityManager::create($dbParams, $config);

return $entityManager;
