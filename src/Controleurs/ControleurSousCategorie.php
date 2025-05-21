<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/SousCategorie.php';
require_once 'Modeles/Categorie.php';
require_once 'Modeles/Annonce.php';
require_once 'Modeles/TypeAnnonce.php';
require_once 'Modeles/Ville.php';
require_once 'Modeles/PieceJointe.php';


/**
 * Contrôleur des actions liées aux Sous Categories
 *
 */
class ControleurSousCategorie extends ControleurPersonnalise
{
    private $SousCategorie;
    private $SousCategorieRepository;
    private $CategorieRepository;

    public function __construct()
    {
        $this->SousCategorie = new SousCategorie();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->SousCategorieRepository = $this->getEntityManager()->getRepository("SousCategorie");
        $this->CategorieRepository = $this->getEntityManager()->getRepository("Categorie");

    }

    /**
     * Get sousCategorie repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getSousCategorieRepository()
    {
        return $this->SousCategorieRepository;
    }

    /**
     * Get pays repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getCategorieRepository()
    {
        return $this->CategorieRepository;
    }

    /**
     * Affiche la liste des sousCategorie
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $this->SousCategorie = $this->getSousCategorieRepository()->findAll();
            $this->genererVue(array('sousCategories' => $this->SousCategorie));
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
                if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("FontIcone") && $this->requete->existeParametre("IdCategorie"))
                {
                    $libelle = $this->requete->getParametre("Libelle");
                    $idCategorie = $this->requete->getParametre("IdCategorie");
                    $fontIcone = $this->requete->getParametre("FontIcone");
                    $sousCategorie = new SousCategorie();
                    $sousCategorie->setLibelle($libelle);
                    $sousCategorie->setFontIcone($fontIcone);

                    //sélection de la catégorie
                    $Categorie = $this->getCategorieRepository()->find($idCategorie);
                    $sousCategorie->setCategorie($Categorie);

                    $this->getEntityManager()->persist($sousCategorie);

                    // Sauvegarde de l'entité gérée
                    $this->getEntityManager()->flush();

                    header('Location: index');
                }
                else
                    throw new Exception("Action impossible : Une erreur est survenue durant le processus.");
            } else {
                $Categorie = $this->getCategorieRepository()->findAll();
                $this->genererVue(array('Categorie' => $Categorie));
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
    private function UpdateData()
    {
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdCategorie")
            && $this->requete->existeParametre("FontIcone") && $this->requete->existeParametre("IdSousCategorie"))
        {
            //On récupère les valeurs envoyées par POST
            $IdSousCategorie = $this->requete->getParametre("IdSousCategorie");
            $Libelle = $this->requete->getParametre("Libelle");
            $IdCategorie = $this->requete->getParametre("IdCategorie");
            $fontIcone = $this->requete->getParametre("FontIcone");

            // récupération de l'entité SousCategorie d'identifiant $IdSousCategorie dans la base
            //$SousCategorieRepository = $this->getEntityManager()->getRepository("SousCategorie");
            $SousCategorie = $this->getSousCategorieRepository()->find($IdSousCategorie);
            if ($SousCategorie == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : sous categorie non trouvée.");
            else
            {
                $SousCategorie->setLibelle($Libelle); //Modification du libelle
                $SousCategorie->setFontIcone($fontIcone); //Modification du fontIcone

                //Modification du code
                $Categorie = $this->getCategorieRepository()->find($IdCategorie);
                $SousCategorie->setCategorie($Categorie);

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
                // récupération de l'entité SousCategorie d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de la sous catégorie
                    $IdSousCategorie = $this->requete->getParametre("id");
                    //$SousCategorieRepository = $this->getEntityManager()->getRepository("SousCategorie");
                    $SousCategorie = $this->getSousCategorieRepository()->find($IdSousCategorie);
                    if ($SousCategorie == null)
                        throw new Exception("Action impossible : sous catégorie non trouvée.");
                    else
                    {
                        $Categorie = $this->getCategorieRepository()->findAll();
                        $this->genererVue(array('SousCategorie' => $SousCategorie, 'Categorie' => $Categorie), "Modifier");
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
        if ($this->requete->existeParametre("IdSousCategorie"))
        {
            //On récupère les valeurs envoyées par POST
            $IdSousCategorie = $this->requete->getParametre("IdSousCategorie");

            // récupération de l'entité SousCategorie d'identifiant $IdSousCategorie dans la base
            //$SousCategorieRepository = $this->getEntityManager()->getRepository("SousCategorie");
            $SousCategorie = $this->getSousCategorieRepository()->find($IdSousCategorie);
            if ($SousCategorie == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : sous catégorie non trouvée.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($SousCategorie);

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
                // récupération de l'entité SousCategorie d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de la sous catégorie
                    $IdSousCategorie = $this->requete->getParametre("id");
                    //$SousCategorieRepository = $this->getEntityManager()->getRepository("SousCategorie");
                    $SousCategorie = $this->getSousCategorieRepository()->find($IdSousCategorie);
                    if ($SousCategorie == null)
                        throw new Exception("Action impossible : sous catégorie non trouvée.");
                    else
                    {
                        $Categorie = $this->getCategorieRepository()->findAll();
                        $this->genererVue(array('SousCategorie' => $SousCategorie, 'Categorie' => $Categorie), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
