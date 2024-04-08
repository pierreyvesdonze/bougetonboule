<?php

namespace App\Entity;

use App\Repository\TrainingProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingProgramRepository::class)]
class TrainingProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'trainingPrograms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GoalCategory $goalCategory = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $instruction = null;

    /**
     * @var Collection<int, ExerciseInstance>
     */
    #[ORM\OneToMany(mappedBy: 'trainingProgram', targetEntity: ExerciseInstance::class)]
    private Collection $exerciseInstances;

    /**
     * @var Collection<int, TrainingWeek>
     */
    #[ORM\OneToMany(mappedBy: 'trainingProgram', targetEntity: TrainingWeek::class)]
    private Collection $trainingWeeks;

    public function __construct()
    {
        $this->exerciseInstances = new ArrayCollection();
        $this->trainingWeeks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getGoalCategory(): ?GoalCategory
    {
        return $this->goalCategory;
    }

    public function setGoalCategory(?GoalCategory $goalCategory): static
    {
        $this->goalCategory = $goalCategory;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): static
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * @return Collection<int, ExerciseInstance>
     */
    public function getExerciseInstances(): Collection
    {
        return $this->exerciseInstances;
    }

    public function addExerciseInstance(ExerciseInstance $exerciseInstance): static
    {
        if (!$this->exerciseInstances->contains($exerciseInstance)) {
            $this->exerciseInstances->add($exerciseInstance);
            $exerciseInstance->setTrainingProgram($this);
        }

        return $this;
    }

    public function removeExerciseInstance(ExerciseInstance $exerciseInstance): static
    {
        if ($this->exerciseInstances->removeElement($exerciseInstance)) {
            // set the owning side to null (unless already changed)
            if ($exerciseInstance->getTrainingProgram() === $this) {
                $exerciseInstance->setTrainingProgram(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TrainingWeek>
     */
    public function getTrainingWeeks(): Collection
    {
        return $this->trainingWeeks;
    }

    public function addTrainingWeek(TrainingWeek $trainingWeek): static
    {
        if (!$this->trainingWeeks->contains($trainingWeek)) {
            $this->trainingWeeks->add($trainingWeek);
            $trainingWeek->setTrainingProgram($this);
        }

        return $this;
    }

    public function removeTrainingWeek(TrainingWeek $trainingWeek): static
    {
        if ($this->trainingWeeks->removeElement($trainingWeek)) {
            // set the owning side to null (unless already changed)
            if ($trainingWeek->getTrainingProgram() === $this) {
                $trainingWeek->setTrainingProgram(null);
            }
        }

        return $this;
    }
}
