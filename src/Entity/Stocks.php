<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Stocks
 *
 * @ORM\Table(name="STOCKS")
 * @ORM\Entity(readOnly=true)
 */
class Stocks
{
    /**
     * @var int
     *
     * @ORM\Column(name="qte_stocks", type="integer", nullable=false)
     */
    private $qteStocks;

    /**
     * @var int
     *
     * @ORM\Column(name="qte_commande", type="integer", nullable=false)
     */
    private $qteCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     * @Serializer\Exclude
     */
    private $date;

    /**
     * @var Article
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="stocks")
     * @ORM\JoinColumn(name="code", referencedColumnName="code")
     */
    private $article;

    /**
     * Get qteStocks.
     *
     * @return int
     */
    public function getQteStocks()
    {
        return $this->qteStocks;
    }

    /**
     * Get qteCommande.
     *
     * @return int
     */
    public function getQteCommande()
    {
        return $this->qteCommande;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setQteStocks(int $qteStocks): self
    {
        $this->qteStocks = $qteStocks;

        return $this;
    }

    public function setQteCommande(int $qteCommande): self
    {
        $this->qteCommande = $qteCommande;

        return $this;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
