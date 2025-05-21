<?php

require_once 'ControleurPersonnalise.php';
require_once 'Modeles/Utilisateur.php';
require_once 'Modeles/Categorie.php';
require_once 'Modeles/SousCategorie.php';
require_once 'Modeles/Pays.php';
require_once 'Modeles/Departement.php';
require_once 'Modeles/Ville.php';
require_once 'Modeles/Annonce.php';
require_once 'Modeles/PieceJointe.php';
require_once 'Modeles/TypeAnnonce.php';
require_once 'Modeles/TypePieceJointe.php';
require_once 'Modeles/ProfilUtilisateur.php';
require_once 'App_Code/Constantes.php';


/**
 * Contrôleur de la page d'accueil
 *
 * @author LEUMASSI FANSI Jean-Léopold & DONGMO KEMETIO Dalton
 */
class ControleurAccueil extends ControleurPersonnalise {

    private $CategorieRepository;
    private $Categorie;

    private $PaysRepository;
    private $Pays;

    private $VilleRepository;
    private $Ville;

    private $SousCategorieRepository;
    private $SousCategorie;

    private $AnnonceRepository;
    private $Annonce;


    public function __construct()
    {
        $this->Categorie = new Categorie();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->CategorieRepository = $this->getEntityManager()->getRepository("Categorie");
        $this->PaysRepository = $this->getEntityManager()->getRepository("Pays");
        $this->VilleRepository = $this->getEntityManager()->getRepository("Ville");
        $this->SousCategorieRepository = $this->getEntityManager()->getRepository("SousCategorie");
        $this->AnnonceRepository = $this->getEntityManager()->getRepository("Annonce");
        $this->queryBuilder  = $this->getEntityManager()->createQueryBuilder();
        $this->queryDQL  = $this->getEntityManager()->createQuery();
    }

    /**
     * Get Ville repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getVilleRepository()
    {
        return $this->VilleRepository;
    }

    /**
     * Get Annonce repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getAnnonceRepository()
    {
        return $this->AnnonceRepository;
    }

    /**
     * Get categorie repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getCategorieRepository()
    {
        return $this->CategorieRepository;
    }

    /**
     * Get pays repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getPaysRepository()
    {
        return $this->PaysRepository;
    }

    /**
     * Get SousCategorie Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getSousCategorieRepository()
    {
        return $this->SousCategorieRepository;
    }

    /**
     * Affiche la page d'accueil
     */
    public function index() {

        $this->requete->getSession()->setAttribut("Layout", "LayoutFront.php");
        $sessionClient = (($this->requete->getSession()->existeAttribut("sessionClient"))? $this->requete->getSession()->getAttribut("sessionClient"): null);
        $this->Categorie = $this->getCategorieRepository()->findAll();
        $this->Pays = $this->getPaysRepository()->findAll();
        $this->SousCategorie = $this->getSousCategorieRepository()->findBy(array(),array("IdSousCategorie" => "ASC"),12, 0);
        $this->Annonce = $this->getAnnonceRepository()->findBy(array(/*"Statut" => 1*/), array("DateCreation" => "DESC"), 6, 0);
        $this->genererVue(array('Categorie'=> $this->Categorie, 'SousCategories'=> $this->SousCategorie,
            'Pays' => $this->Pays, 'sessionClient'=> $sessionClient, 'Annonces' => $this->Annonce));
    }

    /**
     * Affiche la page d'accueil
     */
    public function indexAdmin() {
        $this->requete->getSession()->setAttribut("Layout", "Layout.php");
        $this->genererVue();
    }

