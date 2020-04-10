<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(options={"collate"="utf8mb4_spanish2_ci"})
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=2, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $start;

    /**
     * @ORM\Column(type="time")
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Schedule", mappedBy="session", orphanRemoval=true)
     */
    private $schedules;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Absence", mappedBy="session", orphanRemoval=true)
     */
    private $absences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Watch", mappedBy="session", orphanRemoval=true)
     */
    private $watches;


    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->absences = new ArrayCollection();
        $this->watches = new ArrayCollection();
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

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $schedule->setSession($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->contains($schedule)) {
            $this->schedules->removeElement($schedule);
            // set the owning side to null (unless already changed)
            if ($schedule->getSession() === $this) {
                $schedule->setSession(null);
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
            $absence->setSession($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): self
    {
        if ($this->absences->contains($absence)) {
            $this->absences->removeElement($absence);
            // set the owning side to null (unless already changed)
            if ($absence->getSession() === $this) {
                $absence->setSession(null);
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
            $watch->setSession($this);
        }

        return $this;
    }

    public function removeWatch(Watch $watch): self
    {
        if ($this->watches->contains($watch)) {
            $this->watches->removeElement($watch);
            // set the owning side to null (unless already changed)
            if ($watch->getSession() === $this) {
                $watch->setSession(null);
            }
        }

        return $this;
    }

}
