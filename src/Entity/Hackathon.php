<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HackathonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: HackathonRepository::class)]
#[ApiResource]
class Hackathon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["hackathon", "inscription"])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["hackathon", "inscription"])]
    private ?\DateTime $dateHeureDebut = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["hackathon", "inscription"])]
    private ?\DateTime $dateHeureFin = null;

    #[ORM\Column(length: 255)]
    #[Groups(["hackathon", "inscription"])]
    private ?string $lieu = null;

    #[ORM\Column(length: 255)]
    #[Groups(["hackathon", "inscription"])]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["hackathon", "inscription"])]
    private ?string $theme = null;

    #[ORM\ManyToOne(inversedBy: 'hackathons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["hackathon", "inscription"])]
    private ?Organisateur $Organisateur = null;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'Hackathon')]
    #[Groups(["hackathon", "inscription"])]
    private Collection $projets;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'Hackathon')]
    #[Groups(["hackathon"])]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureDebut(): ?\DateTime
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(?\DateTime $dateHeureDebut): static
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTime
    {
        return $this->dateHeureFin;
    }

    public function setDateHeureFin(?\DateTime $dateHeureFin): static
    {
        $this->dateHeureFin = $dateHeureFin;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getOrganisateur(): ?Organisateur
    {
        return $this->Organisateur;
    }

    public function setOrganisateur(?Organisateur $Organisateur): static
    {
        $this->Organisateur = $Organisateur;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setHackathon($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getHackathon() === $this) {
                $projet->setHackathon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setHackathon($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getHackathon() === $this) {
                $inscription->setHackathon(null);
            }
        }

        return $this;
    }
}
