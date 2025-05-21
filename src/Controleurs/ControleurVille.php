<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/Ville.php';
require_once 'Modeles/Departement.php';
require_once 'Modeles/Pays.php';


/**
 * Contrôleur des actions liées au Ville
 *
 */
class ControleurVille extends ControleurPersonnalise
{
    private $Ville;
    private $VilleRepository;
    private $DepartementRepository;

    public function __construct()
    {
        $this->Ville = new Ville();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->VilleRepository = $this->getEntityManager()->getRepository("Ville");
        $this->DepartementRepository = $this->getEntityManager()->getRepository("Departement");

    }

    /**
     * Get ville repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getVilleRepository()
    {
        return $this->VilleRepository;
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
     * Affiche la liste des ville
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $this->Ville = $this->getVilleRepository()->findAll() ;
            $this->genererVue(array('villes' => $this->Ville));
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
                if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdDepartement"))
                {
                    $libelle = $this->requete->getParametre("Libelle");
                    $idDepartement = $this->requete->getParametre("IdDepartement");
                    $ville = new Ville();
                    $ville->setLibelle($libelle);

                    //sélection du departement
                    $Departement = $this->getDepartementRepository()->find($idDepartement);
                    $ville->setDepartement($Departement);

                    $this->getEntityManager()->persist($ville);

                    // Sauvegarde de l'entité gérée
                    $this->getEntityManager()->flush();

                    header('Location: index');
                }
                else
                    throw new Exception("Action impossible : Une erreur est survenue durant le processus.");
            } else {
                $Departement = $this->getDepartementRepository()->findAll();
                $this->genererVue(array('Departement' => $Departement));
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
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdDepartement") && $this->requete->existeParametre("IdVille"))
        {
            //On récupère les valeurs envoyées par POST
            $IdVille = $this->requete->getParametre("IdVille");
            $Libelle = $this->requete->getParametre("Libelle");
            $IdDepartement = $this->requete->getParametre("IdDepartement");

            // récupération de l'entité Ville d'identifiant $IdVille dans la base
            //$VilleRepository = $this->getEntityManager()->getRepository("Ville");
            $Ville = $this->getVilleRepository()->find($IdVille);
            if ($Ville == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : ville non trouvée.");
            else
            {
                $Ville->setLibelle($Libelle); //Modification du libelle

                //Modification du code
                $Departement = $this->getDepartementRepository()->find($IdDepartement);
                $Ville->setDepartement($Departement);

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
                // récupération de l'entité Ville d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de la ville
                    $IdVille = $this->requete->getParametre("id");
                    //$VilleRepository = $this->getEntityManager()->getRepository("Ville");
                    $Ville = $this->getVilleRepository()->find($IdVille);
                    if ($Ville == null)
                        throw new Exception("Action impossible : ville non trouvée.");
                    else
                    {
                        $Departement = $this->getDepartementRepository()->findAll();
                        $this->genererVue(array('Ville' => $Ville, 'Departement' => $Departement), "Modifier");
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
        if ($this->requete->existeParametre("IdVille"))
        {
            //On récupère les valeurs envoyées par POST
            $IdVille = $this->requete->getParametre("IdVille");

            // récupération de l'entité Ville d'identifiant $IdVille dans la base
            //$VilleRepository = $this->getEntityManager()->getRepository("Ville");
            $Ville = $this->getVilleRepository()->find($IdVille);
            if ($Ville == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : ville non trouvée.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($Ville);

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
                // récupération de l'entité Ville d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de la ville
                    $IdVille = $this->requete->getParametre("id");
                    //$VilleRepository = $this->getEntityManager()->getRepository("Ville");
                    $Ville = $this->getVilleRepository()->find($IdVille);
                    if ($Ville == null)
                        throw new Exception("Action impossible : ville non trouvée.");
                    else
                    {
                        $Departement = $this->getDepartementRepository()->findAll();
                        $this->genererVue(array('Ville' => $Ville, 'Departement' => $Departement), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
