<?php
require_once 'ControleurPersonnalise.php';
require_once 'App_Code/Constantes.php';
require_once 'Modeles/Annonce.php';
require_once 'Modeles/SousCategorie.php';
require_once 'Modeles/Categorie.php';
require_once 'Modeles/TypeAnnonce.php';
require_once 'Modeles/Ville.php';
require_once 'Modeles/Departement.php';
require_once 'Modeles/Pays.php';
require_once 'Modeles/PieceJointe.php';
require_once 'Modeles/Utilisateur.php';
require_once 'Modeles/TypePieceJointe.php';
require_once 'Modeles/ProfilUtilisateur.php';
require_once 'Modeles/Favoris.php';


/**
 * Contrôleur des actions liées aux annonces
 *
 */

class ControleurAnnonce extends ControleurPersonnalise
{

    private $Annonce;
    private $AnnonceRepository;

    private $TypeAnnonce;
    private $TypeAnnonceRepository;

    private $Ville;
    private $VilleRepository;

    private $Utilisateur;
    private $UtilisateurRepository;

    private $SousCategorie;
    private $SousCategorieRepository;
    private $CategorieRepository;

    private $TypePieceJointeRepository;
    private $FavorisRepository;
    private $MessageError;


    public function __construct()
    {
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->Annonce = new Annonce();
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->AnnonceRepository = $this->getEntityManager()->getRepository("Annonce");
        $this->UtilisateurRepository = $this->getEntityManager()->getRepository("Utilisateur");
        $this->TypeAnnonceRepository = $this->getEntityManager()->getRepository("TypeAnnonce");
        $this->VilleRepository = $this->getEntityManager()->getRepository("Ville");
        $this->SousCategorieRepository = $this->getEntityManager()->getRepository("SousCategorie");
        $this->CategorieRepository = $this->getEntityManager()->getRepository("Categorie");
        $this->TypePieceJointeRepository = $this->getEntityManager()->getRepository("TypePieceJointe");

    }

    /**
     * Get Utilisateur Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getUtlisateurRepository()
    {
        return $this->UtilisateurRepository;
    }

    /**
     * Get Annonce Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getAnnonceRepository()
    {
        return $this->AnnonceRepository;
    }

    /**
     * Get Favoris Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getFavorisRepository()
    {
        return $this->FavorisRepository;
    }

    /**
     * Get TypeAnnonce Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getTypeAnnonceRepository()
    {
        return $this->TypeAnnonceRepository;
    }

    /**
     * Get Ville Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getVilleRepository()
    {
        return $this->VilleRepository;
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
     * Get Categorie repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getCategorieRepository()
    {
        return $this->CategorieRepository;
    }

    /**
     * Get TypePieceJointe.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getTypePieceJointeRepository()
    {
        return $this->TypePieceJointeRepository;
    }

    /**
     * Get profilUtilisateur repository.
     *
     * @return string
     */
    private function getMessageError()
    {
        return $this->MessageError;
    }

    /**
     * Set MessageError repository.
     *
     */
    private function setMessageError($messageError)
    {
        $this->MessageError = $messageError;
    }

