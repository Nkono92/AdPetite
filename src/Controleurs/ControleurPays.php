<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/Pays.php';
require_once 'Modeles/Departement.php';
require_once 'Modeles/Ville.php';


/**
 * Contrôleur des actions liées au Pays
 *
 */
class ControleurPays extends ControleurPersonnalise
{
    private $Pays;
    private $PaysRepository;

    public function __construct()
    {
        $this->Pays = new Pays();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->PaysRepository = $this->getEntityManager()->getRepository("Pays");
    }

    private function getPaysRepository()
    {
        return $this->PaysRepository;
    }

    /**
     * Affiche la liste des pays
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $paysRepository = $this->getEntityManager()->getRepository("Pays");
            $this->Pays = $paysRepository->findAll();
            $this->genererVue(array('pays' => $this->Pays));
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
                if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("CodePays"))
                {
                    $libelle = $this->requete->getParametre("Libelle");
                    $codePays = $this->requete->getParametre("CodePays");
                    $pays = new Pays();
                    $pays->setLibelle($libelle);
                    $pays->setCodePays($codePays);
                    $this->getEntityManager()->persist($pays);

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
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("CodePays") && $this->requete->existeParametre("IdPays"))
        {
            //On récupère les valeurs envoyées par POST
            $IdPays = $this->requete->getParametre("IdPays");
            $Libelle = $this->requete->getParametre("Libelle");
            $CodePays = $this->requete->getParametre("CodePays");

            // récupération de l'entité Pays d'identifiant $IdPays dans la base
            //$PaysRepository = $this->getEntityManager()->getRepository("Pays");
            $Pays = $this->getPaysRepository()->find($IdPays);
            if ($Pays == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : pays non trouvé.");
            else
            {
                $Pays->setLibelle($Libelle); //Modification du libelle
                $Pays->setCodePays($CodePays); //Modification du code

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
                // récupération de l'entité Pays d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du pays
                    $IdPays = $this->requete->getParametre("id");
                    //$PaysRepository = $this->getEntityManager()->getRepository("Pays");
                    $Pays = $this->getPaysRepository()->find($IdPays);
                    if ($Pays == null)
                        throw new Exception("Action impossible : pays non trouvé.");
                    else
                    {
                        $this->genererVue(array('Pays' => $Pays), "Modifier");
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
        if ($this->requete->existeParametre("IdPays"))
        {
            //On récupère les valeurs envoyées par POST
            $IdPays = $this->requete->getParametre("IdPays");

            // récupération de l'entité Pays d'identifiant $IdPays dans la base
            //$PaysRepository = $this->getEntityManager()->getRepository("Pays");
            $Pays = $this->getPaysRepository()->find($IdPays);
            if ($Pays == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : pays non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($Pays);

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
                // récupération de l'entité Pays d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du pays
                    $IdPays = $this->requete->getParametre("id");
                    //$PaysRepository = $this->getEntityManager()->getRepository("Pays");
                    $Pays = $this->getPaysRepository()->find($IdPays);
                    if ($Pays == null)
                        throw new Exception("Action impossible : pays non trouvé.");
                    else
                    {
                        $this->genererVue(array('Pays' => $Pays), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
