<?php

namespace App\Entity;

use App\Repository\QualiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QualiteRepository::class)
 */
class Qualite
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
    private $nomQualite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomQualite(): ?string
    {
        return $this->nomQualite;
    }

    public function setNomQualite(string $nomQualite): self
    {
        $this->nomQualite = $nomQualite;

        return $this;
    }
}
