<?php

namespace App\Entity;

use App\Repository\GoalCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoalCategoryRepository::class)]
class GoalCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, TrainingProgram>
     */
    #[ORM\OneToMany(mappedBy: 'goalCategory', targetEntity: TrainingProgram::class)]
    private Collection $trainingPrograms;

    public function __construct()
    {
        $this->trainingPrograms = new ArrayCollection();
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

    /**
     * @return Collection<int, TrainingProgram>
     */
    public function getTrainingPrograms(): Collection
    {
        return $this->trainingPrograms;
    }

    public function addTrainingProgram(TrainingProgram $trainingProgram): static
    {
        if (!$this->trainingPrograms->contains($trainingProgram)) {
            $this->trainingPrograms->add($trainingProgram);
            $trainingProgram->setGoalCategory($this);
        }

        return $this;
    }

    public function removeTrainingProgram(TrainingProgram $trainingProgram): static
    {
        if ($this->trainingPrograms->removeElement($trainingProgram)) {
            // set the owning side to null (unless already changed)
            if ($trainingProgram->getGoalCategory() === $this) {
                $trainingProgram->setGoalCategory(null);
            }
        }

        return $this;
    }
}
