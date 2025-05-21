<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/TypePieceJointe.php';


/**
 * Contrôleur des actions liées au Type de pièces jointes
 *
 */
class ControleurTypePieceJointe extends ControleurPersonnalise
{
    private $typePieceJointe;

    public function __construct()
    {
        $this->typePieceJointe = new TypePieceJointe();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);

    }

    /**
     * Affiche la liste des types de pièces jointes
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $typePieceJointeRepository = $this->getEntityManager()->getRepository("TypePieceJointe");
            $this->typePieceJointe = $typePieceJointeRepository->findAll();
            $this->genererVue(array('typePieceJointes' => $this->typePieceJointe));
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
                    $typePieceJointe = new TypePieceJointe();
                    $typePieceJointe->setLibelle($libelle);
                    $this->getEntityManager()->persist($typePieceJointe);

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
        if ($this->requete->existeParametre("Libelle") && $this->requete->existeParametre("IdTypePieceJointe"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTypePieceJointe = $this->requete->getParametre("IdTypePieceJointe");
            $Libelle = $this->requete->getParametre("Libelle");

            // récupération de l'entité TypePieceJointe d'identifiant $IdTypePieceJointe dans la base
            $TypePieceJointeRepository = $this->getEntityManager()->getRepository("TypePieceJointe");
            $TypePieceJointe = $TypePieceJointeRepository->find($IdTypePieceJointe);
            if ($TypePieceJointe == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Type de pièce jointe non trouvé.");
            else
            {
                $TypePieceJointe->setLibelle($Libelle); //Modification du libelle

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
                // récupération de l'entité TypePieceJointe d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du type de pièce jointe
                    $IdTypePieceJointe = $this->requete->getParametre("id");
                    $TypePieceJointeRepository = $this->getEntityManager()->getRepository("TypePieceJointe");
                    $TypePieceJointe = $TypePieceJointeRepository->find($IdTypePieceJointe);
                    if ($TypePieceJointe == null)
                        throw new Exception("Action impossible : Type de pièce jointe non trouvé.");
                    else
                    {
                        $this->genererVue(array('TypePieceJointe' => $TypePieceJointe), "Modifier");
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
        if ($this->requete->existeParametre("IdTypePieceJointe"))
        {
            //On récupère les valeurs envoyées par POST
            $IdTypePieceJointe = $this->requete->getParametre("IdTypePieceJointe");

            // récupération de l'entité TypePieceJointe d'identifiant $IdTypePieceJointe dans la base
            $TypePieceJointeRepository = $this->getEntityManager()->getRepository("TypePieceJointe");
            $TypePieceJointe = $TypePieceJointeRepository->find($IdTypePieceJointe);
            if ($TypePieceJointe == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : Type de pièce jointe non trouvé.");
            else
            {
                //Suppression de l'objet
                $this->getEntityManager()->remove($TypePieceJointe);

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
                // récupération de l'entité TypePieceJointe d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération du type de pièce jointe
                    $IdTypePieceJointe = $this->requete->getParametre("id");
                    $TypePieceJointeRepository = $this->getEntityManager()->getRepository("TypePieceJointe");
                    $TypePieceJointe = $TypePieceJointeRepository->find($IdTypePieceJointe);
                    if ($TypePieceJointe == null)
                        throw new Exception("Action impossible : Type de pièce jointe non trouvé.");
                    else
                    {
                        $this->genererVue(array('TypePieceJointe' => $TypePieceJointe), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}
