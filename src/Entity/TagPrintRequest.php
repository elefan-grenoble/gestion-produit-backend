<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TagPrintRequest
 *
 * @ORM\Table(name="TAG_PRINT_REQUEST")
 * @ORM\Entity
 */
class TagPrintRequest
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
     * @Assert\DateTime
     */
    private $date;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="tagPrintRequests")
     * @ORM\JoinColumn(referencedColumnName="code", nullable=false)
     * @Serializer\MaxDepth(depth=1)
     * @Assert\NotNull
     */
    private $article;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(0)
     */
    private $quantity;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank
     */
    private $reason;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

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
