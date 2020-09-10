<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LiaisonFile", mappedBy="file")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

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
            $liaisonFile->setFile($this);
        }

        return $this;
    }

    public function removeLiaisonFile(LiaisonFile $liaisonFile): self
    {
        if ($this->liaisonFiles->contains($liaisonFile)) {
            $this->liaisonFiles->removeElement($liaisonFile);
            // set the owning side to null (unless already changed)
            if ($liaisonFile->getFile() === $this) {
                $liaisonFile->setFile(null);
            }
        }

        return $this;
    }
}
