<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/ProfilUtilisateur.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ProfilUtilisateur")
 */
class ProfilUtilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdProfilUtilisateur;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    /**
     * Get idProfilUtilisateur.
     *
     * @return int
     */
    public function getIdProfilUtilisateur()
    {
        return $this->IdProfilUtilisateur;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return ProfilUtilisateur
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
}
