<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/TarifTexte.php';


/**
 * Contrôleur des actions liées au TarifTexte
 *
 */
class ControleurTarifTexte extends ControleurPersonnalise
{
    private $TarifTexte;
    private $TarifTexteRepository;

    public function __construct()
    {
        $this->TarifTexte = new TarifTexte();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->TarifTexteRepository = $this->getEntityManager()->getRepository("TarifTexte");
    }

    private function getTarifTexteRepository()
    {
        return $this->TarifTexteRepository;
    }

    /**
     * Affiche la liste des tarifs
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $tarifTexteRepository = $this->getEntityManager()->getRepository("TarifTexte");
            $this->TarifTexte = $tarifTexteRepository->findAll();
            $this->genererVue(array('tarifTextes' => $this->TarifTexte));
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

    /**
     * Ajouter un nouveau tarif
     */
    public function Ajouter()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            if (!empty($_POST))
            {
                if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("BorneInf") && $this->requete->existeParametre("BorneSup")
                    && $this->requete->existeParametre("Montant"))
                {
                    $libelle = $this->requete->getParametre("Libelle");
                    $borneInf = $this->requete->getParametre("BorneInf");
                    $borneSup = $this->requete->getParametre("BorneSup");
                    $montant = $this->requete->getParametre("Montant");
                    $tarifTexte = new TarifTexte();

                    //si la borne inférieure est supérieure à la borne supérieure, on inverse
                    if ($borneInf > $borneSup)
                    {
                        $tempo = $borneSup;
                        $borneSup = $borneInf;
                        $borneInf = $tempo;
                    }
                    $tarifTexte->setLibelle($libelle);
                    $tarifTexte->setBorneInf($borneInf);
                    $tarifTexte->setBorneSup($borneSup);
                    $tarifTexte->setMontant($montant);
                    $this->getEntityManager()->persist($tarifTexte);

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
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("BorneInf") && $this->requete->existeParametre("BorneSup")
            && $this->requete->existeParametre("Montant") && $this->requete->existeParametre("IdTarifTexte"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTarifTexte = $this->requete->getParametre("IdTarifTexte");
            $Libelle = $this->requete->getParametre("Libelle");
            $borneInf = $this->requete->getParametre("BorneInf");
            $borneSup = $this->requete->getParametre("BorneSup");
            $montant = $this->requete->getParametre("Montant");

            // récupération de l'entité TarifTexte d'identifiant $IdTarifTexte dans la base
            //$TarifTexteRepository = $this->getEntityManager()->getRepository("TarifTexte");
            $TarifTexte = $this->getTarifTexteRepository()->find($IdTarifTexte);
            if ($TarifTexte == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : tarifTexte non trouvé.");
            else
            {
                $TarifTexte->setLibelle($Libelle); //Modification du libelle
                if ($borneInf > $borneSup)
                {
                    $tempo = $borneSup;
                    $borneSup = $borneInf;
                    $borneInf = $tempo;
                }

                //Modification des bornes
                $TarifTexte->setBorneInf($borneInf);
                $TarifTexte->setBorneSup($borneSup);
                $TarifTexte->setMontant($montant);

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
                // récupération de l'entité TarifTexte d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du tarif des textes
                    $IdTarifTexte = $this->requete->getParametre("id");
                    //$TarifTexteRepository = $this->getEntityManager()->getRepository("TarifTexte");
                    $TarifTexte = $this->getTarifTexteRepository()->find($IdTarifTexte);
                    if ($TarifTexte == null)
                        throw new Exception("Action impossible : tarifTexte non trouvé.");
                    else
                    {
                        $this->genererVue(array('TarifTexte' => $TarifTexte), "Modifier");
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
        if ($this->requete->existeParametre("IdTarifTexte"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTarifTexte = $this->requete->getParametre("IdTarifTexte");

            // récupération de l'entité TarifTexte d'identifiant $IdTarifTexte dans la base
            //$TarifTexteRepository = $this->getEntityManager()->getRepository("TarifTexte");
            $TarifTexte = $this->getTarifTexteRepository()->find($IdTarifTexte);
            if ($TarifTexte == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : tarifTexte non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($TarifTexte);

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
                // récupération de l'entité TarifTexte d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du tarif des textes
                    $IdTarifTexte = $this->requete->getParametre("id");
                    //$TarifTexteRepository = $this->getEntityManager()->getRepository("TarifTexte");
                    $TarifTexte = $this->getTarifTexteRepository()->find($IdTarifTexte);
                    if ($TarifTexte == null)
                        throw new Exception("Action impossible : tarifTexte non trouvé.");
                    else
                    {
                        $this->genererVue(array('TarifTexte' => $TarifTexte), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
