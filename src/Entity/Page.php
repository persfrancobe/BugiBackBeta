<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordby;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creatAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Block", mappedBy="page")
     */
    private $block;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TxtContent", mappedBy="page")
     */
    private $textContents;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Template", cascade={"persist", "remove"})
     */
    private $template;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Page")
     */
    private $fatherPage;

    public function __construct()
    {
        $this->block = new ArrayCollection();
        $this->textContents = new ArrayCollection();
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

    public function getOrdby(): ?int
    {
        return $this->ordby;
    }

    public function setOrdby(int $ordby): self
    {
        $this->ordby = $ordby;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
     * @return Collection|Block[]
     */
    public function getBlock(): Collection
    {
        return $this->block;
    }

    public function addBlock(Block $block): self
    {
        if (!$this->block->contains($block)) {
            $this->block[] = $block;
            $block->setPage($this);
        }

        return $this;
    }

    public function removeBlock(Block $block): self
    {
        if ($this->block->contains($block)) {
            $this->block->removeElement($block);
            // set the owning side to null (unless already changed)
            if ($block->getPage() === $this) {
                $block->setPage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TxtContent[]
     */
    public function getTextContents(): Collection
    {
        return $this->textContents;
    }

    public function addTextContent(TxtContent $textContent): self
    {
        if (!$this->textContents->contains($textContent)) {
            $this->textContents[] = $textContent;
            $textContent->setPage($this);
        }

        return $this;
    }

    public function removeTextContent(TxtContent $textContent): self
    {
        if ($this->textContents->contains($textContent)) {
            $this->textContents->removeElement($textContent);
            // set the owning side to null (unless already changed)
            if ($textContent->getPage() === $this) {
                $textContent->setPage(null);
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

    public function getFatherPage(): ?PAge
    {
        return $this->fatherPage;
    }

    public function setFatherPage(?PAge $fatherPage): self
    {
        $this->fatherPage = $fatherPage;

        return $this;
    }
}
