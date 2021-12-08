<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 * @Table(name="employees", indexes={
 *     @Index(name="employees_name_idx", columns={"lastname"}),
 *     @Index(name="employees_birth_date_idx", columns={"birth_date"})
 * })
 *
 * @ApiResource(
 *     normalizationContext={"groups" = {"employee"}},
 *     denormalizationContext={"groups" = {"employee"}},
 *     attributes={"order" = {"lastname" = "ASC"}}
 * )
 *
 * @ApiFilter(DateFilter::class, properties={"birthDate"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "lastname" = "iword_start",
 *     "department.name" = "exact",
 *     "position.name" = "exact",
 * })
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={"lastname", "firstname", "patronymic", "birthDate", "email", "department.name", "position.name"},
 *     arguments={"orderParameterName" = "order"}
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
    private string $lastname = '';

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=50)
     */
    private string $firstname = '';

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     */
    private string $patronymic = '';

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="date", name="birth_date")
     *
     * @Assert\Type("\DateTimeInterface")
     */
    private \DateTimeInterface $birthDate;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="employees")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull
     */
    private ?Department $department;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="employees")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull
     */
    private ?Position $position;

    /**
     * @Groups({"employee", "department_full"})
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private ?string $email;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
