<?php

namespace App\Entity;

use App\Repository\DialogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DialogRepository::class)]
class Dialog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\OneToOne(inversedBy: 'dialog', cascade: ['persist', 'remove'])]
    private ?Character $character = null;

    #[ORM\Column]
    private ?bool $pnj = null;

    #[ORM\ManyToOne(inversedBy: 'listDialog')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $Post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCharacter(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): self
    {
        $this->character = $character;

        return $this;
    }

    public function isPnj(): ?bool
    {
        return $this->pnj;
    }

    public function setPnj(bool $pnj): self
    {
        $this->pnj = $pnj;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(?Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }
}
