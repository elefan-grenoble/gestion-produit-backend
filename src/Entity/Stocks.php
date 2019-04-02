<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $date;

    /**
     * @var Article
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
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
}
