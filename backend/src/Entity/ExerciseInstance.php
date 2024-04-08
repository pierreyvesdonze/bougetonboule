<?php

namespace App\Entity;

use App\Repository\ExerciseInstanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseInstanceRepository::class)]
class ExerciseInstance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exerciseInstances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TrainingProgram $trainingProgram = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercise = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $level = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $serie = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $repetitionCount = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $durationStart = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $durationEnd = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $breakTime = null;

    /**
     * @var Collection<int, UserPerformance>
     */
    #[ORM\OneToMany(mappedBy: 'exerciseInstance', targetEntity: UserPerformance::class)]
    private Collection $userPerformances;

    public function __construct()
    {
        $this->userPerformances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(Exercise $exercise): static
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getSerie(): ?int
    {
        return $this->serie;
    }

    public function setSerie(int $serie): static
    {
        $this->serie = $serie;

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

    public function getBreakTime(): ?int
    {
        return $this->breakTime;
    }

    public function setBreakTime(int $breakTime): static
    {
        $this->breakTime = $breakTime;

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
            $userPerformance->setExerciseInstance($this);
        }

        return $this;
    }

    public function removeUserPerformance(UserPerformance $userPerformance): static
    {
        if ($this->userPerformances->removeElement($userPerformance)) {
            // set the owning side to null (unless already changed)
            if ($userPerformance->getExerciseInstance() === $this) {
                $userPerformance->setExerciseInstance(null);
            }
        }

        return $this;
    }
}
