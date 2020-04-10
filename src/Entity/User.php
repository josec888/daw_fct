<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Teacher;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(options={"collate"="utf8mb4_spanish2_ci"})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true, options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", options={"collation":"utf8mb4_spanish2_ci"})
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Teacher", cascade={"persist", "remove"})
     */
    private $teacher;

//    public function __construct(){
//        $this->roles = ["ROLE_USER"];
//    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getTeacherId(): ?string {
        if (null==$this->teacher){
            return null;
        }else{
            return $this->teacher->getId();
        }
    }

    public function getTeacherFullName(): ?string
    {
        if (null == $this->teacher){
            return null;
        }else{
            return $this->teacher->getFullName();
        }
    }
}
