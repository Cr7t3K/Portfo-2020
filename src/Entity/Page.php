<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
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
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="pages")
     */
    private $skills;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainSentence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sentence1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sentence2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sentence3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sentence4;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

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

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
        }

        return $this;
    }

    public function getSentence1(): ?string
    {
        return $this->sentence1;
    }

    public function setSentence1(?string $sentence1): self
    {
        $this->sentence1 = $sentence1;

        return $this;
    }

    public function getSentence2(): ?string
    {
        return $this->sentence2;
    }

    public function setSentence2(?string $sentence2): self
    {
        $this->sentence2 = $sentence2;

        return $this;
    }

    public function getSentence3(): ?string
    {
        return $this->sentence3;
    }

    public function setSentence3(?string $sentence3): self
    {
        $this->sentence3 = $sentence3;

        return $this;
    }

    public function getSentence4(): ?string
    {
        return $this->sentence4;
    }

    public function setSentence4(?string $sentence4): self
    {
        $this->sentence4 = $sentence4;

        return $this;
    }

    public function getMainSentence(): ?string
    {
        return $this->mainSentence;
    }

    public function setMainSentence(string $mainSentence): self
    {
        $this->mainSentence = $mainSentence;

        return $this;
    }
}
