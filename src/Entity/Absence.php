<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Table(options={"collate"="utf8mb4_spanish2_ci"},
 * uniqueConstraints={
 * @UniqueConstraint(name="absence_unique",
 * columns={"session_id", "teacher_id", "dateleave"})
 *    })
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\AbsenceRepository")
 */
class Absence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $dateleave;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $work;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="absences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="absences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\PrePersist
     */
    public function setCreated(){
        $this->created = new \Datetime();
    }

    /**
     * @ORM\Column(type="date")
     */
    private $updated;

    /**
     * @ORM\PreUpdate
     */
    public function setUpdated(){
        $this->updated = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateleave(): ?\DateTimeInterface
    {
        return $this->dateleave;
    }

    public function setDateleave(\DateTimeInterface $dateleave): self
    {
        $this->dateleave = $dateleave;

        return $this;
    }

    public function getWork(): ?string
    {
        return $this->work;
    }

    public function setWork(?string $work): self
    {
        $this->work = $work;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }
}
