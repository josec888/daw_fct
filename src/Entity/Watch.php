<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(options={"collate"="utf8mb4_spanish2_ci"})
 * @ORM\Entity(repositoryClass="App\Repository\WatchRepository")
 */
class Watch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datewatch;

    /**
     * @ORM\Column(type="boolean")
     */
    private $signed;

    /**
     * @ORM\ManyToOne(targetEntity="Classgroup", inversedBy="watches")
     */
    private $classgroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="watches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="watches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatewatch(): ?\DateTimeInterface
    {
        return $this->datewatch;
    }

    public function setDatewatch(\DateTimeInterface $datewatch): self
    {
        $this->datewatch = $datewatch;

        return $this;
    }

    public function getSigned(): ?bool
    {
        return $this->signed;
    }

    public function setSigned(bool $signed): self
    {
        $this->signed = $signed;

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

}
