<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShareFileRepository")
 */
class ShareFile
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
    private $dateUpload;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="shareFiles")
     */
    private $membreDest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="shareFiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membreUp;

    /**
     * @ORM\Column(type="float")
     */
    private $tailleFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cursus", inversedBy="shareFiles")
     */
    private $cursus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="shareFiles")
     */
    private $classe;

    /**
     * @ORM\Column(type="integer")
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LiaisonFile", mappedBy="shareFile")
     */
    private $liaisonFiles;

    public function __construct()
    {
        $this->liaisonFiles = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateUpload(): ?\DateTimeInterface
    {
        return $this->dateUpload;
    }

    public function setDateUpload(\DateTimeInterface $dateUpload): self
    {
        $this->dateUpload = $dateUpload;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getMembreDest(): ?membre
    {
        return $this->membreDest;
    }

    public function setMembreDest(?membre $membreDest): self
    {
        $this->membreDest = $membreDest;

        return $this;
    }

    public function getMembreUp(): ?membre
    {
        return $this->membreUp;
    }

    public function setMembreUp(?membre $membreUp): self
    {
        $this->membreUp = $membreUp;

        return $this;
    }

    public function getTailleFile(): ?float
    {
        return $this->tailleFile;
    }

    public function setTailleFile(float $tailleFile): self
    {
        $this->tailleFile = $tailleFile;

        return $this;
    }

    public function getCursus(): ?cursus
    {
        return $this->cursus;
    }

    public function setCursus(?cursus $cursus): self
    {
        $this->cursus = $cursus;

        return $this;
    }

    public function getClasse(): ?classe
    {
        return $this->classe;
    }

    public function setClasse(?classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getActif(): ?int
    {
        return $this->actif;
    }

    public function setActif(int $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection|LiaisonFile[]
     */
    public function getLiaisonFiles(): Collection
    {
        return $this->liaisonFiles;
    }

    public function addLiaisonFile(LiaisonFile $liaisonFile): self
    {
        if (!$this->liaisonFiles->contains($liaisonFile)) {
            $this->liaisonFiles[] = $liaisonFile;
            $liaisonFile->setShareFile($this);
        }

        return $this;
    }

    public function removeLiaisonFile(LiaisonFile $liaisonFile): self
    {
        if ($this->liaisonFiles->contains($liaisonFile)) {
            $this->liaisonFiles->removeElement($liaisonFile);
            // set the owning side to null (unless already changed)
            if ($liaisonFile->getShareFile() === $this) {
                $liaisonFile->setShareFile(null);
            }
        }

        return $this;
    }

}
