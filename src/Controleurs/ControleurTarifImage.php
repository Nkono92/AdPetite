<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/TarifImage.php';


/**
 * Contrôleur des actions liées au TarifImage
 *
 */
class ControleurTarifImage extends ControleurPersonnalise
{
    private $TarifImage;
    private $TarifImageRepository;

    public function __construct()
    {
        $this->TarifImage = new TarifImage();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->TarifImageRepository = $this->getEntityManager()->getRepository("TarifImage");
    }

    private function getTarifImageRepository()
    {
        return $this->TarifImageRepository;
    }

    /**
     * Affiche la liste des tarifs
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $tarifImageRepository = $this->getEntityManager()->getRepository("TarifImage");
            $this->TarifImage = $tarifImageRepository->findAll();
            $this->genererVue(array('tarifImages' => $this->TarifImage));
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
                    $tarifImage = new TarifImage();

                    //si la borne inférieure est supérieure à la borne supérieure, on inverse
                    if ($borneInf > $borneSup)
                    {
                        $tempo = $borneSup;
                        $borneSup = $borneInf;
                        $borneInf = $tempo;
                    }
                    $tarifImage->setLibelle($libelle);
                    $tarifImage->setBorneInf($borneInf);
                    $tarifImage->setBorneSup($borneSup);
                    $tarifImage->setMontant($montant);
                    $this->getEntityManager()->persist($tarifImage);

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
            && $this->requete->existeParametre("Montant") && $this->requete->existeParametre("IdTarifImage"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTarifImage = $this->requete->getParametre("IdTarifImage");
            $Libelle = $this->requete->getParametre("Libelle");
            $borneInf = $this->requete->getParametre("BorneInf");
            $borneSup = $this->requete->getParametre("BorneSup");
            $montant = $this->requete->getParametre("Montant");

            // récupération de l'entité TarifImage d'identifiant $IdTarifImage dans la base
            //$TarifImageRepository = $this->getEntityManager()->getRepository("TarifImage");
            $TarifImage = $this->getTarifImageRepository()->find($IdTarifImage);
            if ($TarifImage == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : tarifImage non trouvé.");
            else
            {
                $TarifImage->setLibelle($Libelle); //Modification du libelle
                if ($borneInf > $borneSup)
                {
                    $tempo = $borneSup;
                    $borneSup = $borneInf;
                    $borneInf = $tempo;
                }

                //Modification des bornes
                $TarifImage->setBorneInf($borneInf);
                $TarifImage->setBorneSup($borneSup);
                $TarifImage->setMontant($montant);

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
                // récupération de l'entité TarifImage d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du tarif des images
                    $IdTarifImage = $this->requete->getParametre("id");
                    //$TarifImageRepository = $this->getEntityManager()->getRepository("TarifImage");
                    $TarifImage = $this->getTarifImageRepository()->find($IdTarifImage);
                    if ($TarifImage == null)
                        throw new Exception("Action impossible : tarifImage non trouvé.");
                    else
                    {
                        $this->genererVue(array('TarifImage' => $TarifImage), "Modifier");
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
        if ($this->requete->existeParametre("IdTarifImage"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTarifImage = $this->requete->getParametre("IdTarifImage");

            // récupération de l'entité TarifImage d'identifiant $IdTarifImage dans la base
            //$TarifImageRepository = $this->getEntityManager()->getRepository("TarifImage");
            $TarifImage = $this->getTarifImageRepository()->find($IdTarifImage);
            if ($TarifImage == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : tarifImage non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($TarifImage);

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
                // récupération de l'entité TarifImage d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du tarif des images
                    $IdTarifImage = $this->requete->getParametre("id");
                    //$TarifImageRepository = $this->getEntityManager()->getRepository("TarifImage");
                    $TarifImage = $this->getTarifImageRepository()->find($IdTarifImage);
                    if ($TarifImage == null)
                        throw new Exception("Action impossible : tarifImage non trouvé.");
                    else
                    {
                        $this->genererVue(array('TarifImage' => $TarifImage), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
