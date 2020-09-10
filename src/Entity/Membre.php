<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 */
class Membre
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $role;

    /**
     * @ORM\Column(type="integer")
     */
    private $actif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LiaisonCm", mappedBy="membre")
     */
    private $liaisonCms;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cv", mappedBy="membre")
     */
    private $cvs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ShareFile", mappedBy="membreDest")
     */
    private $shareFiles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteMatiere", mappedBy="formateur")
     */
    private $noteMatieres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NoteLiaison", mappedBy="eleve")
     */
    private $noteLiaisons;

    public function __construct()
    {
        $this->liaisonCms = new ArrayCollection();
        $this->cvs = new ArrayCollection();
        $this->shareFiles = new ArrayCollection();
        $this->noteMatieres = new ArrayCollection();
        $this->noteLiaisons = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
            $liaisonCm->setMembre($this);
        }

        return $this;
    }

    public function removeLiaisonCm(LiaisonCm $liaisonCm): self
    {
        if ($this->liaisonCms->contains($liaisonCm)) {
            $this->liaisonCms->removeElement($liaisonCm);
            // set the owning side to null (unless already changed)
            if ($liaisonCm->getMembre() === $this) {
                $liaisonCm->setMembre(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|Cv[]
     */
    public function getCvs(): Collection
    {
        return $this->cvs;
    }

    public function addCv(Cv $cv): self
    {
        if (!$this->cvs->contains($cv)) {
            $this->cvs[] = $cv;
            $cv->setMembre($this);
        }

        return $this;
    }

    public function removeCv(Cv $cv): self
    {
        if ($this->cvs->contains($cv)) {
            $this->cvs->removeElement($cv);
            // set the owning side to null (unless already changed)
            if ($cv->getMembre() === $this) {
                $cv->setMembre(null);
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
            $shareFile->setMembreDest($this);
        }

        return $this;
    }

    public function removeShareFile(ShareFile $shareFile): self
    {
        if ($this->shareFiles->contains($shareFile)) {
            $this->shareFiles->removeElement($shareFile);
            // set the owning side to null (unless already changed)
            if ($shareFile->getMembreDest() === $this) {
                $shareFile->setMembreDest(null);
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
            $noteMatiere->setFormateur($this);
        }

        return $this;
    }

    public function removeNoteMatiere(NoteMatiere $noteMatiere): self
    {
        if ($this->noteMatieres->contains($noteMatiere)) {
            $this->noteMatieres->removeElement($noteMatiere);
            // set the owning side to null (unless already changed)
            if ($noteMatiere->getFormateur() === $this) {
                $noteMatiere->setFormateur(null);
            }
        }

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
            $noteLiaison->setEleve($this);
        }

        return $this;
    }

    public function removeNoteLiaison(NoteLiaison $noteLiaison): self
    {
        if ($this->noteLiaisons->contains($noteLiaison)) {
            $this->noteLiaisons->removeElement($noteLiaison);
            // set the owning side to null (unless already changed)
            if ($noteLiaison->getEleve() === $this) {
                $noteLiaison->setEleve(null);
            }
        }

        return $this;
    }

   
}
