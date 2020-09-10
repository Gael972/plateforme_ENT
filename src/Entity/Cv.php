<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CvRepository")
 */
class Cv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="cvs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="cvs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Domaine", inversedBy="cvs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domaine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateD;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateF;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photos;

    /**
     * @ORM\Column(type="integer")
     */
    private $evaluation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLieu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseLieu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpLieu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $villeLieu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): self
    {
        $this->domaine = $domaine;

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

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): self
    {
        $this->dateD = $dateD;

        return $this;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(?\DateTimeInterface $dateF): self
    {
        $this->dateF = $dateF;

        return $this;
    }

    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    public function setPhotos(?string $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function getEvaluation(): ?int
    {
        return $this->evaluation;
    }

    public function setEvaluation(int $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getNomLieu(): ?string
    {
        return $this->nomLieu;
    }

    public function setNomLieu(string $nomLieu): self
    {
        $this->nomLieu = $nomLieu;

        return $this;
    }

    public function getAdresseLieu(): ?string
    {
        return $this->adresseLieu;
    }

    public function setAdresseLieu(?string $adresseLieu): self
    {
        $this->adresseLieu = $adresseLieu;

        return $this;
    }

    public function getCpLieu(): ?int
    {
        return $this->cpLieu;
    }

    public function setCpLieu(?int $cpLieu): self
    {
        $this->cpLieu = $cpLieu;

        return $this;
    }

    public function getVilleLieu(): ?string
    {
        return $this->villeLieu;
    }

    public function setVilleLieu(?string $villeLieu): self
    {
        $this->villeLieu = $villeLieu;

        return $this;
    }
}
