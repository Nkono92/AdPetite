<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/Ville.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Ville")
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $IdVille;

    /**
     * @ORM\Column(type="string", length=250, name="nom")
     */
    protected $Libelle;

    // Relation Many to One vers Departement
    /**
     * @ORM\ManyToOne(targetEntity="Departement", inversedBy="$VillesDepartements")
     * @ORM\JoinColumn(name="IdDepartement", referencedColumnName="IdDepartement", nullable=false)
     */
    protected $Departement;


    /**
     * Get idVille.
     *
     * @return int
     */
    public function getIdVille()
    {
        return $this->IdVille;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return Ville
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
     * Set departement.
     *
     * @param \Departement $departement
     *
     * @return Ville
     */
    public function setDepartement(\Departement $departement)
    {
        $this->Departement = $departement;

        return $this;
    }

    /**
     * Get departement.
     *
     * @return \Departement
     */
    public function getDepartement()
    {
        return $this->Departement;
    }
}
