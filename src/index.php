<?php

// Contrôleur frontal : instancie un routeur pour traiter la requête entrante

require 'App_Start/Routeur.php';

$routeur = new Routeur();
$routeur->routerRequete();

