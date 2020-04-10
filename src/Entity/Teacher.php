<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(options={"collate"="utf8mb4_spanish2_ci"})
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 */
class Teacher
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=12, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=10, nullable=true, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=12, nullable=true, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=25, nullable=true, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $department;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nwatch;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Schedule", mappedBy="teacher", orphanRemoval=true)
     */
    private $schedules;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Watch", mappedBy="teacher", orphanRemoval=true)
     */
    private $watches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Absence", mappedBy="teacher", orphanRemoval=true)
     */
    private $absences;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Teacher", inversedBy="teacher", cascade={"persist", "remove"})
     */
    private $substitute;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Teacher", mappedBy="substitute", cascade={"persist", "remove"})
     */
    private $teacher;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->watches = new ArrayCollection();
        $this->absences = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getNwatch(): ?int
    {
        return $this->nwatch;
    }

    public function setNwatch(int $nwatch): self
    {
        $this->nwatch = $nwatch;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * @return Collection|Schedule[]
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules[] = $schedule;
            $schedule->setTeacher($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->contains($schedule)) {
            $this->schedules->removeElement($schedule);
            // set the owning side to null (unless already changed)
            if ($schedule->getTeacher() === $this) {
                $schedule->setTeacher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Watch[]
     */
    public function getWatches(): Collection
    {
        return $this->watches;
    }

    public function addWatch(Watch $watch): self
    {
        if (!$this->watches->contains($watch)) {
            $this->watches[] = $watch;
            $watch->setTeacher($this);
        }

        return $this;
    }

    public function removeWatch(Watch $watch): self
    {
        if ($this->watches->contains($watch)) {
            $this->watches->removeElement($watch);
            // set the owning side to null (unless already changed)
            if ($watch->getTeacher() === $this) {
                $watch->setTeacher(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Absence[]
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setTeacher($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->contains($absence)) {
            $this->absences->removeElement($absence);
            // set the owning side to null (unless already changed)
            if ($absence->getTeacher() === $this) {
                $absence->setTeacher(null);
            }
        }

        return $this;
    }

    public function getSubstitute(): ?self
    {
        return $this->substitute;
    }

    public function setSubstitute(?self $substitute): self
    {
        $this->substitute = $substitute;

        return $this;
    }

    public function getTeacher(): ?self
    {
        return $this->teacher;
    }

    public function setTeacher(?self $teacher): self
    {
        $this->teacher = $teacher;

        // set (or unset) the owning side of the relation if necessary
        $newSubstitute = null === $teacher ? null : $this;
        if ($teacher->getSubstitute() !== $newSubstitute) {
            $teacher->setSubstitute($newSubstitute);
        }

        return $this;
    }
}
