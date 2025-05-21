<?php

// src/Modeles/Pays.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Pays")
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdPays;

    /**
     * @ORM\Column(type="string", length=5, name="CodePays", unique=true)
     */
    protected  $CodePays;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    // Relation One To Many avec DepartementsPays
    /**
     * @ORM\OneToMany(targetEntity="Departement", mappedBy="Pays")
     */
    protected $DepartementsPays;

    /**
     * Get idPays.
     *
     * @return int
     */
    public function getIdPays()
    {
        return $this->IdPays;
    }

    /**
     * Set codePays.
     *
     * @param string $codePays
     *
     * @return Pays
     */
    public function setCodePays($codePays)
    {
        $this->CodePays = $codePays;

        return $this;
    }

    /**
     * Get codePays.
     *
     * @return string
     */
    public function getCodePays()
    {
        return $this->CodePays;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return Pays
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
     * Ajouter Departement.
     *
     * @param \Departement $departement
     *
     * @return Pays
     */
    public function addDepartementsPays(\Departement $departement)
    {
        $this->DepartementsPays[] = $departement;
        return $this;
    }

    /**
     * Supprimer Departement.
     *
     * @param \Departement $departement
     *
     * @return boolean TRUE si la collection contient l'élément spécifié et FALSE dans le cas contraire.
     */
    public function removeDepartement(\Departement $departement)
    {
        return $this->DepartementsPays->removeElement($departement);
    }

    /**
     * Get Departement.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartementPays()
    {
        return $this->DepartementsPays;
    }

    /**
     * Ajout de plusieurs départements (fonction variadique)
     */
    public function addManyDepartementsPays(\Departement ...$departements)
    {
        foreach ($departements as $departement)
            $this->DepartementsPays[] = $departement;
        return $this;
    }

}
