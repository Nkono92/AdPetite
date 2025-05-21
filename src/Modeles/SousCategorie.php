<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/SousCategorie.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="SousCategorie")
 */
class SousCategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdSousCategorie;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    /**
     * @ORM\Column(type="string", length=20, name="FontIcone", nullable=true)
     */
    protected $FontIcone;

    // Relation Many to One vers Categorie
    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="$LesSousCategories")
     * @ORM\JoinColumn(name="IdCategorie", referencedColumnName="IdCategorie", nullable=false)
     */
    protected $Categorie;

    // Relation One To Many avec LesAnnonces
    /**
     * @ORM\OneToMany(targetEntity="Annonce", mappedBy="SousCategorie")
     */
    protected $LesAnnonces;

    /**
     * Get idSousCategorie.
     *
     * @return int
     */
    public function getIdSousCategorie()
    {
        return $this->IdSousCategorie;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return SousCategorie
     */
    public function setLibelle($libelle)
    {
        $this->Libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->Libelle;
    }

    /**
     * Set FontIcone.
     *
     * @param string $fontIcone
     *
     * @return SousCategorie
     */
    public function setFontIcone($fontIcone)
    {
        $this->FontIcone = $fontIcone;

        return $this;
    }

    /**
     * Get fontIcone.
     *
     * @return string
     */
    public function getFontIcone()
    {
        return $this->FontIcone;
    }

    /**
     * Set categorie.
     *
     * @param \Categorie $categorie
     *
     * @return SousCategorie
     */
    public function setCategorie(\Categorie $categorie)
    {
        $this->Categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie.
     *
     * @return \Categorie
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }

    /**
     * Ajouter Annonce.
     *
     * @param Annonce $annonce
     *
     * @return SousCategorie
     */
    public function addLesSousCategories(\Annonce $annonce)
    {
        $this->LesAnnonces[] = $annonce;
        return $this;
    }

    /**
     * Supprimer annonce.
     *
     * @param Annonce $annonce
     *
     * @return boolean TRUE si la collection contient l'élément spécifié et FALSE dans le cas contraire.
     */
    public function removeSousCategorie(Annonce $annonce)
    {
        return $this->LesAnnonces->removeElement($annonce);
    }

    /**
     * Get LesAnnonces.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLesAnnonces()
    {
        return $this->LesAnnonces;
    }

    /**
     * Ajout de plusieurs annonces (fonction variadique)
     */
    public function addManyLesSousCategories(Annonce ...$annonces)
    {
        foreach ($annonces as $annonce)
            $this->LesAnnonces[] = $annonce;
        return $this;
    }
}
