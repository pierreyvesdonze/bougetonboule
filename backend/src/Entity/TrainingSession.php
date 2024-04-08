<?php

namespace App\Entity;

use App\Repository\TrainingSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingSessionRepository::class)]
class TrainingSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'trainingSessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $isFinish = null;

    /**
     * @var Collection<int, UserPerformance>
     */
    #[ORM\OneToMany(mappedBy: 'trainingSession', targetEntity: UserPerformance::class)]
    private Collection $userPerformances;

    public function __construct()
    {
        $this->userPerformances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function isFinish(): ?bool
    {
        return $this->isFinish;
    }

    public function setFinish(bool $isFinish): static
    {
        $this->isFinish = $isFinish;

        return $this;
    }

    /**
     * @return Collection<int, UserPerformance>
     */
    public function getUserPerformances(): Collection
    {
        return $this->userPerformances;
    }

    public function addUserPerformance(UserPerformance $userPerformance): static
    {
        if (!$this->userPerformances->contains($userPerformance)) {
            $this->userPerformances->add($userPerformance);
            $userPerformance->setTrainingSession($this);
        }

        return $this;
    }

    public function removeUserPerformance(UserPerformance $userPerformance): static
    {
        if ($this->userPerformances->removeElement($userPerformance)) {
            // set the owning side to null (unless already changed)
            if ($userPerformance->getTrainingSession() === $this) {
                $userPerformance->setTrainingSession(null);
            }
        }

        return $this;
    }
}