    /**
     * Affiche les différentes catégories au client ou à l'internaute
     */
    public function Categories()
    {
        $this->Categorie = $this->getCategorieRepository()->findAll();
        $this->Pays = $this->getPaysRepository()->findAll();
        $this->SousCategorie = $this->getSousCategorieRepository()->findBy(array(),array("IdSousCategorie" => "ASC"),12, 0);

        // si une sous catégorie a été sélectionnée alors on récupère les annonces de cette sous catégorie.
        if ($this->requete->existeParametre("id"))
        {
            // Récupération de la sous catégorie
            $SousCategorie = $this->getSousCategorieRepository()->find($this->requete->getParametre("id"));
            if ($SousCategorie == null)
                //throw new Exception("Action impossible : sous catégorie non trouvée.");
            $this->genererVue(array('message'=> "Erreur survenue"), "erreur");

        else
            {
                //on sélectionne les annonces liée à la sous catégorie qui a été choisie
                $this->Annonce = $this->getAnnonceRepository()->findBy(array("SousCategorie" => $SousCategorie), array("DateCreation" => "DESC"));
                $this->genererVue(array('Categorie'=> $this->Categorie, 'SousCategories'=> $this->SousCategorie,
                    'Pays' => $this->Pays, 'Annonces' => $this->Annonce));
            }
        }
        else
        {
            $this->Annonce = $this->getAnnonceRepository()->findBy(array(/*"Statut" => 1*/), array("DateCreation" => "DESC"), 6, 0);
            $this->genererVue(array('Categorie'=> $this->Categorie, 'SousCategories'=> $this->SousCategorie,
                'Pays' => $this->Pays, 'Annonces' => $this->Annonce));
        }
    }

    /**
     * Permet de rechercher des annonces selon certains critères
     */
    public function TrouverAnnonce()
    {
        $this->Categorie = $this->getCategorieRepository()->findAll();
        $this->Pays = $this->getPaysRepository()->findAll();
        //on vérifie que la session existe
        if (!empty($_POST)) {

            //Création d'un tableau de paramètres.
            $monTableauDeParametre = array();
            $TableauDeParametre = array();

            // chaîne définissant une requête en langage DQL
            $requeteDQL = "SELECT A FROM Annonce A WHERE 1=1";

            if ($this->requete->existeParametre("IdVille")) {
                $requeteDQL = $requeteDQL. " AND A.Ville = :Ville ";
                $monTableauDeParametre['Ville'] = $this->requete->getParametre("IdVille");
                $Ville = $this->getVilleRepository()->findOneBy(array('IdVille' => $this->requete->getParametre("IdVille")));
                $TableauDeParametre['Ville'] = "Ville : ". $Ville->getLibelle();
            }

            if ($this->requete->existeParametre("IdSousCategorie")) {
                $requeteDQL = $requeteDQL . " AND A.SousCategorie = :Categorie ";
                $monTableauDeParametre['Categorie'] = $this->requete->getParametre("IdSousCategorie");
                $sousCategorie = $this->getSousCategorieRepository()->findOneBy(array('IdSousCategorie' => $this->requete->getParametre("IdSousCategorie")));
                $TableauDeParametre['Categorie'] = "Catégorie : ". $sousCategorie->getLibelle();
            }

            if ($this->requete->existeParametre("MotCle")) {
                $requeteDQL = $requeteDQL. " AND (A.Titre LIKE :MotCle ";
                $requeteDQL = $requeteDQL. " OR A.Description LIKE :MotCle ";
                $requeteDQL = $requeteDQL. " OR A.Autre LIKE :MotCle) ";
                $monTableauDeParametre['MotCle'] = '%' . $this->requete->getParametre("MotCle") . '%';
                $TableauDeParametre['MotCle'] = 'Mot clé : '. $this->requete->getParametre("MotCle");
            }

            //On range par ordre alphabétique d'abord selon les noms, puis selon les prénoms
            $requeteDQL = $requeteDQL. " ORDER BY  A.DateCreation DESC";


            $query = $this->getEntityManager()->createQuery($requeteDQL);
            //return $query->execute($monTableauDeParametre);

            $this->queryDQL = $this->getEntityManager()->createQuery($requeteDQL);

            $this->SousCategorie = $this->getSousCategorieRepository()->findBy(array(),array("IdSousCategorie" => "ASC"));
            $this->Annonce = $this->queryDQL->execute($monTableauDeParametre);

            $this->genererVue(array('SousCategories' => $this->SousCategorie, 'Annonces' => $this->Annonce,
                'Categorie' => $this->Categorie, 'Pays' => $this->Pays, 'TableauDeParametres' => $TableauDeParametre));
        }
        else
        {
            $this->rediriger("Accueil", "index");
        }
    }

    public function AProposDeNous()
    {
        $this->genererVue();
    }

    public function Contact()
    {
        $this->genererVue();
    }

    public function erreur()
    {
        $message= $this->requete->getParametre("id");
        if ($message == null)
            $message = 'Une erreur est survenue durant le traitement de votre requête. Veuillez réessayer svp.';
        $this->genererVue(array('message' => $message));
    }

}
