<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlockRepository")
 */
class Block
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creatAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TxtContent", mappedBy="block")
     */
    private $TxtContents;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Template", cascade={"persist", "remove"})
     */
    private $template;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Page", inversedBy="block")
     */
    private $page;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordby;

    public function __construct()
    {
        $this->TxtContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * @return Collection|TxtContent[]
     */
    public function getTxtContents(): Collection
    {
        return $this->TxtContents;
    }

    public function addTxtContent(TxtContent $txtContent): self
    {
        if (!$this->TxtContents->contains($txtContent)) {
            $this->TxtContents[] = $txtContent;
            $txtContent->setBlock($this);
        }

        return $this;
    }

    public function removeTxtContent(TxtContent $txtContent): self
    {
        if ($this->TxtContents->contains($txtContent)) {
            $this->TxtContents->removeElement($txtContent);
            // set the owning side to null (unless already changed)
            if ($txtContent->getBlock() === $this) {
                $txtContent->setBlock(null);
            }
        }

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getOrdby(): ?int
    {
        return $this->ordby;
    }

    public function setOrdby(int $ordby): self
    {
        $this->ordby = $ordby;

        return $this;
    }
}
