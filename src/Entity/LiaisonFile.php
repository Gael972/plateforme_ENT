<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LiaisonFileRepository")
 */
class LiaisonFile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\File", inversedBy="liaisonFiles")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ShareFile", inversedBy="liaisonFiles")
     */
    private $shareFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getShareFile(): ?ShareFile
    {
        return $this->shareFile;
    }

    public function setShareFile(?ShareFile $shareFile): self
    {
        $this->shareFile = $shareFile;

        return $this;
    }
}