    /**
     * Affiche la liste des Annonces
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionClient"))
        {
            $sessionClient = $this->requete->getSession()->getAttribut("sessionClient");
            $this->Annonce = $this->getAnnonceRepository()->findBy(array('Utilisateur' => $sessionClient->getIdUtilisateur()));
            $this->genererVue(array('Annonces' => $this->Annonce));
        }
        else
        {
            $this->rediriger("Accueil", "Index");
        }
    }

    /**
     * Affiche la liste des Annonces pour l'administrateur
     */
    public function ListeAnnonces()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $sessionAdmin = $this->requete->getSession()->getAttribut("sessionAdmin");
            $this->Annonce = $this->getAnnonceRepository()->findAll();
            $this->genererVue(array('Annonces' => $this->Annonce));
        }
        else
        {
            $this->rediriger("Accueil", "IndexAdmin");
        }
    }

    /**
     * Ajouter une nouvelle annonce
     */
    public function Ajouter()
    {
        //on vérifie que la session existe
        if ($this->requete->getSession()->existeAttribut("sessionClient")){
            if (!empty($_POST))
            {
                if ($this->requete->existeParametre("IdSousCategorie") && $this->requete->existeParametre("IdTypeAnnonce")
                    && $this->requete->existeParametre("IdVille") && $this->requete->existeParametre("Description")
                    && $this->requete->existeParametre("Titre"))
                {

                    $this->Annonce = new Annonce();
                    $this->Annonce->setDescription($this->requete->getParametre("Description"));
                    $this->Annonce->setTitre($this->requete->getParametre("Titre"));
                    $this->Annonce->setTelephone($this->requete->getParametre("Telephone"));
                    $this->Annonce->setDateCreation(new DateTime("now"));
                    $this->Annonce->setStatut(0);
                    $this->Annonce->setPrix(($this->requete->existeParametre("Prix"))? $this->requete->getParametre("Prix") : 0);
                    $this->Annonce->setLienVimeo(($this->requete->existeParametre("LienVimeo"))? $this->requete->getParametre("LienVimeo") : "");
                    $this->Annonce->setLienYoutube(($this->requete->existeParametre("LienYoutube"))? $this->requete->getParametre("LienYoutube") : "");
                    $this->Annonce->setAutre(($this->requete->existeParametre("Autre"))? $this->requete->getParametre("Autre") : "");

                    //sélection de la sous catégorie, la ville, le type d'annonce et de l'utilisateur
                    $this->SousCategorie = $this->getSousCategorieRepository()->findOneBy(array('IdSousCategorie' => $this->requete->getParametre("IdSousCategorie")));
                    $this->Ville = $this->getVilleRepository()->findOneBy(array('IdVille' => $this->requete->getParametre("IdVille")));
                    $this->TypeAnnonce = $this->getTypeAnnonceRepository()->findOneBy(array('IdTypeAnnonce' => $this->requete->getParametre("IdTypeAnnonce")));
                    $sessionClient = $this->requete->getSession()->getAttribut("sessionClient");
                    $this->Utilisateur = $this->getUtlisateurRepository()->findOneBy(array('IdUtilisateur' => $sessionClient->getIdUtilisateur()));

                    $this->Annonce->setSousCategorie($this->SousCategorie);
                    $this->Annonce->setVille($this->Ville);
                    $this->Annonce->setTypeAnnonce($this->TypeAnnonce);
                    $this->Annonce->setUtilisateur($this->Utilisateur);

                    $this->getEntityManager()->persist($this->Annonce);

                    $PieceJointe= $_FILES["PieceJointe"];

                    $this->EnregistrerPieceJointe($PieceJointe, PIECE_JOINTE_PRINCIPALE);

                    if ($_FILES['PieceJointeSecondaires'])
                    {
                        $PieceJointeSecondaires= $_FILES["PieceJointeSecondaires"];
                        $file_ary = $this->reArrayFiles($PieceJointeSecondaires);
                        $i=0;
                        foreach($file_ary as $val)
                        {
                            if ($i == 5)
                            {
                                break;
                            }
                            $this->EnregistrerPieceJointe($val, PIECE_JOINTE_ADDITIONNELLE);
                            $i = $i + 1;
                        }
                    }

                    /*      try {

                          } catch (\Exception $e) {
                              $msg = '### Message ### \n'.$e->getMessage().'\n### Trace ### \n'.$e->getTraceAsString();
                              echo $msg;
                              // Here put you logic now you now that the flush has failed and all subsequent flush will fail as well
                          }*/


                    // Sauvegarde de l'entité gérée
                    $this->getEntityManager()->flush();
                    $this->rediriger("Annonce", "Index");
                }
                else
                    throw new Exception("Action impossible : Une erreur est survenue durant le processus.");
            }
            //sélection des listes : sous catégorie, la ville, le type d'annonce et de l'utilisateur
            $SousCategorie = $this->getSousCategorieRepository()->findAll();
            $Ville = $this->getVilleRepository()->findAll();
            $TypeAnnonce = $this->getTypeAnnonceRepository()->findAll();
            $Utilisateur = $this->requete->getSession()->getAttribut("sessionClient");
            $this->genererVue(array('SousCategories' => $SousCategorie, 'Villes' => $Ville, 'TypeAnnonces' => $TypeAnnonce,
                "Utilisateur" => $Utilisateur));
        }
        else
        {
            $this->rediriger("Accueil", "Index");
        }


    }

    /**
     * quick function that would convert the $_FILES array to the cleaner (IMHO) array.
     *
     * @param Array $file_post
     *
     * @return array
     * @throws Exception S'il manque des données
     */
    private function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    /**
     * fonction utilisée pour enregistrer les pièces jointes
     *
     * @param FILE $laPhoto
     * @param long $IdTypePieceJointe
     *
     * @throws Exception S'il manque des données
     */
    private function EnregistrerPieceJointe($laPhoto, $IdTypePieceJointe)
    {


        if($laPhoto['error'] != UPLOAD_ERR_NO_FILE)
        {
            $laPieceJointe = new PieceJointe();
            $laPieceJointe->setUrl($this->UploadFile($laPhoto));
            $laPieceJointe->setLibelle($laPhoto['name']);
            $laPieceJointe->setAnnonce($this->Annonce);
            $laPieceJointe->setTypePieceJointe($this->getTypePieceJointeRepository()->findOneBy(array("IdTypePieceJointe" => $IdTypePieceJointe)));

            /*echo "Annonce: ".($this->Annonce->getTitre())."<br>";
            echo "Libelle: ".$laPieceJointe->getLibelle()."<br>";
            echo "Url: ".$laPieceJointe->getUrl()."<br>";
            echo "PieceAnnonce: ".$laPieceJointe->getAnnonce()->getTitre()."<br>";
            echo "Type PJ: ".$laPieceJointe->getTypePieceJointe()->getLibelle()."<br>";*/

            $this->getEntityManager()->persist($laPieceJointe);
        }
        else
        {
            throw new Exception("Action impossible : une erreur est survenue durant l'enregistrement de l'image.");
        }
    }

    /**
     * fonction utilisée pour uploader les fichiers
     * @param FILE $laPhoto
     *
     * @return string
     * @throws Exception S'il manque des données
     */
    private function UploadFile($laPhoto)
    {
        $cheminFinal="";
        //si l'image existe
        if ($laPhoto['error'] == UPLOAD_ERR_OK)
        {
            $infoFichier = pathinfo($laPhoto["name"]);
            $fileinfo = @getimagesize($laPhoto["tmp_name"]);
            $width = $fileinfo[0];
            $height = $fileinfo[1];


            // si la taille de l'image est strictement inférieure à 1M ou si l'image fait au plus 625 * 415 pixel alors on upload
            //avec 1048576 = 1024 * 1024 et 1024 B = 1KB et 1024 KB = 1 MB
            if ($laPhoto["size"] > MAX_SIZE_IMAGE * 1048576) {
                throw new Exception("Action impossible : ce fichier est volumineux. Veuillez vous rassurer qu'il n'excède pas 1 Mo.");
            }
            else if ($width > IMG_MAX_WIDTH || $height > IMG_MAX_HEIGHT) {
                throw new Exception("Action impossible : ce fichier est supérieur à la limite autorisée. Veuillez vous rassurer qu'il n'excède pas 625 x 415 px.");
            }
            else
            {
                $cheminFinal= CHEMIN_PIECE_JOINTE.uniqid().'.'. $infoFichier['extension'];
                move_uploaded_file($laPhoto["tmp_name"], $cheminFinal);
            }
        }
        else
        {
            throw new Exception("Action impossible : une erreur est survenue durant le processus.");
        }

        return $cheminFinal;
    }

    /**
     * fonction utilisée pour modifier les infos
     *
     * @param string $controleur
     * @param string $action
     *
     * @throws Exception S'il manque des données
     */
    private function UpdateData($controleur, $action)
    {
        if ($this->requete->getSession()->existeAttribut("sessionClient"))
        {
            if ($this->requete->existeParametre("IdSousCategorie") && $this->requete->existeParametre("IdTypeAnnonce")
                && $this->requete->existeParametre("IdVille") && $this->requete->existeParametre("Description")
                && $this->requete->existeParametre("Prix") && $this->requete->existeParametre("DateCreation")
                && $this->requete->existeParametre("PieceJointe") && $this->requete->existeParametre("Statut")
                && $this->requete->existeParametre("IdAnnonce") && $this->requete->existeParametre("Titre"))
            {
                $this->Annonce = $this->getAnnonceRepository()->findOneByIdAnnonce($this->requete->getParametre("IdAnnonce"));
                if ($this->Annonce == null) //si l'élément n'a pas été trouvé
                    throw new Exception("Action impossible : sous categorie non trouvée.");
                else
                {
                    //On récupère les valeurs envoyées par POST
                    $this->Annonce->setDescription($this->requete->getParametre("Description"));
                    $this->Annonce->setTitre($this->requete->getParametre("Titre"));
                    $this->Annonce->setPrix($this->requete->getParametre("Prix"));
                    $this->Annonce->setTelephone($this->requete->getParametre("Telephone"));
                    $this->Annonce->setLienVimeo($this->requete->getParametre("LienVimeo"));
                    $this->Annonce->setLienYoutube($this->requete->getParametre("LienYoutube"));
                    $this->Annonce->setAutre($this->requete->getParametre("Autre"));
                    $date= new DateTime($this->requete->getParametre("DateCreation"));
                    $this->Annonce->setDateCreation($date);
                    $this->Annonce->setStatut($this->requete->getParametre("Statut"));
                    $PieceJointe = $_FILES["PieceJointe"];

                    //sélection de la sous catégorie, la ville, le type d'annonce et de l'utilisateur
                    $this->SousCategorie = $this->getSousCategorieRepository()->findOneBy(array('IdSousCategorie' => $this->requete->getParametre("IdSousCategorie")));
                    $this->Ville = $this->getVilleRepository()->findOneBy(array('IdVille' => $this->requete->getParametre("IdVille")));
                    $this->TypeAnnonce = $this->getTypeAnnonceRepository()->findOneBy(array('IdTypeAnnonce' => $this->requete->getParametre("IdTypeAnnonce")));
                    $this->Utilisateur = $this->requete->getSession()->getAttribut("sessionClient");

                    //Modification eventuelle des valeurs des clés étrangères
                    $this->Annonce->setSousCategorie($this->SousCategorie);
                    $this->Annonce->setVille($this->Ville);
                    $this->Annonce->setTypeAnnonce($this->TypeAnnonce);
                    $sessionClient = $this->requete->getSession()->getAttribut("sessionClient");
                    $this->Utilisateur = $this->getUtlisateurRepository()->findOneBy(array('IdUtilisateur' => $sessionClient->getIdUtilisateur()));

                    // Sauvegarde de l'entité gérée
                    $this->getEntityManager()->flush();
                    $this->rediriger($controleur, $action); //Retour à la page index
                }
            }
            else
                throw new Exception("Action impossible : Tous les paramètres n'ont pas été envoyés.");
        }
        else{
            $this->rediriger("Accueil", "index");
        }
    }

    /**
     * Modifie les infos
     *
     * @throws Exception S'il manque des données
     */
    public function Modifier()
    {
        //$ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findAll();
        $this->setMessageError("");
        if (!empty($_POST) && $this->requete->getSession()->existeAttribut("sessionClient"))
        {
            $this->UpdateData("Annonce", "Index");
        }
        else
        {
            // vérifions si un identifiant a été envoyé
            if ($this->requete->existeParametre("id"))
            {
                // Récupération de l'annonce

                $this->Annonce = $this->getAnnonceRepository()->find($this->requete->getParametre("id"));
                if ($this->Annonce == null)
                    throw new Exception("Action impossible : sous catégorie non trouvée.");
                else
                {
                    //sélection des listes : sous catégorie, la ville, le type d'annonce et de l'utilisateur
                    $SousCategorie = $this->getSousCategorieRepository()->findAll($this->requete->existeParametre("IdSousCategorie"));
                    $Ville = $this->getVilleRepository()->findAll($this->requete->existeParametre("IdVille"));
                    $TypeAnnonce = $this->getTypeAnnonceRepository()->findAll($this->requete->existeParametre("IdTypeAnnonce"));
                    $Utilisateur = $this->requete->getSession()->getAttribut("sessionClient");
                    $this->genererVue(array('Annonce' => $this->Annonce, 'SousCategorie' => $SousCategorie,
                        'Ville' => $Ville, 'TypeAnnonce' => $TypeAnnonce, "Utilisateur" => $Utilisateur), "Modifier");
                }
            }
        }

    }

    /**
     * Detailler les infos sur l'annonce
     *
     * @throws Exception S'il manque des données
     */
    public function Detailler()
    {
        // récupération de l'entité Utilisateur d'identifiant x dans la base
        if ($this->requete->existeParametre("id"))
        {
            // Récupération de l'utilisateur
            $IdAnnonce = $this->requete->getParametre("id");
            $Annonce = $this->getAnnonceRepository()->find($IdAnnonce);
            if ($Annonce == null)
                throw new Exception("Action impossible : utilisateur non trouvé.");
            else
            {
                $this->genererVue(array('Annonce' => $Annonce), "Detailler");
            }
        }
    }


    /**
     * Marquer une annonce comme favorite
     *
     * @throws Exception S'il manque des données
     */
    public function Favoris()
    {
        // vérifions si un identifiant a été envoyé
        if ($this->requete->existeParametre("id") && $this->requete->getSession()->existeAttribut("sessionClient"))
        {
            // Récupération de l'annonce
            $this->Annonce = $this->getAnnonceRepository()->findOneBy(array('IdAnnonce' => $this->requete->getParametre("id")));
            if ($this->Annonce == null)
                throw new Exception("Action impossible : sous catégorie non trouvée.");
            else
            {
                $sessionClient = $this->requete->getSession()->getAttribut("sessionClient");
                $this->Utilisateur = $this->getUtlisateurRepository()->findOneBy(array('IdUtilisateur' => $sessionClient->getIdUtilisateur()));

                $this->FavorisRepository = $this->getEntityManager()->getRepository("Favoris");
                $Favoris = $this->FavorisRepository->findBy(array('Utilisateur' => $sessionClient->getIdUtilisateur(),
                    'Annonce' => $this->Annonce->getIdAnnonce()));

                if ($Favoris == null)
                {
                    $Favoris = new Favoris();
                    $Favoris->setAnnonce($this->Annonce);
                    $Favoris->setUtilisateur($this->Utilisateur);

                    $Favoris->setDateAjout(new DateTime("now"));


                    $this->getEntityManager()->persist($Favoris);
                    $this->getEntityManager()->flush();
                    $this->rediriger("Annonce", "Favoris");
                }
                else
                {
                    $this->rediriger("Annonce", "Favoris");
                }
            }
        }
        elseif ($this->requete->getSession()->existeAttribut("sessionClient"))
        {
            $Utilisateur = $this->requete->getSession()->getAttribut("sessionClient");
            $this->FavorisRepository = $this->getEntityManager()->getRepository("Favoris");
            $Favoris = $this->FavorisRepository->findBy(array('Utilisateur' => $Utilisateur->getIdUtilisateur()));
            $this->genererVue(array('Favoris' => $Favoris));
        }
        else
        {
            throw new Exception("Action impossible : une erreur est survenue durant le traitement.");
        }

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
     * Permettre à un admin de bloquer une annonce
     *
     * @throws Exception S'il manque des données
     */
    public function Bloquer()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            //$ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findAll();
            $this->setMessageError("");
            if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
            {
                // vérifions si un identifiant a été envoyé
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de l'annonce
                    $this->Annonce = $this->getAnnonceRepository()->find($this->requete->getParametre("id"));
                    if ($this->Annonce == null)
                        throw new Exception("Action impossible : sous catégorie non trouvée.");
                    else
                    {
                        $this->Annonce->setStatut(-1);
                        // Sauvegarde de l'entité gérée
                        $this->getEntityManager()->flush();
                        $this->rediriger("Annonce", "ListeAnnonces"); //Retour à la page index
                    }
                }
            }
            else{
                $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

}