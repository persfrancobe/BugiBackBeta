<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 */
class Language
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creatAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TxtContent", mappedBy="language")
     */
    private $txtContents;

    public function __construct()
    {
        $this->txtContents = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeInterface $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return Collection|TxtContent[]
     */
    public function getTxtContents(): Collection
    {
        return $this->txtContents;
    }

    public function addTxtContent(TxtContent $txtContent): self
    {
        if (!$this->txtContents->contains($txtContent)) {
            $this->txtContents[] = $txtContent;
            $txtContent->setLanguage($this);
        }

        return $this;
    }

    public function removeTxtContent(TxtContent $txtContent): self
    {
        if ($this->txtContents->contains($txtContent)) {
            $this->txtContents->removeElement($txtContent);
            // set the owning side to null (unless already changed)
            if ($txtContent->getLanguage() === $this) {
                $txtContent->setLanguage(null);
            }
        }

        return $this;
    }
}
