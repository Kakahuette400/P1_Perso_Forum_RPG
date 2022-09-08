<?php

namespace App\Entity;

use App\Repository\ActRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActRepository::class)]
class Act
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'act', targetEntity: RolePlay::class)]
    private Collection $listRolePlay;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'listAct')]
    private ?Script $script = null;

    public function __construct()
    {
        $this->listRolePlay = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, RolePlay>
     */
    public function getListRolePlay(): Collection
    {
        return $this->listRolePlay;
    }

    public function addListRolePlay(RolePlay $listRolePlay): self
    {
        if (!$this->listRolePlay->contains($listRolePlay)) {
            $this->listRolePlay->add($listRolePlay);
            $listRolePlay->setAct($this);
        }

        return $this;
    }

    public function removeListRolePlay(RolePlay $listRolePlay): self
    {
        if ($this->listRolePlay->removeElement($listRolePlay)) {
            // set the owning side to null (unless already changed)
            if ($listRolePlay->getAct() === $this) {
                $listRolePlay->setAct(null);
            }
        }

        return $this;
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

    public function getScript(): ?Script
    {
        return $this->script;
    }

    public function setScript(?Script $script): self
    {
        $this->script = $script;

        return $this;
    }
}
