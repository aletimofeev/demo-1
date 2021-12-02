<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"employee"}},
 *     denormalizationContext={"groups"={"employee"}}
 * )
 */
class Employee
{
    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     */
    private string $lastname;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=50)
     */
    private string $firstname;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     */
    private string $patronymic;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="date", name="birth_date")
     *
     * @Assert\NotBlank
     * @Assert\Date()
     *
     */
    private \DateTimeInterface $birthDate;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="employees")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotBlank
     */
    private Department $department;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="employees")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotBlank
     */
    private Position $position;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }
}
