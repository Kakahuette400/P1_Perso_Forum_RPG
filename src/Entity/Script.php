<?php

namespace App\Entity;

use App\Repository\ScriptRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScriptRepository::class)]
class Script
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'script', targetEntity: Act::class)]
    private Collection $listAct;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->listAct = new ArrayCollection();
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

    /**
     * @return Collection<int, Act>
     */
    public function getListAct(): Collection
    {
        return $this->listAct;
    }

    public function addListAct(Act $listAct): self
    {
        if (!$this->listAct->contains($listAct)) {
            $this->listAct->add($listAct);
            $listAct->setScript($this);
        }

        return $this;
    }

    public function removeListAct(Act $listAct): self
    {
        if ($this->listAct->removeElement($listAct)) {
            // set the owning side to null (unless already changed)
            if ($listAct->getScript() === $this) {
                $listAct->setScript(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
