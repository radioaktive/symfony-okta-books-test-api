<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $authorid;

    /**
     * @ORM\Column(type="string")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
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


    public function getUpdated_at(): ?string
    {
        return $this->updated_at;
    }


    public function getAuthorid(): ?int
    {
        return $this->authorid;
    }

    public function setAuthorid(int $authorid): self
    {
        $this->authorid = $authorid;

        return $this;
    }
}
