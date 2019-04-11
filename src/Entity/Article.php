<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Article
 *
 * @ORM\Table(name="ARTICLE")
 * @ORM\Entity(readOnly=true)
 */
class Article
{
    /**
     * Identifiant de l'article
     * @var int
     *
     * @ORM\Column(name="code", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $code;

    /**
     * Désignation
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=512, nullable=false)
     */
    private $designation;

    /**
     * Famille
     * @var Famille
     * @ORM\ManyToOne(targetEntity="App\Entity\Famille")
     * @ORM\JoinColumn(name="famille_id", referencedColumnName="id")
     * @Serializer\MaxDepth(depth=1)
     */
    private $famille;

    /**
     * Fournisseur
     * @var Fournisseur
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur")
     * @ORM\JoinColumn(name="code_fournisseur", referencedColumnName="code")
     * @Serializer\MaxDepth(depth=1)
     */
    private $fournisseur;

    /**
     * Référence du fournisseur / à supprimer du schéma ?!
     * @var string|null
     *
     * @ORM\Column(name="ref_fournisseur", type="string", length=56, nullable=true)
     * @Serializer\Exclude
     */
    private $refFournisseur;

    /**
     * Code TVA
     * @var int|null
     *
     * @ORM\Column(name="code_tva", type="integer", nullable=true)
     */
    private $codeTva;

    /**
     * Quantité en stock
     * @var int|null
     *
     * @ORM\Column(name="qte_appro", type="integer", nullable=true)
     */
    private $qteAppro;

    /**
     * Prix de vente
     * @var string|null
     *
     * @ORM\Column(name="prix_vente", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prixVente;

    /**
     * Ancien prix de vente
     * @var string|null
     *
     * @ORM\Column(name="anc_prix_vente", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ancPrixVente;

    /**
     * Prix en promo
     * @var string|null
     *
     * @ORM\Column(name="prix_promo", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prixPromo;

    /**
     * Prix achat brut
     * @var string|null
     *
     * @ORM\Column(name="prix_achat_brut", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prixAchatBrut;

    /**
     * Ancien prix achat brut
     * @var string|null
     *
     * @ORM\Column(name="anc_prix_achat_brut", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ancPrixAchatBrut;

    /**
     * Remise à l'achat
     * @var string|null
     *
     * @ORM\Column(name="remise_achat", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $remiseAchat;

    /**
     * Status
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=56, nullable=false)
     */
    private $status;

    /**
     * Quantité : Kg / Litre
     * @var int|null
     *
     * @ORM\Column(name="qte_kg_litre", type="integer", nullable=true)
     */
    private $qteKgLitre;

    /**
     * Unité de vente
     * @var string
     *
     * @ORM\Column(name="unite_vente", type="string", length=56, nullable=false)
     */
    private $uniteVente;

    /**
     * Date de création
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation", type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * Date de modification
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_modification", type="date", nullable=true)
     */
    private $dateModification;

    /**
     * Taux de TYA
     * @var string|null
     *
     * @ORM\Column(name="taux_tva", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tauxTva;

    /**
     * Prix de vente HT
     * @var string|null
     *
     * @ORM\Column(name="prix_vente_ht", type="decimal", precision=10, scale=6, nullable=true)
     */
    private $prixVenteHt;

    /**
     * Ancien prix de vente HT
     * @var string|null
     *
     * @ORM\Column(name="anc_prix_vente_ht", type="decimal", precision=10, scale=6, nullable=true)
     */
    private $ancPrixVenteHt;

    /**
     * Stock
     * @var Stocks
     * @ORM\OneToOne(targetEntity="App\Entity\Stocks", mappedBy="article")
     * @Serializer\MaxDepth(depth=1)
     * @Serializer\Groups({"privilegied"})
     */
    private $stocks;

    /**
     * Get code.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get designation.
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Get refFournisseur.
     *
     * @return string|null
     */
    public function getRefFournisseur()
    {
        return $this->refFournisseur;
    }

    /**
     * Get codeTva.
     *
     * @return int|null
     */
    public function getCodeTva()
    {
        return $this->codeTva;
    }

    /**
     * Get qteAppro.
     *
     * @return int|null
     */
    public function getQteAppro()
    {
        return $this->qteAppro;
    }

    /**
     * Get prixVente.
     *
     * @return string|null
     */
    public function getPrixVente()
    {
        return $this->prixVente;
    }

    /**
     * Get ancPrixVente.
     *
     * @return string|null
     */
    public function getAncPrixVente()
    {
        return $this->ancPrixVente;
    }

    /**
     * Get prixPromo.
     *
     * @return string|null
     */
    public function getPrixPromo()
    {
        return $this->prixPromo;
    }

    /**
     * Get prixAchatBrut.
     *
     * @return string|null
     */
    public function getPrixAchatBrut()
    {
        return $this->prixAchatBrut;
    }

    /**
     * Get ancPrixAchatBrut.
     *
     * @return string|null
     */
    public function getAncPrixAchatBrut()
    {
        return $this->ancPrixAchatBrut;
    }


    /**
     * Get remiseAchat.
     *
     * @return string|null
     */
    public function getRemiseAchat()
    {
        return $this->remiseAchat;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get qteKgLitre.
     *
     * @return int|null
     */
    public function getQteKgLitre()
    {
        return $this->qteKgLitre;
    }

    /**
     * Get uniteVente.
     *
     * @return string
     */
    public function getUniteVente()
    {
        return $this->uniteVente;
    }

    /**
     * Get dateCreation.
     *
     * @return \DateTime|null
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Get dateModification.
     *
     * @return \DateTime|null
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Get tauxTva.
     *
     * @return string|null
     */
    public function getTauxTva()
    {
        return $this->tauxTva;
    }

    /**
     * Get prixVenteHt.
     *
     * @return string|null
     */
    public function getPrixVenteHt()
    {
        return $this->prixVenteHt;
    }

    /**
     * Get ancPrixVenteHt.
     *
     * @return string|null
     */
    public function getAncPrixVenteHt()
    {
        return $this->ancPrixVenteHt;
    }

    /**
     * @return Famille
     */
    public function getFamille(): Famille
    {
        return $this->famille;
    }

    /**
     * @return Fournisseur
     */
    public function getFournisseur(): Fournisseur
    {
        return $this->fournisseur;
    }

    /**
     * @return Stocks
     */
    public function getStocks(): Stocks
    {
        return $this->stocks;
    }
}
