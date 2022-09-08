<?php

namespace App\Entity;

use App\Repository\RolePlayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolePlayRepository::class)]
class RolePlay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $summarize = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'RP', targetEntity: Post::class)]
    private Collection $listPost;

    #[ORM\ManyToOne(inversedBy: 'listRolePlay')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Act $act = null;

    #[ORM\ManyToMany(targetEntity: Character::class, mappedBy: 'listRP')]
    private Collection $characters;

    public function __construct()
    {
        $this->listPost = new ArrayCollection();
        $this->characters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getSummarize(): ?string
    {
        return $this->summarize;
    }

    public function setSummarize(?string $summarize): self
    {
        $this->summarize = $summarize;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getListPost(): Collection
    {
        return $this->listPost;
    }

    public function addListPost(Post $listPost): self
    {
        if (!$this->listPost->contains($listPost)) {
            $this->listPost->add($listPost);
            $listPost->setRP($this);
        }

        return $this;
    }

    public function removeListPost(Post $listPost): self
    {
        if ($this->listPost->removeElement($listPost)) {
            // set the owning side to null (unless already changed)
            if ($listPost->getRP() === $this) {
                $listPost->setRP(null);
            }
        }

        return $this;
    }

    public function getAct(): ?Act
    {
        return $this->act;
    }

    public function setAct(?Act $act): self
    {
        $this->act = $act;

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->addListRP($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->removeElement($character)) {
            $character->removeListRP($this);
        }

        return $this;
    }
}
