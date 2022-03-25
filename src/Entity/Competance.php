<?php

namespace App\Entity;

use App\Repository\CompetanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetanceRepository::class)
 */
class Competance
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
    private $language;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauLanguage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoLanguage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getNiveauLanguage(): ?string
    {
        return $this->niveauLanguage;
    }

    public function setNiveauLanguage(string $niveauLanguage): self
    {
        $this->niveauLanguage = $niveauLanguage;

        return $this;
    }

    public function getLogoLanguage(): ?string
    {
        return $this->logoLanguage;
    }

    public function setLogoLanguage(string $logoLanguage): self
    {
        $this->logoLanguage = $logoLanguage;

        return $this;
    }
}
