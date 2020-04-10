<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(options={"collate"="utf8mb4_spanish2_ci"})
 * @ORM\Entity(repositoryClass="App\Repository\ClassgroupRepository")
 */
class Classgroup
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=10, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $name;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true, "default":50, "collation":"utf8mb4_spanish2_ci"})
     */
    private $priority;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Schedule", mappedBy="classgroup")
     */
    private $schedules;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Watch", mappedBy="classgroup")
     */
    private $watches;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

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
            $schedule->setClassgroup($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->contains($schedule)) {
            $this->schedules->removeElement($schedule);
            // set the owning side to null (unless already changed)
            if ($schedule->getClassgroup() === $this) {
                $schedule->setClassgroup(null);
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
            $watch->setClassgroup($this);
        }

        return $this;
    }

    public function removeWatch(Watch $watch): self
    {
        if ($this->watches->contains($watch)) {
            $this->watches->removeElement($watch);
            // set the owning side to null (unless already changed)
            if ($watch->getClassgroup() === $this) {
                $watch->setClassgroup(null);
            }
        }

        return $this;
    }
}
