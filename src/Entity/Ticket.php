<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Statut;
use App\Repository\StatutRepository;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
	
	private $statutC;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membreExp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membreDest;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Statut")
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket")
     */
    private $ticket;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lecture;
	
	public function __construct($statutC)
	{
    // Par défaut, la date du ticket est la date d'aujourd'hui
    $this->createdAt = new \Datetime();
	$this->statut = $statutC->findOneById(2);
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMembreExp(): ?membre
    {
        return $this->membreExp;
    }

    public function setMembreExp(?membre $membreExp): self
    {
        $this->membreExp = $membreExp;

        return $this;
    }

    public function getMembreDest(): ?Membre
    {
        return $this->membreDest;
    }

    public function setMembreDest(?Membre $membreDest): self
    {
        $this->membreDest = $membreDest;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTicket(): ?self
    {
        return $this->ticket;
    }

    public function setTicket(?self $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getLecture(): ?\DateTimeInterface
    {
        return $this->lecture;
    }

    public function setLecture(?\DateTimeInterface $lecture): self
    {
        $this->lecture = $lecture;

        return $this;
    }
}
