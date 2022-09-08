<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnageRepository::class)]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $job = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $body = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $mind = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $story = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\OneToOne(mappedBy: 'character', cascade: ['persist', 'remove'])]
    private ?Dialog $dialog = null;

    #[ORM\OneToMany(mappedBy: 'Perso', targetEntity: Post::class)]
    private Collection $listPost;

    #[ORM\ManyToMany(targetEntity: RolePlay::class, inversedBy: 'characters')]
    private Collection $listRP;

    #[ORM\ManyToOne(inversedBy: 'listCharacter')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->listPost = new ArrayCollection();
        $this->listRP = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getMind(): ?string
    {
        return $this->mind;
    }

    public function setMind(?string $mind): self
    {
        $this->mind = $mind;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(?string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getDialog(): ?Dialog
    {
        return $this->dialog;
    }

    public function setDialog(?Dialog $dialog): self
    {
        // unset the owning side of the relation if necessary
        if ($dialog === null && $this->dialog !== null) {
            $this->dialog->setCharacter(null);
        }

        // set the owning side of the relation if necessary
        if ($dialog !== null && $dialog->getCharacter() !== $this) {
            $dialog->setCharacter($this);
        }

        $this->dialog = $dialog;

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
            $listPost->setPerso($this);
        }

        return $this;
    }

    public function removeListPost(Post $listPost): self
    {
        if ($this->listPost->removeElement($listPost)) {
            // set the owning side to null (unless already changed)
            if ($listPost->getPerso() === $this) {
                $listPost->setPerso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RolePlay>
     */
    public function getListRP(): Collection
    {
        return $this->listRP;
    }

    public function addListRP(RolePlay $listRP): self
    {
        if (!$this->listRP->contains($listRP)) {
            $this->listRP->add($listRP);
        }

        return $this;
    }

    public function removeListRP(RolePlay $listRP): self
    {
        $this->listRP->removeElement($listRP);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
