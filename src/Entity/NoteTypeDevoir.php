<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteTypeDevoirRepository")
 */
class NoteTypeDevoir
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteDevoir", mappedBy="typeDevoir")
     */
    private $noteDevoirs;

    public function __construct()
    {
        $this->noteDevoirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|NoteDevoir[]
     */
    public function getNoteDevoirs(): Collection
    {
        return $this->noteDevoirs;
    }

    public function addNoteDevoir(NoteDevoir $noteDevoir): self
    {
        if (!$this->noteDevoirs->contains($noteDevoir)) {
            $this->noteDevoirs[] = $noteDevoir;
            $noteDevoir->setTypeDevoir($this);
        }

        return $this;
    }

    public function removeNoteDevoir(NoteDevoir $noteDevoir): self
    {
        if ($this->noteDevoirs->contains($noteDevoir)) {
            $this->noteDevoirs->removeElement($noteDevoir);
            // set the owning side to null (unless already changed)
            if ($noteDevoir->getTypeDevoir() === $this) {
                $noteDevoir->setTypeDevoir(null);
            }
        }

        return $this;
    }
}
