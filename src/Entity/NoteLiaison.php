<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteLiaisonRepository")
 */
class NoteLiaison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NoteDevoir", inversedBy="noteLiaisons")
     */
    private $devoir;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="noteLiaisons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eleve;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevoir(): ?NoteDevoir
    {
        return $this->devoir;
    }

    public function setDevoir(?NoteDevoir $devoir): self
    {
        $this->devoir = $devoir;

        return $this;
    }

    public function getEleve(): ?Membre
    {
        return $this->eleve;
    }

    public function setEleve(?Membre $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }
}
