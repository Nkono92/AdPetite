<?php

require_once 'App_Start/Controleur.php';
//require_once 'Modele/Panier.php';

/**
 * Contrôleur abstrait pour les vues devant afficher les infos client
 * 
 */
abstract class ControleurPersonnalise extends Controleur
{

    protected $path;
    protected $entityManager;

    public function getPath()
    {
        return $this->path;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Redéfinition permettant d'ajouter les infos clients aux données des vues 
     * 
     * @param type $donneesVue Données dynamiques
     * @param type $action Action associée à la vue
     */
    protected function genererVue($donneesVue = array(), $action = null)
    {
        $sessionClient = null;
        $nbArticlesPanier = 0;
        // Si les infos client sont présente dans la session...
        if ($this->requete->getSession()->existeAttribut("sessionClient")) {
            // ... on les récupère ...
            $sessionClient = $this->requete->getSession()->getAttribut("sessionClient");
            
            /*$panier = new Panier();
            $nbArticlesPanier = $panier->getNbArticles($client['idClient']);*/
        }
        // ... et on les ajoute aux données de la vue
        parent::genererVue($donneesVue + array('sessionClient' => $sessionClient), $action);
    }

}