<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
#[ApiResource]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["hackathon", "inscription"])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(["hackathon", "inscription"])]
    private ?int $num = null;

    #[ORM\Column]
    #[Groups(["hackathon", "inscription"])]
    private ?\DateTime $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["hackathon", "inscription"])]
    private ?string $competence = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["inscription"])]
    private ?Hackathon $Hackathon = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["hackathon", "inscription"])]
    private ?Participant $Participant = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["hackathon", "inscription"])]
    private ?Equipe $Equipe = null;

    /**
     * @var Collection<int, Equipe>
     */
    #[ORM\OneToMany(targetEntity: Equipe::class, mappedBy: 'chef')]
    private Collection $equipes;

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): static
    {
        $this->num = $num;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCompetence(): ?string
    {
        return $this->competence;
    }

    public function setCompetence(?string $competence): static
    {
        $this->competence = $competence;

        return $this;
    }

    public function getHackathon(): ?Hackathon
    {
        return $this->Hackathon;
    }

    public function setHackathon(?Hackathon $Hackathon): static
    {
        $this->Hackathon = $Hackathon;

        return $this;
    }

    public function getParticipant(): ?Participant
    {
        return $this->Participant;
    }

    public function setParticipant(?Participant $Participant): static
    {
        $this->Participant = $Participant;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->Equipe;
    }

    public function setEquipe(?Equipe $Equipe): static
    {
        $this->Equipe = $Equipe;

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): static
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
            $equipe->setChef($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): static
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getChef() === $this) {
                $equipe->setChef(null);
            }
        }

        return $this;
    }
}
