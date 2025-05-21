<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/Annonce.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Annonce")
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdAnnonce;

    /**
     * @ORM\Column(type="string", length=256, name="Titre")
     */
    protected $Titre;

    /**
     * @ORM\Column(type="string", length=4000, name="Description")
     */
    protected $Description;

    /**
     * @ORM\Column(type="datetime", name="DateCreation")
     */
    protected $DateCreation;

    /**
     * @ORM\Column(type="integer", name="Statut")
     */
    protected $Statut;

    /**
     * @ORM\Column(type="decimal", scale=2, name="Prix")
     */
    protected $Prix;

    /**
     * @ORM\Column(type="string", length=50, name="Telephone")
     */
    protected $Telephone;

    /**
     * @ORM\Column(type="string", length=256, name="LienYoutube")
     */
    protected $LienYoutube;

    /**
     * @ORM\Column(type="string", length=256, name="LienVimeo")
     */
    protected $LienVimeo;

    /**
     * @ORM\Column(type="string", length=256, name="Autre", nullable=true)
     */
    protected $Autre;

    // Relation Many to One vers SousCategorie
    /**
     * @ORM\ManyToOne(targetEntity="SousCategorie", inversedBy="$LesAnnonces")
     * @ORM\JoinColumn(name="IdSousCategorie", referencedColumnName="IdSousCategorie", nullable=false)
     */
    protected $SousCategorie;

    // Relation Many to One vers TypeAnnonce
    /**
     * @ORM\ManyToOne(targetEntity="TypeAnnonce")
     * @ORM\JoinColumn(name="IdTypeAnnonce", referencedColumnName="IdTypeAnnonce", nullable=false)
     */
    protected $TypeAnnonce;

    // Relation Many to One vers Ville
    /**
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumn(name="IdVille", referencedColumnName="IdVille", nullable=false)
     */
    protected $Ville;

    // Relation Many to One vers Utilisateur
    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="IdUtilisateur", referencedColumnName="IdUtilisateur", nullable=false)
     */
    protected $Utilisateur;

    // Relation One To Many avec LesSousCategories
    /**
     * @ORM\OneToMany(targetEntity="PieceJointe", mappedBy="Annonce")
     */
    protected $LesPiecesJointes;

    /**
     * Get idAnnonce.
     *
     * @return int
     */
    public function getIdAnnonce()
    {
        return $this->IdAnnonce;
    }

    /**
     * Set titre.
     *
     * @param string $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->Titre = $titre;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->Titre;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->Description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * Set dateCreation.
     *
     * @param \DateTime $dateCreation
     *
     * @return Annonce
     */
    public function setDateCreation($dateCreation)
    {
        $this->DateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation.
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->DateCreation;
    }

    /**
     * Set statut.
     *
     * @param int $statut
     *
     * @return Annonce
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
     * Set prix.
     *
     * @param string $prix
     *
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->Prix = $prix;

        return $this;
    }

    /**
     * Get prix.
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->Prix;
    }

    /**
     * Set telephone.
     *
     * @param string $telephone
     *
     * @return Annonce
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
     * Set lienYoutube.
     *
     * @param string $lienYoutube
     *
     * @return Annonce
     */
    public function setLienYoutube($lienYoutube)
    {
        $this->LienYoutube = $lienYoutube;

        return $this;
    }

    /**
     * Get lienYoutube.
     *
     * @return string
     */
    public function getLienYoutube()
    {
        return $this->LienYoutube;
    }

    /**
     * Set lienVimeo.
     *
     * @param string $lienVimeo
     *
     * @return Annonce
     */
    public function setLienVimeo($lienVimeo)
    {
        $this->LienVimeo = $lienVimeo;

        return $this;
    }

    /**
     * Get lienVimeo.
     *
     * @return string
     */
    public function getLienVimeo()
    {
        return $this->LienVimeo;
    }

    /**
     * Set autre.
     *
     * @param string|null $autre
     *
     * @return Annonce
     */
    public function setAutre($autre = null)
    {
        $this->Autre = $autre;

        return $this;
    }

    /**
     * Get autre.
     *
     * @return string|null
     */
    public function getAutre()
    {
        return $this->Autre;
    }

    /**
     * Set sousCategorie.
     *
     * @param \SousCategorie $sousCategorie
     *
     * @return Annonce
     */
    public function setSousCategorie(\SousCategorie $sousCategorie)
    {
        $this->SousCategorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sousCategorie.
     *
     * @return \SousCategorie
     */
    public function getSousCategorie()
    {
        return $this->SousCategorie;
    }

    /**
     * Set typeAnnonce.
     *
     * @param \TypeAnnonce $typeAnnonce
     *
     * @return Annonce
     */
    public function setTypeAnnonce(\TypeAnnonce $typeAnnonce)
    {
        $this->TypeAnnonce = $typeAnnonce;

        return $this;
    }

    /**
     * Get typeAnnonce.
     *
     * @return \TypeAnnonce
     */
    public function getTypeAnnonce()
    {
        return $this->TypeAnnonce;
    }

    /**
     * Set ville.
     *
     * @param \Ville $ville
     *
     * @return Annonce
     */
    public function setVille(\Ville $ville)
    {
        $this->Ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return \Ville
     */
    public function getVille()
    {
        return $this->Ville;
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

    /**
     * Ajouter PieceJointe.
     *
     * @param \PieceJointe $pieceJointe
     *
     * @return Annonce
     */
    public function addLesPiecesJointes(\PieceJointe $pieceJointe)
    {
        $this->LesPiecesJointes[] = $pieceJointe;
        return $this;
    }

    /**
     * Supprimer PieceJointe.
     *
     * @param \PieceJointe $pieceJointe
     *
     * @return boolean TRUE si la collection contient l'élément spécifié et FALSE dans le cas contraire.
     */
    public function removePieceJointe(\PieceJointe $pieceJointe)
    {
        return $this->LesPiecesJointes->removeElement($pieceJointe);
    }

    /**
     * Get LesPiecesJointes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLesPiecesJointes()
    {
        return $this->LesPiecesJointes;
    }

    /**
     * Ajout de plusieurs Pièces jointes (fonction variadique)
     */
    public function addManyLesPiecesJointes(\PieceJointe ...$piecesJointes)
    {
        foreach ($piecesJointes as $pieceJointe)
            $this->LesPiecesJointes[] = $pieceJointe;
        return $this;
    }
}
