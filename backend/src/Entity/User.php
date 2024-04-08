<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 32, unique: true)]
    private ?string $pseudo = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, TrainingWeek>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: TrainingWeek::class)]
    private Collection $trainingWeeks;

    /**
     * @var Collection<int, TrainingSession>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: TrainingSession::class)]
    private Collection $trainingSessions;

    /**
     * @var Collection<int, UserPerformance>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserPerformance::class)]
    private Collection $userPerformances;

    public function __construct()
    {
        $this->trainingWeeks = new ArrayCollection();
        $this->trainingSessions = new ArrayCollection();
        $this->userPerformances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

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
            $trainingWeek->setUser($this);
        }

        return $this;
    }

    public function removeTrainingWeek(TrainingWeek $trainingWeek): static
    {
        if ($this->trainingWeeks->removeElement($trainingWeek)) {
            // set the owning side to null (unless already changed)
            if ($trainingWeek->getUser() === $this) {
                $trainingWeek->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TrainingSession>
     */
    public function getTrainingSessions(): Collection
    {
        return $this->trainingSessions;
    }

    public function addTrainingSession(TrainingSession $trainingSession): static
    {
        if (!$this->trainingSessions->contains($trainingSession)) {
            $this->trainingSessions->add($trainingSession);
            $trainingSession->setUser($this);
        }

        return $this;
    }

    public function removeTrainingSession(TrainingSession $trainingSession): static
    {
        if ($this->trainingSessions->removeElement($trainingSession)) {
            // set the owning side to null (unless already changed)
            if ($trainingSession->getUser() === $this) {
                $trainingSession->setUser(null);
            }
        }

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
            $userPerformance->setUser($this);
        }

        return $this;
    }

    public function removeUserPerformance(UserPerformance $userPerformance): static
    {
        if ($this->userPerformances->removeElement($userPerformance)) {
            // set the owning side to null (unless already changed)
            if ($userPerformance->getUser() === $this) {
                $userPerformance->setUser(null);
            }
        }

        return $this;
    }
}
