<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CursusRepository")
 */
class Cursus
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
     * @ORM\OneToMany(targetEntity="App\Entity\Classe", mappedBy="cursus")
     */
    private $classes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ShareFile", mappedBy="cursus")
     */
    private $shareFiles;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->shareFiles = new ArrayCollection();
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
     * @return Collection|Classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setCursus($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->contains($class)) {
            $this->classes->removeElement($class);
            // set the owning side to null (unless already changed)
            if ($class->getCursus() === $this) {
                $class->setCursus(null);
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
            $shareFile->setCursus($this);
        }

        return $this;
    }

    public function removeShareFile(ShareFile $shareFile): self
    {
        if ($this->shareFiles->contains($shareFile)) {
            $this->shareFiles->removeElement($shareFile);
            // set the owning side to null (unless already changed)
            if ($shareFile->getCursus() === $this) {
                $shareFile->setCursus(null);
            }
        }

        return $this;
    }
}
