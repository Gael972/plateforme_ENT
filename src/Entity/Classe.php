<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Cursus", inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LiaisonCm", mappedBy="classe")
     */
    private $liaisonCms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ShareFile", mappedBy="classe")
     */
    private $shareFiles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteMatiere", mappedBy="classe")
     */
    private $noteMatieres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteDevoir", mappedBy="classe")
     */
    private $noteDevoirs;

    public function __construct()
    {
        $this->liaisonCms = new ArrayCollection();
        $this->shareFiles = new ArrayCollection();
        $this->noteMatieres = new ArrayCollection();
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

    public function getCursus(): ?Cursus
    {
        return $this->cursus;
    }

    public function setCursus(?Cursus $cursus): self
    {
        $this->cursus = $cursus;

        return $this;
    }

    /**
     * @return Collection|LiaisonCm[]
     */
    public function getLiaisonCms(): Collection
    {
        return $this->liaisonCms;
    }

    public function addLiaisonCm(LiaisonCm $liaisonCm): self
    {
        if (!$this->liaisonCms->contains($liaisonCm)) {
            $this->liaisonCms[] = $liaisonCm;
            $liaisonCm->setClasse($this);
        }

        return $this;
    }

    public function removeLiaisonCm(LiaisonCm $liaisonCm): self
    {
        if ($this->liaisonCms->contains($liaisonCm)) {
            $this->liaisonCms->removeElement($liaisonCm);
            // set the owning side to null (unless already changed)
            if ($liaisonCm->getClasse() === $this) {
                $liaisonCm->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ShareFile[]
     */
    public function getShareFiles(): Collection
    {
        return $this->shareFiles;
    }

    public function addShareFile(ShareFile $shareFile): self
    {
        if (!$this->shareFiles->contains($shareFile)) {
            $this->shareFiles[] = $shareFile;
            $shareFile->setClasse($this);
        }

        return $this;
    }

    public function removeShareFile(ShareFile $shareFile): self
    {
        if ($this->shareFiles->contains($shareFile)) {
            $this->shareFiles->removeElement($shareFile);
            // set the owning side to null (unless already changed)
            if ($shareFile->getClasse() === $this) {
                $shareFile->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NoteMatiere[]
     */
    public function getNoteMatieres(): Collection
    {
        return $this->noteMatieres;
    }

    public function addNoteMatiere(NoteMatiere $noteMatiere): self
    {
        if (!$this->noteMatieres->contains($noteMatiere)) {
            $this->noteMatieres[] = $noteMatiere;
            $noteMatiere->setClasse($this);
        }

        return $this;
    }

    public function removeNoteMatiere(NoteMatiere $noteMatiere): self
    {
        if ($this->noteMatieres->contains($noteMatiere)) {
            $this->noteMatieres->removeElement($noteMatiere);
            // set the owning side to null (unless already changed)
            if ($noteMatiere->getClasse() === $this) {
                $noteMatiere->setClasse(null);
            }
        }

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
            $noteDevoir->setClasse($this);
        }

        return $this;
    }

    public function removeNoteDevoir(NoteDevoir $noteDevoir): self
    {
        if ($this->noteDevoirs->contains($noteDevoir)) {
            $this->noteDevoirs->removeElement($noteDevoir);
            // set the owning side to null (unless already changed)
            if ($noteDevoir->getClasse() === $this) {
                $noteDevoir->setClasse(null);
            }
        }

        return $this;
    }

   
}
