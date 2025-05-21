<?php

// src/Modeles/Paiement.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Paiement")
 */
class Paiement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdPaiement;

    /**
     * @ORM\Column(type="string", length=250, name="Reference", unique=true)
     */
    protected $Reference;

    /**
     * @ORM\Column(type="string", length=1000, name="Libelle")
     */
    protected $Libelle;

    /**
     * @ORM\Column(type="datetime", name="DatePaiement")
     */
    protected $DatePaiement;

    /**
     * @ORM\Column(type="decimal", scale=2, name="MontantTarifTexte")
     */
    protected $MontantTarifTexte;

    /**
     * @ORM\Column(type="decimal", scale=2, name="MontantTarifImage")
     */
    protected $MontantTarifImage;

    /**
     * @ORM\Column(type="decimal", scale=2, name="MontantTotal")
     */
    protected $MontantTotal;

    /**
     * @ORM\Column(type="integer", name="StatutPaiement")
     */
    protected $StatutPaiement;

    // Relation Many to One vers TarifImage
    /**
     * @ORM\ManyToOne(targetEntity="TarifImage")
     * @ORM\JoinColumn(name="IdTarifImage", referencedColumnName="IdTarifImage", nullable=false)
     */
    protected $TarifImage;

    // Relation Many to One vers TarifTexte
    /**
     * @ORM\ManyToOne(targetEntity="TarifTexte")
     * @ORM\JoinColumn(name="IdTarifTexte", referencedColumnName="IdTarifTexte", nullable=false)
     */
    protected $TarifTexte;

    // Relation Many to One vers ModePaiement
    /**
     * @ORM\ManyToOne(targetEntity="ModePaiement")
     * @ORM\JoinColumn(name="IdModePaiement", referencedColumnName="IdModePaiement", nullable=false)
     */
    protected $ModePaiement;

    // Relation One to One vers Annonce
    /**
     * @ORM\OneToOne(targetEntity="Annonce")
     * @ORM\JoinColumn(name="IdAnnonce", referencedColumnName="IdAnnonce", nullable=false)
     */
    protected $Annonce;


    /**
     * Get idPaiement.
     *
     * @return int
     */
    public function getIdPaiement()
    {
        return $this->IdPaiement;
    }

    /**
     * Set reference.
     *
     * @param string $reference
     *
     * @return Paiement
     */
    public function setReference($reference)
    {
        $this->Reference = $reference;

        return $this;
    }

    /**
     * Get reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->Reference;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return Paiement
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
     * Set datePaiement.
     *
     * @param \DateTime $datePaiement
     *
     * @return Paiement
     */
    public function setDatePaiement($datePaiement)
    {
        $this->DatePaiement = $datePaiement;

        return $this;
    }

    /**
     * Get datePaiement.
     *
     * @return \DateTime
     */
    public function getDatePaiement()
    {
        return $this->DatePaiement;
    }

    /**
     * Set montantTarifTexte.
     *
     * @param string $montantTarifTexte
     *
     * @return Paiement
     */
    public function setMontantTarifTexte($montantTarifTexte)
    {
        $this->MontantTarifTexte = $montantTarifTexte;

        return $this;
    }

    /**
     * Get montantTarifTexte.
     *
     * @return string
     */
    public function getMontantTarifTexte()
    {
        return $this->MontantTarifTexte;
    }

    /**
     * Set montantTarifImage.
     *
     * @param string $montantTarifImage
     *
     * @return Paiement
     */
    public function setMontantTarifImage($montantTarifImage)
    {
        $this->MontantTarifImage = $montantTarifImage;

        return $this;
    }

    /**
     * Get montantTarifImage.
     *
     * @return string
     */
    public function getMontantTarifImage()
    {
        return $this->MontantTarifImage;
    }

    /**
     * Set montantTotal.
     *
     * @param string $montantTarifImage
     *
     * @return Paiement
     */
    public function setMontantTotal($montantTotal)
    {
        $this->MontantTotal = $montantTotal;

        return $this;
    }

    /**
     * Get montantTotal.
     *
     * @return string
     */
    public function getMontantTotal()
    {
        return $this->MontantTotal;
    }

    /**
     * Set statutPaiement.
     *
     * @param int $statutPaiement
     *
     * @return Paiement
     */
    public function setStatutPaiement($statutPaiement)
    {
        $this->StatutPaiement = $statutPaiement;

        return $this;
    }

    /**
     * Get statutPaiement.
     *
     * @return int
     */
    public function getStatutPaiement()
    {
        return $this->StatutPaiement;
    }

    /**
     * Set tarifImage.
     *
     * @param \TarifImage $tarifImage
     *
     * @return Paiement
     */
    public function setTarifImage(\TarifImage $tarifImage)
    {
        $this->TarifImage = $tarifImage;

        return $this;
    }

    /**
     * Get tarifImage.
     *
     * @return \TarifImage
     */
    public function getTarifImage()
    {
        return $this->TarifImage;
    }

    /**
     * Set tarifTexte.
     *
     * @param \TarifTexte $tarifTexte
     *
     * @return Paiement
     */
    public function setTarifTexte(\TarifTexte $tarifTexte)
    {
        $this->TarifTexte = $tarifTexte;

        return $this;
    }

    /**
     * Get tarifTexte.
     *
     * @return \TarifTexte
     */
    public function getTarifTexte()
    {
        return $this->TarifTexte;
    }

    /**
     * Set modePaiement.
     *
     * @param \ModePaiement $modePaiement
     *
     * @return Paiement
     */
    public function setModePaiement(\ModePaiement $modePaiement)
    {
        $this->ModePaiement = $modePaiement;

        return $this;
    }

    /**
     * Get modePaiement.
     *
     * @return \ModePaiement
     */
    public function getModePaiement()
    {
        return $this->ModePaiement;
    }

    /**
     * Set annonce.
     *
     * @param \Annonce $annonce
     *
     * @return Paiement
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
}
