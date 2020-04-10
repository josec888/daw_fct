<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(options={"collate"="utf8mb4_spanish2_ci"})
 * @ORM\Entity(repositoryClass="App\Repository\ScheduleRepository")
 */
class Schedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $dow;

    /**
     * @ORM\Column(type="string", length=8), options={"collation":"utf8mb4_spanish2_ci"}
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Classgroup", inversedBy="schedules")
     */
    private $classgroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classroom", inversedBy="schedules")
     */
    private $classroom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="schedules")
     */
    private $subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDow(): ?string
    {
        return $this->dow;
    }

    public function setDow(string $dow): self
    {
        $this->dow = $dow;

        return $this;
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

    public function getClassgroup(): ?Classgroup
    {
        return $this->classgroup;
    }

    public function setClassgroup(?Classgroup $classgroup): self
    {
        $this->classgroup = $classgroup;

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

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}
