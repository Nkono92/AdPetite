<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/Utilisateur.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Utilisateur")
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdUtilisateur;

    /**
     * @ORM\Column(type="string", length=256, name="Nom")
     */
    protected $Nom;

    /**
     * @ORM\Column(type="string", length=256, name="Prenom")
     */
    protected $Prenom;

    /**
     * @ORM\Column(type="string", length=50, name="Telephone")
     */
    protected $Telephone;

    /**
     * @ORM\Column(type="string", length=256, name="Email")
     */
    protected $Email;

    /**
     * @ORM\Column(type="string", length=1024, name="MotDePasse")
     */
    protected $MotDePasse;

    /**
     * @ORM\Column(type="datetime", name="DateInscription")
     */
    protected $DateInscription;

    /**
     * @ORM\Column(type="integer", name="Statut")
     */
    protected $Statut;

    /**
     * @ORM\Column(type="string", length=250, name="Rue", nullable=true)
     */
    protected $Rue;

    /**
     * @ORM\Column(type="string", length=256, name="BoitePostale", nullable=true)
     */
    protected $BoitePostale;

    /**
     * @ORM\Column(type="string", length=256, name="PhotoProfil", nullable=true)
     */
    protected $PhotoProfil;

    // Relation Many to One vers ProfilUtilisateur
    /**
     * @ORM\ManyToOne(targetEntity="ProfilUtilisateur")
     * @ORM\JoinColumn(name="IdProfilUtilisateur", referencedColumnName="IdProfilUtilisateur", nullable=false)
     */
    protected $ProfilUtilisateur;

    /**
     * Get idUtilisateur.
     *
     * @return int
     */
    public function getIdUtilisateur()
    {
        return $this->IdUtilisateur;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->Nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->Prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * Set telephone.
     *
     * @param string $telephone
     *
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->Telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone.
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->Telephone;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->Email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Set motDePasse.
     *
     * @param string $motDePasse
     *
     * @return Utilisateur
     */
    public function setMotDePasse($motDePasse)
    {
        $this->MotDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse.
     *
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->MotDePasse;
    }

    /**
     * Set dateInscription.
     *
     * @param \DateTime $dateInscription
     *
     * @return Utilisateur
     */
    public function setDateInscription($dateInscription)
    {
        $this->DateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription.
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->DateInscription;
    }

    /**
     * Set statut.
     *
     * @param int $statut
     *
     * @return Utilisateur
     */
    public function setStatut($statut)
    {
        $this->Statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->Statut;
    }

    /**
     * Set rue.
     *
     * @param string|null $rue
     *
     * @return Utilisateur
     */
    public function setRue($rue = null)
    {
        $this->Rue = $rue;

        return $this;
    }

    /**
     * Get rue.
     *
     * @return string|null
     */
    public function getRue()
    {
        return $this->Rue;
    }

    /**
     * Set boitePostale.
     *
     * @param string|null $boitePostale
     *
     * @return Utilisateur
     */
    public function setBoitePostale($boitePostale = null)
    {
        $this->BoitePostale = $boitePostale;

        return $this;
    }

    /**
     * Get boitePostale.
     *
     * @return string|null
     */
    public function getBoitePostale()
    {
        return $this->BoitePostale;
    }

    /**
     * Set photoProfil.
     *
     * @param string|null $photoProfil
     *
     * @return Utilisateur
     */
    public function setPhotoProfil($photoProfil = null)
    {
        $this->PhotoProfil = $photoProfil;

        return $this;
    }

    /**
     * Get photoProfil.
     *
     * @return string|null
     */
    public function getPhotoProfil()
    {
        return $this->PhotoProfil;
    }

    /**
     * Set profilUtilisateur.
     *
     * @param \ProfilUtilisateur $profilUtilisateur
     *
     * @return Utilisateur
     */
    public function setProfilUtilisateur(\ProfilUtilisateur $profilUtilisateur)
    {
        $this->ProfilUtilisateur = $profilUtilisateur;

        return $this;
    }

    /**
     * Get profilUtilisateur.
     *
     * @return \ProfilUtilisateur
     */
    public function getProfilUtilisateur()
    {
        return $this->ProfilUtilisateur;
    }
}
