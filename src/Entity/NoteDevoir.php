<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteDevoirRepository")
 */
class NoteDevoir
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NoteMatiere", inversedBy="noteDevoirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $coefficient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NoteTypeDevoir", inversedBy="noteDevoirs")
     */
    private $typeDevoir;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="noteDevoirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteLiaison", mappedBy="devoir")
     */
    private $noteLiaisons;

    public function __construct()
    {
        $this->noteLiaisons = new ArrayCollection();
    }

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMatiere(): ?NoteMatiere
    {
        return $this->matiere;
    }

    public function setMatiere(?NoteMatiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getTypeDevoir(): ?NoteTypeDevoir
    {
        return $this->typeDevoir;
    }

    public function setTypeDevoir(?NoteTypeDevoir $typeDevoir): self
    {
        $this->typeDevoir = $typeDevoir;

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
     * @return Collection|NoteLiaison[]
     */
    public function getNoteLiaisons(): Collection
    {
        return $this->noteLiaisons;
    }

    public function addNoteLiaison(NoteLiaison $noteLiaison): self
    {
        if (!$this->noteLiaisons->contains($noteLiaison)) {
            $this->noteLiaisons[] = $noteLiaison;
            $noteLiaison->setDevoir($this);
        }

        return $this;
    }

    public function removeNoteLiaison(NoteLiaison $noteLiaison): self
    {
        if ($this->noteLiaisons->contains($noteLiaison)) {
            $this->noteLiaisons->removeElement($noteLiaison);
            // set the owning side to null (unless already changed)
            if ($noteLiaison->getDevoir() === $this) {
                $noteLiaison->setDevoir(null);
            }
        }

        return $this;
    }
}
