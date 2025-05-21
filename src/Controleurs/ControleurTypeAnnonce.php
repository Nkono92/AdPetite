<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/TypeAnnonce.php';


/**
 * Contrôleur des actions liées au Type d'annonce
 *
 */
class ControleurTypeAnnonce extends ControleurPersonnalise
{
    private $typeAnnonce;
    private $TypeAnnonceRepository;

    public function __construct()
    {
        $this->typeAnnonce = new TypeAnnonce();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->TypeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
    }

    /**
     * Get type annonce repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getTypeAnnonceRepository()
    {
        return $this->TypeAnnonceRepository;
    }

    /**
     * Affiche la liste des types d'annonce
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $typeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
            $this->typeAnnonce = $typeAnnonceRepository->findAll();
            $this->genererVue(array('typeAnnonces' => $this->typeAnnonce));
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
                    $typeAnnonce = new TypeAnnonce();
                    $typeAnnonce->setLibelle($libelle);
                    $this->getEntityManager()->persist($typeAnnonce);

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

    private function afficherVue()
    {

        // récupération de l'entité TypeAnnonce d'identifiant x dans la base
        if ($this->requete->existeParametre("id"))
        {
            // Récupération du type d'annonce
            $IdTypeAnnonce = $this->requete->getParametre("id");
            //$TypeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
            $TypeAnnonce = $this->getTypeAnnonceRepository()->find($IdTypeAnnonce);
            if ($TypeAnnonce == null)
                throw new Exception("Action impossible : type d'annonce non trouvé.");
            else
            {
                $this->genererVue(array('TypeAnnonce' => $TypeAnnonce), "Supprimer");
            }
        }
    }

    /**
     * fonction utilisée pour modifier les infos
     *
     * @throws Exception S'il manque des données
     */
    private function UpdateData()
    {
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdTypeAnnonce"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTypeAnnonce = $this->requete->getParametre("IdTypeAnnonce");
            $Libelle = $this->requete->getParametre("Libelle");

            // récupération de l'entité TypeAnnonce d'identifiant $IdTypeAnnonce dans la base
            //$TypeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
            $TypeAnnonce = $this->getTypeAnnonceRepository()->find($IdTypeAnnonce);
            if ($TypeAnnonce == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Type d'annonce non trouvé.");
            else
            {
                $TypeAnnonce->setLibelle($Libelle); //Modification du libelle

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
                // récupération de l'entité TypeAnnonce d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du type d'annonce
                    $IdTypeAnnonce = $this->requete->getParametre("id");
                    //$TypeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
                    $TypeAnnonce = $this->getTypeAnnonceRepository()->find($IdTypeAnnonce);
                    if ($TypeAnnonce == null)
                        throw new Exception("Action impossible : Type d'annonce non trouvé.");
                    else
                    {
                        $this->genererVue(array('TypeAnnonce' => $TypeAnnonce), "Modifier");
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
        if ($this->requete->existeParametre("IdTypeAnnonce"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTypeAnnonce = $this->requete->getParametre("IdTypeAnnonce");

            // récupération de l'entité TypeAnnonce d'identifiant $IdTypeAnnonce dans la base
            //$TypeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
            $TypeAnnonce = $this->getTypeAnnonceRepository()->find($IdTypeAnnonce);
            if ($TypeAnnonce == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Type d'annonce non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($TypeAnnonce);

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
                // récupération de l'entité TypeAnnonce d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du type d'annonce
                    $IdTypeAnnonce = $this->requete->getParametre("id");
                    //$TypeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
                    $TypeAnnonce = $this->getTypeAnnonceRepository()->find($IdTypeAnnonce);
                    if ($TypeAnnonce == null)
                        throw new Exception("Action impossible : Type d'annonce non trouvé.");
                    else
                    {
                        $this->genererVue(array('TypeAnnonce' => $TypeAnnonce), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
