<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * MissingBarcode
 *
 * @ORM\Table(name="MISSING_BARCODE")
 * @ORM\Entity
 */
class MissingBarcode
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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="missingBarcodes")
     * @ORM\JoinColumn(referencedColumnName="code", nullable=false)
     * @Serializer\MaxDepth(depth=1)
     */
    private $article;

    /**
     * @var int
     * @ORM\Column(type="bigint", nullable=false)
     */
    private $barcode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBarcode(): ?int
    {
        return $this->barcode;
    }

    public function setBarcode(int $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
