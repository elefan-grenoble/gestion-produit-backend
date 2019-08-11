<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Supplying
 *
 * @ORM\Table(name="SUPPLYING")
 * @ORM\Entity(readOnly=false)
 */
class Supplying
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Article
     * @var Article
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     * @ORM\JoinColumn(name="article_code", referencedColumnName="code")
     * @Serializer\MaxDepth(depth=2)
     */
    private $article;

    /**
     * Quantité à réapprovisionner
     * @var int|null
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * Date de création
     * @var \DateTime|null
     *
     * @ORM\Column(name="creation_date", type="date", nullable=false)
     */
    private $creationDate;

    /**
     * Date de réapprovisionnement
     * @var \DateTime|null
     *
     * @ORM\Column(name="supply_date", type="date", nullable=true)
     */
    private $supplyDate;

    /**
     * En rupture de stock (non trouvé)
     *
     * @var Boolean
     * @ORM\Column(name="out_of_stock", type="boolean", nullable=true)
     */
    private $outOfStock;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     */
    public function setArticle(Article $article): void
    {
        $this->article = $article;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime|null $creationDate
     */
    public function setCreationDate(?\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getSupplyDate(): ?\DateTime
    {
        return $this->supplyDate;
    }

    /**
     * @param \DateTime|null $supplyDate
     */
    public function setSupplyDate(?\DateTime $supplyDate): void
    {
        $this->supplyDate = $supplyDate;
    }

    /**
     * @return Boolean
     */
    public function getOutOfStock(): Boolean
    {
        return $this->outOfStock;
    }

    /**
     * @param Boolean $outOfStock
     */
    public function setOutOfStock(Boolean $outOfStock): void
    {
        $this->outOfStock = $outOfStock;
    }

}
