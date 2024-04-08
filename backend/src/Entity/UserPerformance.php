<?php

namespace App\Entity;

use App\Repository\UserPerformanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserPerformanceRepository::class)]
class UserPerformance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userPerformances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userPerformances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TrainingSession $trainingSession = null;

    #[ORM\ManyToOne(inversedBy: 'userPerformances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExerciseInstance $exerciseInstance = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $repetitionCount = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $durationStart = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $durationEnd = null;

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

    public function getTrainingSession(): ?TrainingSession
    {
        return $this->trainingSession;
    }

    public function setTrainingSession(?TrainingSession $trainingSession): static
    {
        $this->trainingSession = $trainingSession;

        return $this;
    }

    public function getExerciseInstance(): ?ExerciseInstance
    {
        return $this->exerciseInstance;
    }

    public function setExerciseInstance(?ExerciseInstance $exerciseInstance): static
    {
        $this->exerciseInstance = $exerciseInstance;

        return $this;
    }

    public function getRepetitionCount(): ?int
    {
        return $this->repetitionCount;
    }

    public function setRepetitionCount(?int $repetitionCount): static
    {
        $this->repetitionCount = $repetitionCount;

        return $this;
    }

    public function getDurationStart(): ?int
    {
        return $this->durationStart;
    }

    public function setDurationStart(?int $durationStart): static
    {
        $this->durationStart = $durationStart;

        return $this;
    }

    public function getDurationEnd(): ?int
    {
        return $this->durationEnd;
    }

    public function setDurationEnd(?int $durationEnd): static
    {
        $this->durationEnd = $durationEnd;

        return $this;
    }
}
