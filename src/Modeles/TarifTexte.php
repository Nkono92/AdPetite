<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/TarifTexte.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TarifTexte")
 */
class TarifTexte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdTarifTexte;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    /**
     * @ORM\Column(type="integer", name="BorneInf")
     */
    protected $BorneInf;

    /**
     * @ORM\Column(type="integer", name="BorneSup")
     */
    protected $BorneSup;

    /**
     * @ORM\Column(type="decimal", scale=2, name="Montant")
     */
    protected $Montant;


    /**
     * Get idTarifTexte.
     *
     * @return int
     */
    public function getIdTarifTexte()
    {
        return $this->IdTarifTexte;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return TarifTexte
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
     * Set borneInf.
     *
     * @param int $borneInf
     *
     * @return TarifTexte
     */
    public function setBorneInf($borneInf)
    {
        $this->BorneInf = $borneInf;

        return $this;
    }

    /**
     * Get borneInf.
     *
     * @return int
     */
    public function getBorneInf()
    {
        return $this->BorneInf;
    }

    /**
     * Set borneSup.
     *
     * @param int $borneSup
     *
     * @return TarifTexte
     */
    public function setBorneSup($borneSup)
    {
        $this->BorneSup = $borneSup;

        return $this;
    }

    /**
     * Get borneSup.
     *
     * @return int
     */
    public function getBorneSup()
    {
        return $this->BorneSup;
    }

    /**
     * Set montant.
     *
     * @param string $montant
     *
     * @return TarifTexte
     */
    public function setMontant($montant)
    {
        $this->Montant = $montant;

        return $this;
    }

    /**
     * Get montant.
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->Montant;
    }
}
