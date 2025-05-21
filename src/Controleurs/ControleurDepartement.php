<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/Departement.php';
require_once 'Modeles/Pays.php';
require_once 'Modeles/Ville.php';


/**
 * Contrôleur des actions liées au Departement
 *
 */
class ControleurDepartement extends ControleurPersonnalise
{
    private $Departement;
    private $DepartementRepository;
    private $PaysRepository;

    public function __construct()
    {
        $this->Departement = new Departement();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->DepartementRepository = $this->getEntityManager()->getRepository("Departement");
        $this->PaysRepository = $this->getEntityManager()->getRepository("Pays");

    }

    /**
     * Get departement repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getDepartementRepository()
    {
        return $this->DepartementRepository;
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
     * Affiche la liste des departement
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $this->Departement = $this->getDepartementRepository()->findAll();
            $this->genererVue(array('departements' => $this->Departement));
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
                if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdPays"))
                {
                    $libelle = $this->requete->getParametre("Libelle");
                    $idPays = $this->requete->getParametre("IdPays");
                    $departement = new Departement();
                    $departement->setLibelle($libelle);

                    //sélection du pays
                    $Pays = $this->getPaysRepository()->find($idPays);
                    $departement->setPays($Pays);

                    $this->getEntityManager()->persist($departement);

                    // Sauvegarde de l'entité gérée
                    $this->getEntityManager()->flush();

                    header('Location: index');
                }
                else
                    throw new Exception("Action impossible : Une erreur est survenue durant le processus.");
            } else {
                $Pays = $this->getPaysRepository()->findAll();
                $this->genererVue(array('Pays' => $Pays));
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
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdPays") && $this->requete->existeParametre("IdDepartement"))
        {
            //On récupère les valeurs envoyées par POST
            $IdDepartement = $this->requete->getParametre("IdDepartement");
            $Libelle = $this->requete->getParametre("Libelle");
            $IdPays = $this->requete->getParametre("IdPays");

            // récupération de l'entité Departement d'identifiant $IdDepartement dans la base
            //$DepartementRepository = $this->getEntityManager()->getRepository("Departement");
            $Departement = $this->getDepartementRepository()->find($IdDepartement);
            if ($Departement == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : departement non trouvé.");
            else
            {
                $Departement->setLibelle($Libelle); //Modification du libelle

                //Modification du code
                $Pays = $this->getPaysRepository()->find($IdPays);
                $Departement->setPays($Pays);

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
                // récupération de l'entité Departement d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du département
                    $IdDepartement = $this->requete->getParametre("id");
                    //$DepartementRepository = $this->getEntityManager()->getRepository("Departement");
                    $Departement = $this->getDepartementRepository()->find($IdDepartement);
                    if ($Departement == null)
                        throw new Exception("Action impossible : departement non trouvé.");
                    else
                    {
                        $Pays = $this->getPaysRepository()->findAll();
                        $this->genererVue(array('Departement' => $Departement, 'Pays' => $Pays), "Modifier");
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
        if ($this->requete->existeParametre("IdDepartement"))
        {
            //On récupère les valeurs envoyées par POST
            $IdDepartement = $this->requete->getParametre("IdDepartement");

            // récupération de l'entité Departement d'identifiant $IdDepartement dans la base
            //$DepartementRepository = $this->getEntityManager()->getRepository("Departement");
            $Departement = $this->getDepartementRepository()->find($IdDepartement);
            if ($Departement == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : departement non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($Departement);

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
                // récupération de l'entité Departement d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du département
                    $IdDepartement = $this->requete->getParametre("id");
                    //$DepartementRepository = $this->getEntityManager()->getRepository("Departement");
                    $Departement = $this->getDepartementRepository()->find($IdDepartement);
                    if ($Departement == null)
                        throw new Exception("Action impossible : departement non trouvé.");
                    else
                    {
                        $Pays = $this->getPaysRepository()->findAll();
                        $this->genererVue(array('Departement' => $Departement, 'Pays' => $Pays), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
