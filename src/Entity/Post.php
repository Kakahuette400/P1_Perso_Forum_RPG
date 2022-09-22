<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listPost')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RolePlay $RP = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Message::class)]
    private Collection $listMessage;

    #[ORM\OneToMany(mappedBy: 'Post', targetEntity: Dialog::class)]
    private Collection $listDialog;

    #[ORM\ManyToOne(inversedBy: 'listPost')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Perso $Perso = null;

    public function __construct()
    {
        $this->listMessage = new ArrayCollection();
        $this->listDialog = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getRP(): ?RolePlay
    {
        return $this->RP;
    }

    public function setRP(?RolePlay $RP): self
    {
        $this->RP = $RP;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getListMessage(): Collection
    {
        return $this->listMessage;
    }

    public function addListMessage(Message $listMessage): self
    {
        if (!$this->listMessage->contains($listMessage)) {
            $this->listMessage->add($listMessage);
            $listMessage->setPost($this);
        }

        return $this;
    }

    public function removeListMessage(Message $listMessage): self
    {
        if ($this->listMessage->removeElement($listMessage)) {
            // set the owning side to null (unless already changed)
            if ($listMessage->getPost() === $this) {
                $listMessage->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dialog>
     */
    public function getListDialog(): Collection
    {
        return $this->listDialog;
    }

    public function addListDialog(Dialog $listDialog): self
    {
        if (!$this->listDialog->contains($listDialog)) {
            $this->listDialog->add($listDialog);
            $listDialog->setPost($this);
        }

        return $this;
    }

    public function removeListDialog(Dialog $listDialog): self
    {
        if ($this->listDialog->removeElement($listDialog)) {
            // set the owning side to null (unless already changed)
            if ($listDialog->getPost() === $this) {
                $listDialog->setPost(null);
            }
        }

        return $this;
    }

    public function getPerso(): ?Perso
    {
        return $this->Perso;
    }

    public function setPerso(?Perso $Perso): self
    {
        $this->Perso = $Perso;

        return $this;
    }


}
