<?php

// src/Modeles/Categorie.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Categorie")
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdCategorie;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    // Relation One To Many avec LesSousCategories
    /**
     * @ORM\OneToMany(targetEntity="SousCategorie", mappedBy="Categorie")
     */
    protected $LesSousCategories;

    /**
     * Get idCategorie.
     *
     * @return int
     */
    public function getIdCategorie()
    {
        return $this->IdCategorie;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return Categorie
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
     * Ajouter SousCategorie.
     *
     * @param \SousCategorie $sousCategorie
     *
     * @return Categorie
     */
    public function addLesSousCategories(\SousCategorie $sousCategorie)
    {
        $this->LesSousCategories[] = $sousCategorie;
        return $this;
    }

    /**
     * Supprimer SousCategorie.
     *
     * @param \SousCategorie $sousCategorie
     *
     * @return boolean TRUE si la collection contient l'élément spécifié et FALSE dans le cas contraire.
     */
    public function removeSousCategorie(\SousCategorie $sousCategorie)
    {
        return $this->LesSousCategories->removeElement($sousCategorie);
    }

    /**
     * Get LesSousCategories.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLesSousCategories()
    {
        return $this->LesSousCategories;
    }

    /**
     * Ajout de plusieurs départements (fonction variadique)
     */
    public function addManyLesSousCategories(\SousCategorie ...$sousCategories)
    {
        foreach ($sousCategories as $sousCategorie)
            $this->LesSousCategories[] = $sousCategorie;
        return $this;
    }
}
