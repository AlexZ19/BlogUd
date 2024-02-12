<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomDuProduit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DSescription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $n;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDuProduit(): ?string
    {
        return $this->NomDuProduit;
    }

    public function setNomDuProduit(string $NomDuProduit): self
    {
        $this->NomDuProduit = $NomDuProduit;

        return $this;
    }

    public function getDSescription(): ?string
    {
        return $this->DSescription;
    }

    public function setDSescription(string $DSescription): self
    {
        $this->DSescription = $DSescription;

        return $this;
    }

    public function getN(): ?string
    {
        return $this->n;
    }

    public function setN(string $n): self
    {
        $this->n = $n;

        return $this;
    }
}
