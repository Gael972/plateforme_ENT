<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteMatiereRepository")
 */
class NoteMatiere
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
    private $nomMatiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="noteMatieres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="noteMatieres")
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteDevoir", mappedBy="matiere")
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

    public function getNomMatiere(): ?string
    {
        return $this->nomMatiere;
    }

    public function setNomMatiere(string $nomMatiere): self
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    public function getFormateur(): ?Membre
    {
        return $this->formateur;
    }

    public function setFormateur(?Membre $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

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
            $noteDevoir->setMatiere($this);
        }

        return $this;
    }

    public function removeNoteDevoir(NoteDevoir $noteDevoir): self
    {
        if ($this->noteDevoirs->contains($noteDevoir)) {
            $this->noteDevoirs->removeElement($noteDevoir);
            // set the owning side to null (unless already changed)
            if ($noteDevoir->getMatiere() === $this) {
                $noteDevoir->setMatiere(null);
            }
        }

        return $this;
    }
}
