<?php

// src/Modeles/Departement.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Departement")
 */
class Departement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdDepartement;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    // Relation Many to One vers Pays
    /**
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="$DepartementsPays")
     * @ORM\JoinColumn(name="IdPays", referencedColumnName="IdPays", nullable=false)
     */
    protected $Pays;

    // Relation One To Many avec VillesDepartement
    /**
     * @ORM\OneToMany(targetEntity="Ville", mappedBy="Departement")
     */
    protected $VillesDepartement;

    /**
     * Get idDepartement.
     *
     * @return int
     */
    public function getIdDepartement()
    {
        return $this->IdDepartement;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return Departement
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
     * Set pays.
     *
     * @param \Pays $pays
     *
     * @return Departement
     */
    public function setPays(\Pays $pays)
    {
        $this->Pays = $pays;

        return $this;
    }

    /**
     * Get pays.
     *
     * @return \Pays
     */
    public function getPays()
    {
        return $this->Pays;
    }

    /**
     * Ajouter Ville.
     *
     * @param \Ville $ville
     *
     * @return Departement
     */
    public function addVillesDepartement(\Ville $ville)
    {
        $this->VillesDepartement[] = $ville;
        return $this;
    }

    /**
     * Supprimer Ville.
     *
     * @param \Ville $ville
     *
     * @return boolean TRUE si la collection contient l'élément spécifié et FALSE dans le cas contraire.
     */
    public function removeVille(\Ville $ville)
    {
        return $this->VillesDepartement->removeElement($ville);
    }

    /**
     * Get Ville.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVilleDepartement()
    {
        return $this->VillesDepartement;
    }

    /**
     * Ajout de plusieurs départements (fonction variadique)
     */
    public function addManyVillesDepartement(\Ville ...$villes)
    {
        foreach ($villes as $ville)
            $this->VillesDepartement[] = $ville;
        return $this;
    }

}
