<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/ProfilUtilisateur.php';


/**
 * Contrôleur des actions liées au Profil utilisateur
 *
 */
class ControleurProfilUtilisateur extends ControleurPersonnalise
{
    private $profilUtilisateur;
    private $ProfilUtilisateurRepository;

    public function __construct()
    {
        $this->profilUtilisateur = new ProfilUtilisateur();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->ProfilUtilisateurRepository = $this->getEntityManager()->getRepository("ProfilUtilisateur");
    }

    /**
     * Get profil utilisateur repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getProfilUtilisateurRepository()
    {
        return $this->ProfilUtilisateurRepository;
    }

    /**
     * Affiche la liste des profils utilisateur
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $profilUtilisateurRepository = $this->getEntityManager()->getRepository("ProfilUtilisateur");
            $this->profilUtilisateur = $profilUtilisateurRepository->findAll();
            $this->genererVue(array('profilUtilisateurs' => $this->profilUtilisateur));
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
                    $profilUtilisateur = new ProfilUtilisateur();
                    $profilUtilisateur->setLibelle($libelle);
                    $this->getEntityManager()->persist($profilUtilisateur);

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
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdProfilUtilisateur"))
        {
            //On récupère les valeurs envoyées par POST
            $IdProfilUtilisateur = $this->requete->getParametre("IdProfilUtilisateur");
            $Libelle = $this->requete->getParametre("Libelle");

            // récupération de l'entité ProfilUtilisateur d'identifiant $IdProfilUtilisateur dans la base
            //$ProfilUtilisateurRepository = $this->getEntityManager()->getRepository("ProfilUtilisateur");
            $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->find($IdProfilUtilisateur);
            if ($ProfilUtilisateur == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Profil utilisateur non trouvé.");
            else
            {
                $ProfilUtilisateur->setLibelle($Libelle); //Modification du libelle

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
                // récupération de l'entité ProfilUtilisateur d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du profil utilisateur
                    $IdProfilUtilisateur = $this->requete->getParametre("id");
                    //$ProfilUtilisateurRepository = $this->getEntityManager()->getRepository("ProfilUtilisateur");
                    $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->find($IdProfilUtilisateur);
                    if ($ProfilUtilisateur == null)
                        throw new Exception("Action impossible : Profil utilisateur non trouvé.");
                    else
                    {
                        $this->genererVue(array('ProfilUtilisateur' => $ProfilUtilisateur), "Modifier");
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
        if ($this->requete->existeParametre("IdProfilUtilisateur"))
        {
            //On récupère les valeurs envoyées par POST
            $IdProfilUtilisateur = $this->requete->getParametre("IdProfilUtilisateur");

            // récupération de l'entité ProfilUtilisateur d'identifiant $IdProfilUtilisateur dans la base
            //$ProfilUtilisateurRepository = $this->getEntityManager()->getRepository("ProfilUtilisateur");
            $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->find($IdProfilUtilisateur);
            if ($ProfilUtilisateur == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Profil utilisateur non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($ProfilUtilisateur);

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
                // récupération de l'entité ProfilUtilisateur d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du profil utilisateur
                    $IdProfilUtilisateur = $this->requete->getParametre("id");
                    //$ProfilUtilisateurRepository = $this->getEntityManager()->getRepository("ProfilUtilisateur");
                    $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->find($IdProfilUtilisateur);
                    if ($ProfilUtilisateur == null)
                        throw new Exception("Action impossible : Profil utilisateur non trouvé.");
                    else
                    {
                        $this->genererVue(array('ProfilUtilisateur' => $ProfilUtilisateur), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
