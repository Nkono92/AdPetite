<?php
require_once 'ControleurPersonnalise.php';
require_once 'App_Code/Constantes.php';
require_once 'App_Code/RecupererPaiementPaypal.php';
require_once 'Modeles/Paiement.php';
require_once 'Modeles/Annonce.php';
require_once 'Modeles/TypeAnnonce.php';
require_once 'Modeles/SousCategorie.php';
require_once 'Modeles/Categorie.php';
require_once 'Modeles/ModePaiement.php';
require_once 'Modeles/TarifImage.php';
require_once 'Modeles/TarifTexte.php';
require_once 'Modeles/Departement.php';
require_once 'Modeles/Pays.php';
require_once 'Modeles/Ville.php';
require_once 'Modeles/PieceJointe.php';
require_once 'Modeles/Utilisateur.php';
require_once 'Modeles/TypePieceJointe.php';
require_once 'Modeles/ProfilUtilisateur.php';




/**
 * Contrôleur des actions liées aux paiements
 *
 */


class ControleurPaiement extends ControleurPersonnalise
{
    private $Annonce;
    private $AnnonceRepository;

    private $PieceJointeRepository;

    private $Paiement;
    private $PaiementRepository;

    private $TarifImage;
    private $TarifImageRepository;

    private $TarifTexte;
    private $TarifTexteRepository;

    private $Utilisateur;
    private $UtilisateurRepository;

    private $SousCategorie;
    private $SousCategorieRepository;

    private $ModePaiement;
    private $ModePaiementRepository;

    private $TypePieceJointeRepository;
    private $MessageError;
    private $formatter;

    public function __construct()
    {
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->PaiementRepository = $this->getEntityManager()->getRepository("Paiement");
        $this->AnnonceRepository = $this->getEntityManager()->getRepository("Annonce");
        $this->TarifImageRepository = $this->getEntityManager()->getRepository("TarifImage");
        $this->TarifTexteRepository = $this->getEntityManager()->getRepository("TarifTexte");
        $this->ModePaiementRepository = $this->getEntityManager()->getRepository("ModePaiement");
        $this->formatter = new NumberFormatter("fr-FR", NumberFormatter::CURRENCY);

    }

    /**
     * Get Paiement Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getPaiementRepository()
    {
        return $this->PaiementRepository;
    }

    /**
     * Get PieceJointe Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getPieceJointeRepository()
    {
        return $this->PieceJointeRepository;
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
     * Get TarifImage Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getTarifImageRepository()
    {
        return $this->TarifImageRepository;
    }

    /**
     * Get TarifTexte Repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getTarifTexteRepository()
    {
        return $this->TarifTexteRepository;
    }

    /**
     * Get sousModePaiement repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getSousCategorieRepository()
    {
        return $this->SousCategorieRepository;
    }

    /**
     * Get ModePaiement repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getModePaiementRepository()
    {
        return $this->ModePaiementRepository;
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
     * déterminer le taux de facturation pour le texte
     *
     * @return TarifTexte
     */
    private function determinerTarifTexte($nombreMotAnnonce)
    {
        $TarifTexte = $this->getTarifTexteRepository()->findAll();
        foreach ($TarifTexte as $tarif)
        {
            if ($tarif->getBorneInf() <= $nombreMotAnnonce && $nombreMotAnnonce <= $tarif->getBorneSup())
            {
                return $tarif;
            }
        }
        return new TarifTexte();
    }

    /**
     * déterminer le taux de facturation pour les images
     *
     * @return TarifImage
     */
    private function determinerTarifImage($nombreImages)
    {
        $TarifImage = $this->getTarifImageRepository()->findAll();
        foreach ($TarifImage as $tarif)
        {
            if ($tarif->getBorneInf() <= $nombreImages && $nombreImages <= $tarif->getBorneSup())
            {
                return $tarif;
            }
        }
        return new TarifImage();
    }

