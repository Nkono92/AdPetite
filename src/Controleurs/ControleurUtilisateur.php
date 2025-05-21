<?php
require_once 'ControleurPersonnalise.php';
require_once 'Modeles/Utilisateur.php';
require_once 'Modeles/ProfilUtilisateur.php';
require_once 'App_Code/Constantes.php';
require_once 'App_Code/Password.php';


/**
 * Contrôleur des actions liées au Utilisateur
 *
 */
class ControleurUtilisateur extends ControleurPersonnalise
{
    private $Utilisateur;
    private $UtilisateurRepository;
    private $ProfilUtilisateurRepository;
    private $MessageError;

    public function __construct()
    {
        $this->Utilisateur = new Utilisateur();
        $this->path= realpath(dirname(__FILE__) . '/../..').'\\';
        $this->entityManager= require_once join(DIRECTORY_SEPARATOR, [$this->path, 'bootstrap.php']);
        $this->UtilisateurRepository = $this->getEntityManager()->getRepository("Utilisateur");
        $this->ProfilUtilisateurRepository = $this->getEntityManager()->getRepository("ProfilUtilisateur");
        $this->setMessageError("");

    }

    /**
     * Get utilisateur repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getUtilisateurRepository()
    {
        return $this->UtilisateurRepository;
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
     * Get profilUtilisateur repository.
     *
     * @return \Doctrine\ORM\Repository
     */
    private function getProfilUtilisateurRepository()
    {
        return $this->ProfilUtilisateurRepository;
    }

    /**
     * Affiche la liste des utilisateur
     */
    public function index()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $this->Utilisateur = $this->getUtilisateurRepository()->findBy(array("Statut" => 1, "ProfilUtilisateur" => CLIENT_PROFILE_CODE));
            $this->genererVue(array('utilisateurs' => $this->Utilisateur));
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

