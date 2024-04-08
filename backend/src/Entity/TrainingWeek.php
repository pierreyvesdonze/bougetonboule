<?php

namespace App\Entity;

use App\Repository\TrainingWeekRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingWeekRepository::class)]
class TrainingWeek
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'trainingWeeks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private array $selectedTrainingDays = [];

    #[ORM\ManyToOne(inversedBy: 'trainingWeeks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TrainingProgram $trainingProgram = null;

    #[ORM\Column]
    private ?bool $isFinish = null;

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

    public function getSelectedTrainingDays(): array
    {
        return $this->selectedTrainingDays;
    }

    public function setSelectedTrainingDays(array $selectedTrainingDays): static
    {
        $this->selectedTrainingDays = $selectedTrainingDays;

        return $this;
    }

    public function getTrainingProgram(): ?TrainingProgram
    {
        return $this->trainingProgram;
    }

    public function setTrainingProgram(?TrainingProgram $trainingProgram): static
    {
        $this->trainingProgram = $trainingProgram;

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
}