    /**
     * Affiche la liste des Annonces
     *
     * @throws Exception S'il manque des données

     */
    public function index()
    {
        // on vérifie si l'identifiant de l'annonce a été envoyée.
        if ($this->requete->existeParametre("id"))
        {
            $this->Annonce = $this->getAnnonceRepository()->findOneBy(array('IdAnnonce' => $this->requete->getParametre("id")));
            if ($this->Annonce == null)
                throw new Exception("Action impossible : annonce non trouvée.");
            else
            {
                $this->Paiement = new Paiement();
                $this->Paiement->setReference('PAY-'.strtoupper(uniqid()).'/'.(new DateTime("now"))->format('Ymd'));

                //calcul du nombre d'images pour l'annonce
                $nombreImages = count($this->Annonce->getLesPiecesJointes());

                //Calcul du nombre de mots de l'annonce
                $nombreMotAnnonce = str_word_count($this->Annonce->getDescription()) + str_word_count($this->Annonce->getAutre());

                $this->Paiement->setTarifImage($this->determinerTarifImage($nombreImages));
                $this->Paiement->setTarifTexte($this->determinerTarifTexte($nombreMotAnnonce));
                $this->Paiement->setMontantTarifImage($this->Paiement->getTarifImage()->getMontant());
                $this->Paiement->setMontantTarifTexte($this->Paiement->getTarifTexte()->getMontant());
                $this->Paiement->setAnnonce($this->Annonce);
                $this->Paiement->setStatutPaiement(0);
                $this->Paiement->setModePaiement($this->getModePaiementRepository()->findOneBy(array('IdModePaiement' => PAYPAL_ID )));


                $sousTotal = $this->Paiement->getMontantTarifImage() + $this->Paiement->getMontantTarifTexte();
                $taxe = POUCENTAGE_TAXE * $sousTotal;
                $montantTotal = $taxe + $sousTotal;
                $this->Paiement->setMontantTotal($montantTotal);
                $this->requete->getSession()->setAttribut("Paiement", serialize($this->Paiement));

                $this->genererVue(array('Paiement' => $this->Paiement, "nombreImagesAnnonce" => $nombreImages, "nombreMotAnnonce" => $nombreMotAnnonce,
                    'montantTotal' => $montantTotal, 'sousTotal' => $sousTotal, 'taxe' => $taxe, 'formatter' => $this->formatter),
                    "index");
            }
        }
        else
        {
            $this->rediriger("Accueil", "index");
            //throw new Exception("Action impossible : veuillez renseigner l'annonce pour laquelle le paiement sera effectué.");
        }
    }

    /**
     * Paiement réalisé avec succès
     *
     * @throws Exception S'il manque des données
     */
    public function PrevalidationPaiement()
    {
        $paiementSession = unserialize($this->requete->getSession()->getAttribut("Paiement"));
        //echo "TEST";
        //print_r ($paiementSession);
        //$Utilisateur = $this->getUtilisateurRepository()->find($paiementSession->getIdUtilisateur());
        if ($this->requete->existeParametre("id"))
        {
            $orderID = $this->requete->getParametre("id");
            $this->requete->getSession()->setAttribut("orderID", $orderID);

            $paiementSession->setStatutPaiement(1);
            $paiementSession->setDatePaiement(new DateTime("now"));
            $libelle = 'ANN-'.$paiementSession->getAnnonce()->getIdAnnonce().'-|-'.RecupererPaiementPaypal::getOrder($orderID);
            $paiementSession->setLibelle($libelle);
            $this->getEntityManager()->merge($paiementSession);

            //modification du statut de l'annonce (statut validée)
            $Annonce= $this->getAnnonceRepository()->findOneBy(array('IdAnnonce' => $paiementSession->getAnnonce()->getIdAnnonce()));
            $Annonce->setStatut(1);

            // Sauvegarde de l'entité gérée
            try
            {
                //on sauvegarde
                $this->getEntityManager()->flush();
                $this->requete->getSession()->detruireSession('Paiement');
                $this->requete->getSession()->detruireSession('orderID');
                $this->rediriger("Paiement","PaiementValide");
            }catch (\Exception $e)
            {
                $this->setMessageError( '### Message ### \n'.$e->getMessage().'\n### Trace ### \n'.$e->getTraceAsString());
                //echo $msg;
                //$this->rediriger("Paiement","EchecPaiement");
                $this->genererVue(array('message' => $this->getMessageError()), 'EchecPaiement');

            }
        }
        $this->genererVue(array('IdAnnonce' => $paiementSession->getAnnonce()->getIdAnnonce()), 'index');

    }

    /**
     * Paiement réalisé avec succès
     *
     */
    public function PaiementValide()
    {
        $this->genererVue();
    }


    /**
     * Paiement échoué
     *
     */
    public function EchecPaiement()
    {
        $this->genererVue(array('message' => $this->getMessageError()), 'EchecPaiement');
    }

    /**
     * Mes Paiements
     *
     */
    public function MesPaiement()
    {

        //on vérifie que la session existe
        if ($this->requete->getSession()->existeAttribut("sessionClient")){
            $sessionClient = $this->requete->getSession()->getAttribut("sessionClient");
            // création du constructeur de requête
            $queryBuilder = $this->getEntityManager()->createQueryBuilder();

            // construction de la requête
            $queryBuilder->select('P')          // commande SELECT
            ->from('Paiement', 'P')           // clause FROM
            ->innerJoin('Annonce', 'A', 'WITH', 'A = P.Annonce') // jointure
            ->innerJoin('Utilisateur', 'U', 'WITH', 'U = A.Utilisateur') // jointure
            ->where('A.Utilisateur >= :limite_inf') // clause WHERE, avec paramètre nommé
            ->orderBy('P.DatePaiement', 'DESC')       // clause ORDER BY
            ->setParameter('limite_inf', $sessionClient->getIdUtilisateur());

            // instanciation/préparation de la requête
            $query = $queryBuilder->getQuery();

            // exécution de la requête
            $Paiement = $query->execute();
            $this->genererVue(array('Paiements' => $Paiement, 'formatter' => $this->formatter));
        }
        else
        {
            $this->rediriger("Accueil", "Index");
        }
    }

}