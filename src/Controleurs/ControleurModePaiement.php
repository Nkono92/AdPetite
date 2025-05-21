<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/ModePaiement.php';


/**
 * Contrôleur des actions liées au Mode de paiement
 *
 */
class ControleurModePaiement extends ControleurPersonnalise
{
    private $modePaiement;
    private $ModePaiementRepository;

    public function __construct()
    {
        $this->modePaiement = new ModePaiement();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->ModePaiementRepository = $this->getEntityManager()->getRepository("ModePaiement");
    }

    /**
     * Get mode paiement repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getModePaiementRepository()
    {
        return $this->ModePaiementRepository;
    }

    /**
     * Affiche la liste des modes de paiement
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $modePaiementRepository = $this->getEntityManager()->getRepository("ModePaiement");
            $this->modePaiement = $modePaiementRepository->findAll();
            $this->genererVue(array('modePaiements' => $this->modePaiement));
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
                if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("CodeMode"))
                {
                    $libelle = $this->requete->getParametre("Libelle");
                    $codeMode = $this->requete->getParametre("CodeMode");
                    $modePaiement = new ModePaiement();
                    $modePaiement->setLibelle($libelle);
                    $modePaiement->setCodeMode($codeMode);
                    $this->getEntityManager()->persist($modePaiement);

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
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("CodeMode") && $this->requete->existeParametre("IdModePaiement"))
        {
            //On récupère les valeurs envoyées par POST
            $IdModePaiement = $this->requete->getParametre("IdModePaiement");
            $Libelle = $this->requete->getParametre("Libelle");
            $CodeMode = $this->requete->getParametre("CodeMode");

            // récupération de l'entité ModePaiement d'identifiant $IdModePaiement dans la base
            //$ModePaiementRepository = $this->getEntityManager()->getRepository("ModePaiement");
            $ModePaiement = $this->getModePaiementRepository()->find($IdModePaiement);
            if ($ModePaiement == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : mode de paiement non trouvé.");
            else
            {
                $ModePaiement->setLibelle($Libelle); //Modification du libelle
                $ModePaiement->setCodeMode($CodeMode); //Modification du code

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
                // récupération de l'entité ModePaiement d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du mode de paiement
                    $IdModePaiement = $this->requete->getParametre("id");
                    //$ModePaiementRepository = $this->getEntityManager()->getRepository("ModePaiement");
                    $ModePaiement = $this->getModePaiementRepository()->find($IdModePaiement);
                    if ($ModePaiement == null)
                        throw new Exception("Action impossible : mode de paiement non trouvé.");
                    else
                    {
                        $this->genererVue(array('ModePaiement' => $ModePaiement), "Modifier");
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
        if ($this->requete->existeParametre("IdModePaiement"))
        {
            //On récupère les valeurs envoyées par POST
            $IdModePaiement = $this->requete->getParametre("IdModePaiement");

            // récupération de l'entité ModePaiement d'identifiant $IdModePaiement dans la base
            //$ModePaiementRepository = $this->getEntityManager()->getRepository("ModePaiement");
            $ModePaiement = $this->getModePaiementRepository()->find($IdModePaiement);
            if ($ModePaiement == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : mode de paiement non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($ModePaiement);

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
                // récupération de l'entité ModePaiement d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du mode de paiement
                    $IdModePaiement = $this->requete->getParametre("id");
                    //$ModePaiementRepository = $this->getEntityManager()->getRepository("ModePaiement");
                    $ModePaiement = $this->getModePaiementRepository()->find($IdModePaiement);
                    if ($ModePaiement == null)
                        throw new Exception("Action impossible : mode de paiement non trouvé.");
                    else
                    {
                        $this->genererVue(array('ModePaiement' => $ModePaiement), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
