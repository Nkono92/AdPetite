<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/Categorie.php';
require_once 'Modeles/SousCategorie.php';
require_once 'Modeles/Annonce.php';


/**
 * Contrôleur des actions liées à la catégorie
 *
 */
class ControleurCategorie extends ControleurPersonnalise
{
    private $categorie;
    private $CategorieRepository;

    public function __construct()
    {
        $this->categorie = new Categorie();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->CategorieRepository = $this->getEntityManager()->getRepository("Categorie");
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
     * Affiche la liste des catégories
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $categorieRepository = $this->getEntityManager()->getRepository("Categorie");
            $this->categorie = $categorieRepository->findAll();
            $this->genererVue(array('categories' => $this->categorie));
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

    /**
     * Ajouter un nouveau type
     */
    public function Ajouter()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            if (!empty($_POST))
            {
                if ($this->requete->existeParametre("Libelle"))
                {
                    $libelle = $this->requete->getParametre("Libelle");
                    $categorie = new Categorie();
                    $categorie->setLibelle($libelle);
                    $this->getEntityManager()->persist($categorie);

                    // Sauvegarde de l'entité gérée
                    $this->getEntityManager()->flush();

                    header('Location: index');
                }
                else
                    throw new Exception("Action impossible : Une erreur est survenue durant le processus.");
            }
            $this->genererVue();
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

    /**
     * fonction utilisée pour modifier les infos
     *
     * @throws Exception S'il manque des données
     */
    private function UpdateData()
    {
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdCategorie"))
        {
            //On récupère les valeurs envoyées par POST
            $IdCategorie = $this->requete->getParametre("IdCategorie");
            $Libelle = $this->requete->getParametre("Libelle");

            // récupération de l'entité Categorie d'identifiant $IdCategorie dans la base
            //$CategorieRepository = $this->getEntityManager()->getRepository("Categorie");
            $Categorie = $this->getCategorieRepository()->find($IdCategorie);
            if ($Categorie == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Type d'annonce  non trouvé.");
            else
            {
                $Categorie->setLibelle($Libelle); //Modification du libelle

                // Sauvegarde de l'entité gérée
                $this->getEntityManager()->flush();
                header('Location: index'); //Retour à la page index

            }
        }
        else
            throw new Exception("Action impossible : Tous les paramètres n'ont pas été envoyés.");
    }


    /**
     * Modifie les infos
     *
     * @throws Exception S'il manque des données
     */
    public function Modifier()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {

            if (!empty($_POST))
            {
                $this->UpdateData();
            }
            else
            {
                // récupération de l'entité Categorie d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de la catégorie
                    $IdCategorie = $this->requete->getParametre("id");
                    //$CategorieRepository = $this->getEntityManager()->getRepository("Categorie");
                    $Categorie = $this->getCategorieRepository()->find($IdCategorie);
                    if ($Categorie == null)
                        throw new Exception("Action impossible : Catégorie non trouvée.");
                    else
                    {
                        $this->genererVue(array('Categorie' => $Categorie), "Modifier");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

    /**
     * fonction utilisée pour modifier les infos
     *
     * @throws Exception S'il manque des données
     */
    private function DeleteData()
    {
        if ($this->requete->existeParametre("IdCategorie"))
        {
            //On récupère les valeurs envoyées par POST
            $IdCategorie = $this->requete->getParametre("IdCategorie");

            // récupération de l'entité Categorie d'identifiant $IdCategorie dans la base
            //$CategorieRepository = $this->getEntityManager()->getRepository("Categorie");
            $Categorie = $this->getCategorieRepository()->find($IdCategorie);
            if ($Categorie == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Catégorie non trouvée.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($Categorie);

                //Validation de l'action dans la base de données
                $this->getEntityManager()->flush();

                //Retour à la page index
                header('Location: index');

            }
        }
        else
            throw new Exception("Action impossible : Tous les paramètres n'ont pas été envoyés.");
    }



    /**
     * Supprimer les infos
     *
     * @throws Exception S'il manque des données
     */
    public function Supprimer()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            if (!empty($_POST))
            {
                $this->DeleteData();
            }
            else
            {
                // récupération de l'entité Categorie d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de la catégorie
                    $IdCategorie = $this->requete->getParametre("id");
                    //$CategorieRepository = $this->getEntityManager()->getRepository("Categorie");
                    $Categorie = $this->getCategorieRepository()->find($IdCategorie);
                    if ($Categorie == null)
                        throw new Exception("Action impossible : Catégorie non trouvée.");
                    else
                    {
                        $this->genererVue(array('Categorie' => $Categorie), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
