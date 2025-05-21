<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/Annonce.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Favoris")
 */
class Favoris
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdFavoris;

    /**
     * @ORM\Column(type="datetime", name="DateAjout")
     */
    protected $DateAjout;

    // Relation Many to One vers Annonce
    /**
     * @ORM\ManyToOne(targetEntity="Annonce")
     * @ORM\JoinColumn(name="IdAnnonce", referencedColumnName="IdAnnonce", nullable=false)
     */
    protected $Annonce;

    // Relation Many to One vers Utilisateur
    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="IdUtilisateur", referencedColumnName="IdUtilisateur", nullable=false)
     */
    protected $Utilisateur;

    /**
     * Get idAnnonce.
     *
     * @return int
     */
    public function getIdFavoris()
    {
        return $this->IdFavoris;
    }

    /**
     * Set titre.
     *
     * @param DateTime $dateAjout
     *
     * @return Annonce
     */
    public function setDateAjout($dateAjout)
    {
        $this->DateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return DateTime
     */
    public function getDateAjout()
    {
        return $this->DateAjout;
    }

    /**
     * Set annonce.
     *
     * @param \Annonce $annonce
     *
     * @return Annonce
     */
    public function setAnnonce(\Annonce $annonce)
    {
        $this->Annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce.
     *
     * @return \Annonce
     */
    public function getAnnonce()
    {
        return $this->Annonce;
    }

    /**
     * Set utilisateur.
     *
     * @param \Utilisateur $utilisateur
     *
     * @return Annonce
     */
    public function setUtilisateur(\Utilisateur $utilisateur)
    {
        $this->Utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur.
     *
     * @return \Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->Utilisateur;
    }

}