    /**
     * Affiche la liste des utilisateur
     */
    public function indexAdmin()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            $this->Utilisateur = $this->getUtilisateurRepository()->findBy(array("Statut" => 1, "ProfilUtilisateur" => ADMIN_PROFILE_CODE));
            $this->genererVue(array('utilisateurs' => $this->Utilisateur));
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }


    /**
     * Permet de se connecter au système en tant que administrateur
     */
    public function LoginAdmin()
    {
        $this->requete->getSession()->setAttribut("Layout", "Layout.php");
        $this->setMessageError("");
        if (!empty($_POST))
        {
            if ($this->requete->existeParametre("Login") && $this->requete->existeParametre("MotDePasse"))
            {
                $motDePasse = $this->requete->getParametre("MotDePasse");
                $login = $this->requete->getParametre("Login");
                $utilisateur = $this->getUtilisateurRepository()->findOneBy(array("Email" => $login));

                if ($utilisateur == null) {
                    $this->setMessageError("Action impossible : Compte inexistant.");
                }
                elseif ($utilisateur->getProfilUtilisateur()->getIdProfilUtilisateur() != ADMIN_PROFILE_CODE) {
                    $this->setMessageError("Action impossible : Email et (ou) mot de passe invalide(s).");
                }
                else {

                    //Comparaison des deux mots de passe
                    $motDePasseValide = password_verifier($motDePasse, $utilisateur->getMotDePasse());

                    if ($motDePasseValide)
                    {
                        $this->accueillirUtilisateur($utilisateur);
                    }
                    else
                    {
                        $this->setMessageError("Action impossible : Email et (ou) mot de passe invalide(s).");
                    }
                }
            }
            else
                $this->setMessageError("Action impossible : Veuillez renseigner tous les paramètres (Email et mot de passe).");
        }
        $this->genererVue(array('MessageError' => $this->getMessageError()));

    }


    /**
     * Permet de se connecter au système en tant que client
     */
    public function Login()
    {
        $this->requete->getSession()->setAttribut("Layout", "LayoutFront.php");
        $this->setMessageError("");
        if (!empty($_POST))
        {
            if ($this->requete->existeParametre("Login") && $this->requete->existeParametre("MotDePasse"))
            {
                $motDePasse = $this->requete->getParametre("MotDePasse");
                $login = $this->requete->getParametre("Login");
                $client = $this->getUtilisateurRepository()->findOneBy(array("Email" => $login));

                if ($client == null) {
                    $this->setMessageError("Action impossible : Compte inexistant.");
                }
                elseif ($client->getProfilUtilisateur()->getIdProfilUtilisateur() != CLIENT_PROFILE_CODE) {
                    $this->setMessageError("Action impossible : Email et (ou) mot de passe invalide(s).");
                }
                else {

                    //Comparaison des deux mots de passe
                    $motDePasseValide = password_verifier($motDePasse, $client->getMotDePasse());

                    if ($motDePasseValide)
                    {
                        $this->accueillirUtilisateur($client);
                    }
                    else
                    {
                        $this->setMessageError("Action impossible : Email et (ou) mot de passe invalide(s).");
                    }
                }
            }
            else
                $this->setMessageError("Action impossible : Veuillez renseigner tous les paramètres (Email et mot de passe).");
        }
        $this->genererVue(array('MessageError' => $this->getMessageError()));

    }


    /**
     * Méthode privée permettant de vérifier si l'email de l'utilisateur existe déjà en base de données
     *
     *@param string $email
     *
     * @return boolean
     */
    private function emailExiste($email)
    {
        $utilisateur = $this->getUtilisateurRepository()->findOneBy(array("Email" => $email));
        if ($utilisateur == null)
            return false;
        return true;
    }

    /**
     * Inscription des clients
     *
     * @throws Exception S'il manque des données
     */
    public function Register()
    {
        $this->setMessageError("");
        if (!empty($_POST))
        {
            if ($this->requete->existeParametre("Nom") && $this->requete->existeParametre("Prenom")
                && $this->requete->existeParametre("Telephone")  && $this->requete->existeParametre("Email")
                && $this->requete->existeParametre("MotDePasse") && $this->requete->existeParametre("MotDePasseConfirmation"))
            {
                $motDePasse = $this->requete->getParametre("MotDePasse");
                $motDePasseConfirmation = $this->requete->getParametre("MotDePasseConfirmation");
                if(preg_match(PASSWORD_REGEX_CONSTITUTION, $motDePasse)) {
                    if (strcasecmp($motDePasse, $motDePasseConfirmation) == 0) {
                        $motDePasseHash = password_hasher($motDePasse, PASSWORD_BCRYPTO, array("cost" => HASHING_COST_VALUE));
                        $email = $this->requete->getParametre("Email");

                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            if ($this->emailExiste($email)) {
                                $this->setMessageError("Action impossible : L'adresse email saisie existe déjà, veuillez la changer.");
                            } else {
                                $photoProfil = $_FILES["PhotoProfil"];

                                $utilisateur = new Utilisateur();
                                $utilisateur->setNom($this->requete->getParametre("Nom"));
                                $utilisateur->setPrenom($this->requete->getParametre("Prenom"));
                                $utilisateur->setEmail($email);
                                $utilisateur->setTelephone($this->requete->getParametre("Telephone"));
                                $utilisateur->setMotDePasse($motDePasseHash);
                                $utilisateur->setDateInscription(new DateTime("now"));
                                $utilisateur->setStatut(1);
                                $utilisateur->setRue($this->requete->getParametre("Rue"));
                                $utilisateur->setBoitePostale($this->requete->getParametre("BoitePostale"));
                                //echo 'Bonjour \n'.$utilisateur->getPhotoProfil();

                                if ($photoProfil['error'] != UPLOAD_ERR_NO_FILE) {
                                    $utilisateur->setPhotoProfil($this->UploadFile($photoProfil));
                                } else {
                                    $utilisateur->setPhotoProfil(CHEMIN_PHOTO_PROFIL . DEFAULT_PP);
                                }


                                //sélection du profilUtilisateur
                                $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findOneby(array("Libelle" => CLIENT_PROFILE_LABEL));

                                $utilisateur->setProfilUtilisateur($ProfilUtilisateur);

                                $this->getEntityManager()->persist($utilisateur);

                                // Sauvegarde de l'entité gérée
                                $this->getEntityManager()->flush();

                                header('Location: Login');
                            }
                        } else {
                            $this->setMessageError("Action impossible : L'adresse email saisie ne correspond pas au format exigé (Ex: abc@xyz.om ; abc.def@xyz.oms; abc_def@xyz.om).");
                        }

                    }
                    else {
                        $this->setMessageError("Action impossible : Le mot de passe et le mot de passe de confirmation ne correspondent pas. Veuillez les saisir de nouveau.");
                        //$this->genererVue(array('MessageError' => $this->getMessageError()));
                    }
                }
                else
                {
                    $this->setMessageError("Action impossible : Le mot de passe doit avoir au moins 8 caractères, être consituté de majuscules, de minuscules et de caractères spéciaux.");
                }
            }
            else
                throw new Exception("Action impossible : Une erreur est survenue durant le processus.");
        } //else {
        //$this->genererVue(array('ProfilUtilisateur' => $ProfilUtilisateur, 'MessageError' => $this->getMessageError()));
        //}
        $this->genererVue(array('MessageError' => $this->getMessageError()));

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
                if ($this->requete->existeParametre("Nom") && $this->requete->existeParametre("Prenom")
                    && $this->requete->existeParametre("Telephone")  && $this->requete->existeParametre("Email")
                    && $this->requete->existeParametre("MotDePasse") && $this->requete->existeParametre("MotDePasseConfirmation"))
                {
                    $motDePasse = $this->requete->getParametre("MotDePasse");
                    $motDePasseConfirmation = $this->requete->getParametre("MotDePasseConfirmation");
                    if(preg_match(PASSWORD_REGEX_CONSTITUTION, $motDePasse)) {
                        if (strcasecmp($motDePasse, $motDePasseConfirmation) == 0) {
                            $motDePasseHash = password_hasher($motDePasse, PASSWORD_BCRYPTO, array("cost" => HASHING_COST_VALUE));
                            $email = $this->requete->getParametre("Email");

                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                if ($this->emailExiste($email)) {
                                    $this->setMessageError("Action impossible : L'adresse email saisie existe déjà, veuillez la changer.");
                                } else {
                                    $photoProfil = $_FILES["PhotoProfil"];

                                    $utilisateur = new Utilisateur();
                                    $utilisateur->setNom($this->requete->getParametre("Nom"));
                                    $utilisateur->setPrenom($this->requete->getParametre("Prenom"));
                                    $utilisateur->setEmail($email);
                                    $utilisateur->setTelephone($this->requete->getParametre("Telephone"));
                                    $utilisateur->setMotDePasse($motDePasseHash);
                                    $utilisateur->setDateInscription(new DateTime("now"));
                                    $utilisateur->setStatut(1);
                                    $utilisateur->setRue($this->requete->getParametre("Rue"));
                                    $utilisateur->setBoitePostale($this->requete->getParametre("BoitePostale"));
                                    //echo 'Bonjour \n'.$utilisateur->getPhotoProfil();

                                    if ($photoProfil['error'] != UPLOAD_ERR_NO_FILE) {
                                        $utilisateur->setPhotoProfil($this->UploadFile($photoProfil));
                                    } else {
                                        $utilisateur->setPhotoProfil(CHEMIN_PHOTO_PROFIL . DEFAULT_PP);
                                    }

                                    //sélection du profilUtilisateur
                                    $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findOneBy(array("Libelle" => ADMIN_PROFILE_LABEL));
                                    $utilisateur->setProfilUtilisateur($ProfilUtilisateur);

                                    $this->getEntityManager()->persist($utilisateur);

                                    // Sauvegarde de l'entité gérée
                                    $this->getEntityManager()->flush();

                                    header('Location: indexAdmin');
                                }
                            } else {
                                $this->setMessageError("Action impossible : L'adresse email saisie ne correspond pas au format exigé (Ex: abc@xyz.om ; abc.def@xyz.oms; abc_def@xyz.om).");
                            }

                        }
                        else {
                            $this->setMessageError("Action impossible : Le mot de passe et le mot de passe de confirmation ne correspondent pas. Veuillez les saisir de nouveau.");
                            //$this->genererVue(array('MessageError' => $this->getMessageError()));
                        }
                    }
                    else
                    {
                        $this->setMessageError("Action impossible : Le mot de passe doit avoir au moins 8 caractères, être consituté de majuscules, de minuscules et de caractères spéciaux.");
                    }
                }
                else
                    throw new Exception("Action impossible : Une erreur est survenue durant le processus.");
            } //else {
            //$this->genererVue(array('ProfilUtilisateur' => $ProfilUtilisateur, 'MessageError' => $this->getMessageError()));
            //}
            $this->genererVue(array('MessageError' => $this->getMessageError()));
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }


    /**
     * fonction utilisée pour uploader les fichiers
     * @param FILE $_photoProfil
     *
     * @return string
     * @throws Exception S'il manque des données
     */
    private function UploadFile($_photoProfil)
    {
        $cheminFinal="";
        // si la taille de l'image est strictement inférieure à 1M on poursuit l'opération
        if ($_photoProfil["size"] < MAX_SIZE_IMAGE * 1048576) { //avec 1048576 = 1024 * 1024 et 1024 B = 1KB et 1024 KB = 1 MB
            if ($_photoProfil['error'] == UPLOAD_ERR_OK) {
                $infoFichier = pathinfo($_photoProfil["name"]);
                $cheminFinal= CHEMIN_PHOTO_PROFIL.uniqid().'.'. $infoFichier['extension'];
                move_uploaded_file($_photoProfil["tmp_name"], $cheminFinal);
            }
            else{
                throw new Exception("Action impossible : une erreur est survenue durant le processus.");
            }
        }
        else
        {
            throw new Exception("Action impossible : ce fichier est volumineux. Veuillez vous rassurer qu'il n'excède pas 1 Mo.");
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
        if ($this->requete->existeParametre("Nom") && $this->requete->existeParametre("Prenom")
            && $this->requete->existeParametre("Telephone")  && $this->requete->existeParametre("Email")
            && $this->requete->existeParametre("MotDePasse") && $this->requete->existeParametre("MotDePasseConfirmation")
            && $this->requete->existeParametre("IdProfilUtilisateur") && $this->requete->existeParametre("Statut")
            && $this->requete->existeParametre("DateInscription") && $this->requete->existeParametre("IdProfilUtilisateur"))
        {
            $motDePasse = $this->requete->getParametre("MotDePasse");
            $motDePasseConfirmation = $this->requete->getParametre("MotDePasseConfirmation");

            if(preg_match(PASSWORD_REGEX_CONSTITUTION, $motDePasse))
            {

                if (strcmp($motDePasse, $motDePasseConfirmation) == 0)
                {
                    $motDePasseHash = password_hasher($motDePasse, PASSWORD_BCRYPTO, array("cost" => HASHING_COST_VALUE));
                    $email = $this->requete->getParametre("Email");
                    $ancienEmail = $this->requete->getParametre("AncienEmail");

                    //On vérifie que l'adresse email est correcte
                    if (filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        //si l'adresse email existe déjà et qu'elle est différente de l'ancienne email de l'utilisateur alors on arrête le processus.
                        if ($this->emailExiste($email) && strcmp($ancienEmail, $email) !== 0)
                        {
                            $this->setMessageError("Action impossible : L'adresse email saisie existe déjà, veuillez la changer.");
                        }
                        else
                        {
                            //$photoProfil = $_FILES[$this->requete->getParametre("PhotoProfil")];
                            $photoProfil = $_FILES["PhotoProfil"];

                            $Utilisateur = $this->getUtilisateurRepository()->find($this->requete->getParametre("IdUtilisateur"));
                            if ($Utilisateur == null) //si l'élément n'a pas été trouvé
                                throw new Exception("Action impossible : utilisateur non trouvé.");
                            else
                            {
                                $Utilisateur->setNom($this->requete->getParametre("Nom"));
                                $Utilisateur->setPrenom($this->requete->getParametre("Prenom"));
                                $Utilisateur->setEmail($email);
                                $Utilisateur->setTelephone($this->requete->getParametre("Telephone"));
                                $Utilisateur->setMotDePasse($motDePasseHash);
                                $Utilisateur->setStatut(1);
                                $Utilisateur->setRue($this->requete->getParametre("Rue"));
                                $Utilisateur->setBoitePostale($this->requete->getParametre("BoitePostale"));
                                $Utilisateur->setStatut($this->requete->getParametre("Statut"));
                                $date= new DateTime($this->requete->getParametre("DateInscription"));
                                $Utilisateur->setDateInscription($date);

                                if($photoProfil['error'] != UPLOAD_ERR_NO_FILE)
                                {
                                    $Utilisateur->setPhotoProfil($this->UploadFile($photoProfil));
                                }
                                else
                                {
                                    $Utilisateur->setPhotoProfil(CHEMIN_PHOTO_PROFIL.DEFAULT_PP);
                                }

                                //Modification du code
                                $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->find($this->requete->getParametre("IdProfilUtilisateur"));
                                $Utilisateur->setProfilUtilisateur($ProfilUtilisateur);

                                // Sauvegarde de l'entité gérée
                                $this->getEntityManager()->flush();
                                $this->rediriger($controleur, $action);   //header('Location: index'); //Retour à la page index
                            }
                        }
                    }
                    else
                    {
                        $this->setMessageError("Action impossible : L'adresse email saisie ne correspond pas au format exigé (Ex: abc@xyz.om ; abc.def@xyz.oms; abc_def@xyz.om).");
                    }
                }
                else
                {
                    $this->setMessageError("Action impossible : Le mot de passe et le mot de passe de confirmation ne correspondent pas. Veuillez les saisir de nouveau.");
                }
            }
            else
            {
                $this->setMessageError("Action impossible : Le mot de passe doit avoir au moins 8 caractères, être consituté de majuscules, de minuscules et de caractères spéciaux.");
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
            $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findAll();
            $this->setMessageError("");
            if (!empty($_POST))
            {
                $this->UpdateData("Utilisateur", "indexAdmin");
            }
            else
            {
                // récupération de l'entité Utilisateur d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de l'utilisateur
                    $IdUtilisateur = $this->requete->getParametre("id");
                    //$UtilisateurRepository = $this->getEntityManager()->getRepository("Utilisateur");
                    $Utilisateur = $this->getUtilisateurRepository()->find($IdUtilisateur);
                    if ($Utilisateur == null)
                        throw new Exception("Action impossible : utilisateur non trouvé.");
                    else
                    {
                        $this->genererVue(array('Utilisateur' => $Utilisateur), "Modifier");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

    /**
     * Visualiser le pofile client et procéder à une éventuelle modification des infos
     *
     * @throws Exception S'il manque des données
     */
    public function Profile()
    {
        if ($this->requete->getSession()->existeAttribut("sessionClient"))
        {
            $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findAll();
            $this->setMessageError("");
            if (!empty($_POST))
            {
                $this->UpdateData("Utilisateur", "Profile");
            }
            else
            {
                // récupération de l'entité Utilisateur d'identifiant x dans la base
                if ($this->requete->getSession()->existeAttribut("sessionClient"))
                {
                    // Récupération de la session
                    $sessionClient = $this->requete->getSession()->getAttribut("sessionClient");
                    $Utilisateur = $this->getUtilisateurRepository()->find($sessionClient->getIdUtilisateur());
                    if ($Utilisateur == null)
                        throw new Exception("Action impossible : utilisateur non trouvé.");
                    else
                    {
                        $this->genererVue(array('Utilisateur' => $Utilisateur), "Profile");
                    }
                }
            }
        }
        else{
            $this->rediriger("Accueil", "index"); //Retour à la page de connexion
        }
    }


    /**
     * fonction utilisée pour modifier les infos
     *
     * @throws Exception S'il manque des données
     */
    private function DeleteData()
    {
        if ($this->requete->existeParametre("IdUtilisateur"))
        {
            //On récupère les valeurs envoyées par POST
            $IdUtilisateur = $this->requete->getParametre("IdUtilisateur");

            // récupération de l'entité Utilisateur d'identifiant $IdUtilisateur dans la base
            //$UtilisateurRepository = $this->getEntityManager()->getRepository("Utilisateur");
            $Utilisateur = $this->getUtilisateurRepository()->find($IdUtilisateur);
            if ($Utilisateur == null) //si l'élément n'a pas été trouvé
                throw new Exception("Action impossible : utilisateur non trouvé.");
            else
            {
                //Suppression de l'objet
                $Utilisateur->setStatut(-1);
                //$this->getEntityManager()->remove($Utilisateur);

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
     * Masquer les infos
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
                // récupération de l'entité Utilisateur d'identifiant x dans la base
                if ($this->requete->existeParametre("id"))
                {
                    // Récupération de l'utilisateur
                    $IdUtilisateur = $this->requete->getParametre("id");
                    //$UtilisateurRepository = $this->getEntityManager()->getRepository("Utilisateur");
                    $Utilisateur = $this->getUtilisateurRepository()->find($IdUtilisateur);
                    if ($Utilisateur == null)
                        throw new Exception("Action impossible : utilisateur non trouvé.");
                    else
                    {
                        $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findAll();
                        $this->genererVue(array('Utilisateur' => $Utilisateur, 'ProfilUtilisateur' => $ProfilUtilisateur), "Supprimer");
                    }
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }

    /**
     * Detailler les infos
     *
     * @throws Exception S'il manque des données
     */
    public function Detailler()
    {
        if ($this->requete->getSession()->existeAttribut("sessionAdmin"))
        {
            // récupération de l'entité Utilisateur d'identifiant x dans la base
            if ($this->requete->existeParametre("id"))
            {
                // Récupération de l'utilisateur
                $IdUtilisateur = $this->requete->getParametre("id");
                //$UtilisateurRepository = $this->getEntityManager()->getRepository("Utilisateur");
                $Utilisateur = $this->getUtilisateurRepository()->find($IdUtilisateur);
                if ($Utilisateur == null)
                    throw new Exception("Action impossible : utilisateur non trouvé.");
                else
                {
                    $ProfilUtilisateur = $this->getProfilUtilisateurRepository()->findAll();
                    $this->genererVue(array('Utilisateur' => $Utilisateur, 'ProfilUtilisateur' => $ProfilUtilisateur), "Detailler");
                }
            }
        }
        else{
            $this->rediriger("Utilisateur", "LoginAdmin"); //Retour à la page de connexion
        }
    }


    /**
     * Enregistre un client connecté dans la session et redirige vers la page d'accueil
     *
     * @param type $courriel
     * @param type $mdp
     */
    private function accueillirUtilisateur($utilisateur)
    {
        $sessionUtilisateur= $utilisateur;
        if ($utilisateur->getProfilUtilisateur()->getIdProfilUtilisateur() == ADMIN_PROFILE_CODE)
        {
            $this->requete->getSession()->setAttribut("sessionAdmin", $sessionUtilisateur);
            $this->rediriger("Accueil", "indexAdmin");
        }
        else
        {
            $this->requete->getSession()->setAttribut("sessionClient", $sessionUtilisateur);
            $this->rediriger("Accueil");
        }
    }

    public function Deconnecter()
    {
        $this->requete->getSession()->detruire();
        $this->rediriger("Accueil", "index");
    }

}
